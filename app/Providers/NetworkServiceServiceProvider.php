<?php

namespace WTT\Providers;

use Illuminate\Support\ServiceProvider;
use WTT\Services\ActivitiesService;
use WTT\Services\NetworkService;

class NetworkServiceServiceProvider extends ServiceProvider
{

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    // Binds 'pokemonService' to the result of the closure
        $this->app->bind('NetworkService', function($app)
        {
            return new NetworkService(
            // Inject in our class of ActivityRepositoryInterface, this will be our repository
                $app->make('Repositories\Contracts\NetworkRepositoryInterface')
            );
        });//
    }
}
