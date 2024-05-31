<?php

namespace Webkul\Admin\Listeners;

use Webkul\User\Repositories\UserRepository;
use Webkul\Email\Repositories\EmailRepository;
use Webkul\Admin\Notifications\Lead\LeadNotification;

class Lead
{
    /**
     * EmailRepository object
     *
     * @var \Webkul\Email\Repositories\EmailRepository
     */
    protected $emailRepository;

    /**
     * Create a new controller instance.
     *
     * @param \Webkul\Email\Repositories\EmailRepository  $emailRepository
     *
     * @return void
     */
    public function __construct(EmailRepository $emailRepository)
    {
        $this->emailRepository = $emailRepository;
    }

    /**
     * @param  \Webkul\Lead\Models\Lead  $lead
     * @return void
     */
    public function linkToEmail($lead)
    {
        $this->createNotification($lead);

        $this->webFormSource($lead);

        if (! request('email_id')) {
            return;
        }

        $this->emailRepository->update([
            'lead_id' => $lead->id,
        ], request('email_id'));
    }

    /**
     * @param  \Webkul\Lead\Models\Lead  $lead
     * @return void
     */
    public function createNotification($lead)
    {
        $notificationData = core()->getNotificationDetail('lead', $lead->id);

        $lead->notify(new LeadNotification($notificationData));
    }

    /**
     * @param  \Webkul\Lead\Models\Lead  $lead
     * @return void
     */
    private function webFormSource($lead)
    {
        $source = [
            'name' => request()->headers->get('host'),
            'link' => request()->headers->get('referer'),
        ];

        $lead->pickup_time = request()->input('leads.pickup_time') ?? request()->input('pickup_time');

        $lead->pickup_date = request()->input('leads.pickup_date') ?? request()->input('pickup_date');

        $lead->additional = $source;

        $lead->save();
    }
}