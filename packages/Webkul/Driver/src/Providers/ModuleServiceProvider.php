<?php

namespace Webkul\Driver\Providers;

use Webkul\Core\Providers\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Webkul\Driver\Models\Driver::class,
        \Webkul\Driver\Models\DriverLead::class,
    ];
}