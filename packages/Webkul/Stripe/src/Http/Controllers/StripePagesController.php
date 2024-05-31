<?php

namespace Webkul\Stripe\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Event;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Lead\Repositories\StageRepository;
use Webkul\Quote\Repositories\QuoteRepository;

class StripePagesController extends Controller
{
    /**
     * Create a new repository instance.
     */
    public function __construct(
        protected QuoteRepository $quoteRepository,
        protected StageRepository $stageRepository,
    ) {
    }

    /**
     * Display the success page after payment.
     *
     * @return \Illuminate\View\View
     */
    public function paymentSuccess()
    {
        $quoteId = request()->input('quote_id');
       
        $quoteId = Crypt::decryptString($quoteId);
        
        return view('stripe::success.index', compact('quoteId'));
    }

    /**
     * Display the Cancel page.
     *
     * @return \Illuminate\View\View
     */
    public function paymentCancel()
    {
        $quoteId = request()->input('quote_id');

        $quoteId = Crypt::decryptString($quoteId);

        return view('stripe::cancel.index', compact('quoteId'));
    }

    /**
     * Send Quote on Mail
     */
    public function sendQuoteInvoice()
    {
        if(! request()->input('quote_id')) {
            return response()->json([
                'status'  => false,
                'message' => trans('stripe::app.quotes.send-invoice-error'),
            ], 200); 
        }

        $quote = $this->quoteRepository->findOrFail(request()->input('quote_id'));

        Event::dispatch('quote.invoice.send.after', ['quote' => $quote]);

        return response()->json([
            'status'  => true,
            'message' => trans('stripe::app.quotes.send-invoice-success')
        ], 200);
    }
}