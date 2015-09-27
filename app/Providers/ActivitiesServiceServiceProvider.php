<?php

namespace WTT\Providers;

use Illuminate\Support\ServiceProvider;
use WTT\Services\ActivitiesService;

class ActivitiesServiceServiceProvider extends ServiceProvider
{

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    // Binds 'pokemonService' to the result of the closure
        $this->app->bind('ActivitiesService', function($app)
        {
            return new ActivitiesService(
            // Inject in our class of ActivityRepositoryInterface, this will be our repository
                $app->make('Repositories\Contracts\ActivityRepositoryInterface')
            );
        });//
    }
}
