<?php

namespace Webkul\Notification\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Notification\Contracts\Notification as NotificationContract;

class Notification extends Model implements NotificationContract
{
    protected $table = "notifications";

    /**
     * Get the attributes that should be cast.
     */
    protected $casts = [
            'data' => 'array',
        ];
}
