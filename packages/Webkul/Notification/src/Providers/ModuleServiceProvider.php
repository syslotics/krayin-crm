<?php

namespace Webkul\Notification\Providers;

use Webkul\Core\Providers\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Webkul\Notification\Models\Notification::class,
    ];
}