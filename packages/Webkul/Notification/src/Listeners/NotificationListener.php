<?php 

namespace Webkul\Notification\Listeners;

use Webkul\Notification\Repositories\NotificationRepository;

class NotificationListener {

    /**
     * Mark as read after lead view page open
     */
    public function leadCreateAfter($lead)
    {
        return app(NotificationRepository::class)->where([
                'notifiable_type' => 'leads',
                'notifiable_id'   => $lead->id,
            ])->update(['read_at' => date('Y-m-d H:i:s')]);
    }
}