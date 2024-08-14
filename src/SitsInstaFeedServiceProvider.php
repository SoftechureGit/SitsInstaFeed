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
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'sitsinstafeed');
        $this->publishes([
            __DIR__.'/resources/assets/css' => public_path('vendor/sits-insta-feed/css'),
        ], 'public');
        $this->publishes([
            __DIR__.'/config/sits_insta_feed.php' => config_path('sits_insta_feed.php'),
        ], 'config');
    }

    /**
     * Example custom method.
     */
    public function justDoIt()
    {
        return 'Insta Feed Is Loading....';
    }
}
