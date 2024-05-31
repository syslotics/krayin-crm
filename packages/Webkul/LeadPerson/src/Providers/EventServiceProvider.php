<?php

namespace Webkul\LeadPerson\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Webkul\LeadPerson\Listeners\LeadPersonListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot ()
    {
        Event::listen('lead.create.after', function ($lead) {
            app(LeadPersonListener::class)->afterLeadUpdateOrCreate($lead);
        });

        Event::listen('lead.update.after', function ($lead) {
            app(LeadPersonListener::class)->afterLeadUpdateOrCreate($lead);
        });

        Event::listen('admin.leads.view.informations.contact_person.before', function ($viewRenderEventManager) {
            $viewRenderEventManager->addTemplate('LeadPerson::leads.view.person');
        });

        Event::listen('lead.status.change', function () {
            app(LeadPersonListener::class)->leadStatusUpdate();
        });
    }
}
