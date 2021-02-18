<?php

namespace Sxt\Stconvert;

use Illuminate\Support\ServiceProvider;
use Sxt\Stconvert\Stconvert;

class StconvertServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Stconvert::class, function ($app) {
            return new Stconvert();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [Stconvert::class, 'Stconvert'];
    }
}
