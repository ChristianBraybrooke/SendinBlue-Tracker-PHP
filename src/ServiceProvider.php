<?php

namespace ChrisBraybrooke\SendinBlueTracker;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    public function boot()
    {
        $this->handleRoutes();

        $this->app->bind('sendin-blue.tracker', function ($app) {
            return new SendinBlueTracker(config('services.sendinblue.tracker_id'));
        });
    }

    /**
     * Register the web and api routes.
     *
     * @return void
     */
    private function handleRoutes()
    {
        //
    }
}
