<?php

namespace Webkul\Driver\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Webkul\Driver\Listener\DriverListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen('admin.leads.create.form_controls.products.after', function ($viewRenderEventManager) {
            $viewRenderEventManager->addTemplate('drivers::lead.form.create');
        });

        Event::listen('admin.leads.view.informations.contact_person.after', function($viewRenderEventManager) {
            $viewRenderEventManager->addTemplate('drivers::lead.view.index');
        });

        Event::listen('admin.leads.view.edit.form_controls.products.after', function($viewRenderEventManager) {
            $viewRenderEventManager->addTemplate('drivers::lead.form.edit');
        });

        Event::listen('lead.create.after', function($lead) {
            app(DriverListener::class)->leadCreateAfter($lead);
        });

        Event::listen('lead.update.after', function($lead) {
            app(DriverListener::class)->leadCreateAfter($lead);
        });
    }
}
