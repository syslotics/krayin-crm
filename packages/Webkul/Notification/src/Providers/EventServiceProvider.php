<?php

namespace Webkul\Notification\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Webkul\Notification\Listeners\NotificationListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen('lead.view.after', function($lead) {
            app(NotificationListener::class)->leadCreateAfter($lead);
        });
    }
}
