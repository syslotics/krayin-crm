<?php

namespace Webkul\Admin\Notifications\Lead;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class LeadNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @param  \Webkul\Lead\Repositories\LeadRepository  $leadRepository
     * @return void
     */
    public function __construct(
        $lead
    ) {
        $this->lead = $lead;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toDatabase($notifiable)
    {
        return [
            'id'      => $this->lead['id'],
            'title'   => $this->lead['title'],
            'content' => $this->lead['content'],
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [];
    }
}
