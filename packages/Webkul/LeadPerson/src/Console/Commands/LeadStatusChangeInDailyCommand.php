<?php

namespace Webkul\LeadPerson\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;

class LeadStatusChangeInDailyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lead:lost';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checking Lead Closed date. if expired the lead status will change in lost';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
    ) {
        parent::__construct();
    }

    /**
     * Send quotation alert email
     */
    public function handle()
    {
        Log::info('Scheduler Check: Event Run Before', []);

        Event::dispatch('lead.status.change');

        Log::info('Scheduler Check: Event Run After', []);
    }
}
