<?php

namespace Mouyong\Sensitive\Providers;

use Illuminate\Support\ServiceProvider;

class SensitiveFilterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerRoute();
        $this->registerMigration();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public function registerRoute()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/route.php');
    }

    public function registerMigration()
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }
}
