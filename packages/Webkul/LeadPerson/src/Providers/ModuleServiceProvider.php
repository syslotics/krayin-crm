<?php

namespace Webkul\LeadPerson\Providers;

use Webkul\Core\Providers\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Webkul\LeadPerson\Models\LeadPerson::class,
    ];
}