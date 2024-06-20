<?php

namespace Webkul\Stripe\Mail;

use Illuminate\Mail\Mailable;
use Webkul\Quote\Models\Quote;

class Stripe extends Mailable
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
            ->to(data_get($this->quote->person->emails, '*.value'))
            ->subject(trans('stripe::app.email.index.subject'))
            ->view('stripe::email.index', [
                'name'  => $this->quote->person->first_name.$this->quote->person->last_name,
                'quote' => $this->quote,
            ]);
    }
}