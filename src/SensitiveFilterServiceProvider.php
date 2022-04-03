<?php

namespace Mouyong\Sensitive;

use Illuminate\Support\Facades\Route;
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
        $this->loadRoutesFrom(__DIR__.'/route.php');
    }
}
