<?php

namespace Sits\SitsInstaFeed;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;

class SitsInstaFeedServiceProvider extends ServiceProvider
{
    
    private $sitsApiBaseUrl;
    private $apiToken;

    // Constructor to initialize the properties
    
    /**
     * Create a new service provider instance.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @return void
     */
    public function __construct($app)
    {
        parent::__construct($app);
        $this->sitsApiBaseUrl = 'https://website4test.com/social_feed/socialFeed/api/';
        $this->apiToken = config('sits_insta_feed.api_token');
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


    public function getSitsFeedJson(){

        $apiUrl    =   $this->sitsApiBaseUrl . 'sits-get-feed-json';

        $response  =   Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiToken,
            'Accept'        => 'application/json',
        ])->post($apiUrl);

        if ($response->successful()) {
            $data  =    $response->json();
            return response()->json($data, 200);
        } else {
            // Return a structured error response
            return response()->json([
                'error' => 'Failed to fetch data',
                'status' => $response->status(),
                'message' => $response->body(),
            ], $response->status());
        }
    }
    public function getSitsUrl($type = null){
        $apiUrl    =   $this->sitsApiBaseUrl . 'sits-get-feed-url';

        $response  =   Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiToken,
            'Accept'        => 'application/json',
        ])->get($apiUrl, [
            'type' => $type
        ]);

        if ($response->successful()) {
            $data  =    $response->json();
            return response()->json($data, 200);
        } else {
            // Return a structured error response
            return response()->json([
                'error' => 'Failed to fetch data',
                'status' => $response->status(),
                'message' => $response->body(),
            ], $response->status());
        }
    }
    public function getSitsApiToken(){

        $apiUrl    =   $this->sitsApiBaseUrl . 'sits-get-api-token';

        $response  =   Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiToken,
            'Accept'        => 'application/json',
        ])->post($apiUrl);

        if ($response->successful()) {
            $data  =    $response->json();
            return response()->json($data, 200);
        } else {
            // Return a structured error response
            return response()->json([
                'error' => 'Failed to fetch data',
                'status' => $response->status(),
                'message' => $response->body(),
            ], $response->status());
        }
    }
}
