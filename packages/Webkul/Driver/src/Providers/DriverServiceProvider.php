<?php

namespace Webkul\Driver\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class DriverServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/web.php');

        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'drivers');

        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'drivers');
        
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        $this->app->register(EventServiceProvider::class);

        $this->app->register(ModuleServiceProvider::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConfig();
    }

     /**
     * Register package config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->mergeConfigFrom(dirname(__DIR__) . '/Config/acl.php', 'acl');

        $this->mergeConfigFrom(dirname(__DIR__) . '/Config/menu.php', 'menu.admin');

        $this->mergeConfigFrom(dirname(__DIR__) . '/Config/attribute_entity_types.php', 'attribute_entity_types');
    }
}
