<?php

namespace WTT\Providers;

use Illuminate\Support\ServiceProvider;
use WTT\EISRequest;
use WTT\Repositories\Eloquent\ActivityRepository;
use WTT\Repositories\Eloquent\OrdersRepository;
use WTT\VWMRIC_SUNRISE_ACTIVITY;

class ActivityRepositoryServiceProvider extends ServiceProvider
{

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Bind the returned class to the namespace 'Repositories\Contracts\OrdersInterface
        $this->app->bind('Repositories\Contracts\ActivityRepositoryInterface', function($app)
        {
            return new ActivityRepository(new VWMRIC_SUNRISE_ACTIVITY());
        });
    }
}
