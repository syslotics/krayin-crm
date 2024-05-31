<?php

namespace Webkul\Notification\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Webkul\Notification\Http\Controllers\Controller;
use Webkul\Notification\Repositories\NotificationRepository;

class NotificationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        protected NotificationRepository $notificationRepository,
    ) {
    }

    /**
     * Get application notification
     *
     * @return \Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $notifications = $this->notificationRepository->get();

        return view('admin::notification.index', compact('notifications'));
    }

    /**
     * Mark as read notification
     *
     * @return void
     */
    public function markAsRead()
    {
        DB::table('notifications')->update(['read_at' => date('Y-m-d H:i:s')]);
        
        return redirect()->back();
    }

    /**
     * Notification read
     *
     * @return void
     */
    public function readNotification()
    {
        return $this->notificationRepository->where([
                    'notifiable_type' => 'leads',
                    'notifiable_id'   => request('notifiable_id'),
                ])->update(['read_at' => date('Y-m-d H:i:s')]);
    }

    /**
     * Get resent notification
     *
     * @return json
     */
    public function getNavNotification()
    {
        $notifications = $this->notificationRepository->where(['notifiable_type' => 'leads', 'read_at' => null])->limit(5)->get();

        foreach ($notifications as $notification) {
            switch ($notification->type) {
                case 'Webkul\Admin\Notifications\Lead\LeadNotification':
                    $notification->link = route('admin.leads.view', ['id' => $notification->data['id']]);
                    break;

                default:
                    $notification->link = '';
                    break;
            }
        }

        return response()->json([
            'notifications' => $notifications,
            'count'         => $this->notificationRepository->where(['notifiable_type' => 'leads', 'read_at' => null])->get()->count(),
        ]);
    }
}
