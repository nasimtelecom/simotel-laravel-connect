<?php

namespace Nasim\LaraSimotel;

use Hsy\Simotel\Simotel;
use Illuminate\Support\ServiceProvider;

class SimotelLaravelServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Configurations that needs to be done by user.
         */
        $this->publishes(
            [
                Simotel::getDefaultConfigPath() => config_path('simotel-laravel.php'),
            ],
            'config'
        );


    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * Bind to service container.
         */
        $this->app->bind('simotel-laravel-connect', function () {
            $config = config('simotel-laravel') ?? [];
            return new Simotel($config);
        });

    }


}
