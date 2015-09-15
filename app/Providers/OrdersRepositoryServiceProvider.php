<?php

namespace WTT\Providers;

use Illuminate\Support\ServiceProvider;
use WTT\EISRequest;
use WTT\Repositories\Eloquent\OrdersRepository;

class OrdersRepositoryServiceProvider extends ServiceProvider
{

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Bind the returned class to the namespace 'Repositories\Contracts\OrdersInterface
        $this->app->bind('Repositories\Contracts\OrdersRepositoryInterface', function($app)
        {
            return new OrdersRepository(new EISRequest());
        });
    }
}
