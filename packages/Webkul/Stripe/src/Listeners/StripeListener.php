<?php 

namespace Webkul\Stripe\Listeners;

use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Webkul\Stripe\Mail\QuoteInvoiceSend;
use Webkul\Stripe\Mail\Stripe as StripeMail;
use Webkul\Quote\Repositories\QuoteRepository;
class StripeListener {

    /**
     * @var  $quote  Webkul\Quote\Repositories\QuoteRepository
     */
    public function sendStripePaymentRequest($quote) 
    {
        if ($quote->person 
            && $quote->user->email) {
            Mail::send(new StripeMail($quote));
        }

        $this->createInvoice($quote);
    }


    /**
     * Invoice send on mail
     * 
     * @param mixed $quote
     */
    public function sendInvoice($quote)
    {
        Mail::send(new QuoteInvoiceSend($quote));
    }

    /**
     * Invoice Created and store into desk
     * 
     * @param mixed $quote
     */
    private function createInvoice($quote)
    {
        $fileName = 'Quote_' . $quote->name . '.pdf';

        $pdf = PDF::loadHTML(view('admin::quotes.pdf', compact('quote'))->render());

        $content = $pdf->setPaper('a4')->download()->getOriginalContent();

        $path = 'quotes/' . $quote->id . '/' . $fileName;
        
        $quote->invoice_path = $path;
        
        Storage::put($path, $content);
        
        $quote->save();
    }

    /**
     * Delete Quite Invoice
     * 
     * @param int $id
     */
    public function removeInvoice($id)
    {
        $quote = app(QuoteRepository::class)->findOrFail($id);

        dd(Storage::has($quote->invoice_path));
        if(Storage::has($quote->invoice_path)) {
            Storage::delete($quote->invoice_path);
        }
    } 
}