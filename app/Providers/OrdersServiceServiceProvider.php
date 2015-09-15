<?php

namespace WTT\Providers;

use Illuminate\Support\ServiceProvider;
use WTT\Services\OrdersService;

class OrdersServiceServiceProvider extends ServiceProvider
{

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    // Binds 'pokemonService' to the result of the closure
        $this->app->bind('OrdersService', function($app)
        {
            return new OrdersService(
            // Inject in our class of pokemonInterface, this will be our repository
                $app->make('Repositories\Contracts\OrdersRepositoryInterface')
            );
        });//
    }
}
