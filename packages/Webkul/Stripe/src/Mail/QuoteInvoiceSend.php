<?php

namespace Webkul\Stripe\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;

class QuoteInvoiceSend extends Mailable
{
    /**
     * Create a new mailable instance.
     * 
     * @return void
     */
    public function __construct(
        protected $quote
    ) {
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            to: data_get($this->quote->person->emails, '*.value'),
            from: new Address(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME')),
            subject: trans('stripe::app.email.quote.subject', ['id' => $this->quote->id]),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'stripe::email.quote',
            with: [
                'name'  => $this->quote->user->name,
                'quote' => $this->quote,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array, \Illuminate\Mail\Mailables\Attachment
     */
    public function attachments()
    {
        return [
            Attachment::fromStorage($this->quote->invoice_path)
                ->as('Quote_' . $this->quote->subject . '.pdf'),
        ];
    }
}
