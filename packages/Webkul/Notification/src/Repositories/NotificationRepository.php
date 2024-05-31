<?php

namespace Webkul\Notification\Repositories;

use Illuminate\Container\Container;
use Webkul\Core\Eloquent\Repository;

class NotificationRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'Webkul\Notification\Contracts\Notification';
    }
}