<?php

namespace Webkul\Stripe\Mail;

use Illuminate\Mail\Mailable;
use Webkul\Quote\Models\Quote;

class Cancel extends Mailable
{
    protected $quote;

    /**
     * Create a new message instance.
     *
     * @param  \Webkul\Quote\Models\Quote  $quote
     * @return void
     */
    public function __construct(Quote $quote)
    {
        $this->quote = $quote;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->to($this->quote->user->email)
            ->subject(trans('stripe::app.email.cancel.subject', ['id' => $this->quote->id]))
            ->view('stripe::email.cancel', [
                'name'  => $this->quote->user->name,
                'quote' => $this->quote,
            ]);
    }
}