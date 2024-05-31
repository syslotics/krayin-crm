<?php

namespace Webkul\Stripe\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Webkul\Stripe\Listeners\StripeListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot ()
    {
        Event::listen('quote.create.after', function ($quote) {
            app(StripeListener::class)->sendStripePaymentRequest($quote);
        });

        Event::listen('quote.invoice.send.after', function ($quote) {
            app(StripeListener::class)->sendInvoice($quote);
        });

        Event::listen('quote.delete.after', function ($id) {
            app(StripeListener::class)->removeInvoice($id);
        });

        Event::listen('admin.quotes.edit.form_buttons.before', function ($viewRenderEventManager) {
            $viewRenderEventManager->addTemplate('stripe::quote.index');
        });
    }
}
