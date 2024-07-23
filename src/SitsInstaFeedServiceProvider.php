<?php

namespace Sits\SitsInstaFeed;

use Illuminate\Support\ServiceProvider;

class SitsInstaFeedServiceProvider extends ServiceProvider
{
    /**
     * Create a new service provider instance.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @return void
     */
    public function __construct($app)
    {
        parent::__construct($app);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Register any bindings or services here
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Code to boot your package, e.g., load routes, views, etc.
    }

    /**
     * Example custom method.
     */
    public function justDoIt()
    {
        return 'Insta Feed Is Loading....';
    }
}
