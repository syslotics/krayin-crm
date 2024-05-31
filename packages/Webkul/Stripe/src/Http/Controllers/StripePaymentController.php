<?php

namespace Webkul\Stripe\Http\Controllers;

use Carbon\Carbon;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use PhpParser\Node\Scalar\Float_;
use Webkul\Stripe\Mail\Cancel as StripeCancel;
use Webkul\Stripe\Mail\Success as StripeSuccess;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Lead\Repositories\StageRepository;
use Webkul\Quote\Repositories\QuoteRepository;

class StripePaymentController extends Controller
{
    /**
     * SEND BOX
     */
    const SENDBOX = 'sendbox';

    const PRODUCTION = 'production';

    /**
     * Create a new repository instance.
     */
    public function __construct(
        protected QuoteRepository $quoteRepository,
        protected StageRepository $stageRepository,
    ) {
    }
    
    /**
     * Create a new payment session for Stripe Checkout.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createPaymentSession(Request $request)
    {
        $stripeSecretKey = '';

        if(core()->getConfigData('general.stripe.debug') === 'sandbox') {
            $stripeSecretKey = core()->getConfigData('general.stripe.api_test_key');

        } elseif (core()->getConfigData('general.stripe.debug') === 'production') {
            $stripeSecretKey = core()->getConfigData('general.stripe.api_test_key');

        } else {
            return response()->json(['error' => 'API Production key not found in configuration'], 500);
        }

        if(! $stripeSecretKey) {
            return response()->json(['error' => 'API key not found in configuration'], 500);
        }

        $quote = $this->quoteRepository->findOrFail($request->input('quote_id'));

        // checking Payment Completed or not
        if($quote->is_payment_completed) {
            session()->flash('error', trans('stripe::app.cancel.index.already-paid'));

            return redirect()->route('admin.quotes.edit' , ['id' => $quote->id]);
        }

        $items = [
            [
                'price_data' => [
                    'currency'     => core()->getConfigData('general.stripe.currency'),
                    'product_data' => [
                        'name' => $quote->name ?? 'Quote Product',
                    ],
                    'unit_amount' => (float)($quote->price + $quote->tax + $quote->tip) * 100,
                ],

                'quantity' => 1, 
            ]
        ];

        $userId = $quote->person->id;

        $customerEmail = collect(data_get($quote->person->emails, '*.value'))->first();

        Stripe::setApiKey($stripeSecretKey);
      
        try {
            $checkout_session = Session::create([
                'payment_method_types' => ['card'],
                'line_items'           => $items,
                'customer_email'       => $customerEmail,
                'client_reference_id'  => $userId,
                'mode'                 => 'payment',
                'success_url'          => route('payment.success', ['quote_id' => $quote->id]),
                'cancel_url'           => route('payment.cancel', ['quote_id' => $quote->id]),
            ]);
    
            return redirect($checkout_session->url);
        } catch (\Exception $error) {
            session()->flash('error', $error->getMessage());

            return redirect()->route('admin.quotes.edit' , ['id' => $quote->id]);
        }
    }

    /**
     * Display the success page after payment.
     *
     * @return \Illuminate\View\View
     */
    public function paymentSuccess(Request $request)
    {
        $quote = $this->quoteRepository->findOrFail($request->input('quote_id'));

        $quote->is_payment_completed = 1;
        $quote->is_done = 1;

        $quote->save();

        $stage = $this->stageRepository->findOneByField('code', 'won');

        $this->leadStatusUpdateAfterPayment($quote, $stage);

        Mail::to($quote->user->email)->send(new StripeSuccess($quote));

        return redirect()->route('payment.success.view', ['quote_id' => Crypt::encryptString($quote->id)]);
    }

    /**
     * Display the cancellation page if payment is canceled.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function paymentCancel(Request $request)
    {
        $quote = $this->quoteRepository->findOrFail($request->input('quote_id'));

        $quote->is_payment_completed = 0;
        $quote->is_done = 0;

        $quote->save();

        $stage = $this->stageRepository->findOneByField('code', 'lost');

        $this->leadStatusUpdateAfterPayment($quote, $stage);

        Mail::to($quote->user->email)->send(new StripeCancel($quote));

        return redirect()->route('payment.cancel.view', ['quote_id' => Crypt::encryptString($quote->id)]);
    }

    /**
     * Handle successful payment from Stripe.
     *
     * @return void
     */
    private function leadStatusUpdateAfterPayment($quote, $stage)
    {
        $leads = $quote->leads;
        
        foreach ($leads as $lead) {
            $lead->lead_pipeline_stage_id =  $stage->id;
           
            $lead->save();
        }
    }
}