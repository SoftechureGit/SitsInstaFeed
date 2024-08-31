<?php

namespace Sits\SitsInstaFeed;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;
use Sits\SitsInstaFeed\Http\Middleware\InjectCssCdnMiddleware;

use Illuminate\Support\Facades\Blade;
use Sits\SitsInstaFeed\View\Components\SitsInstaFeedComponent;

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
        $this->userDomain = request()->getHost();
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
        
        Blade::component('sitsinstafeed::sits-insta-feed-component', SitsInstaFeedComponent::class);
        #new test
        $router = $this->app['router'];
        $router->pushMiddlewareToGroup('web', InjectCssCdnMiddleware::class);
        #new test end
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'sitsinstafeed');
        $this->publishes([
            __DIR__.'/resources/assets/css' => public_path('vendor/sits-insta-feed/css'),
        ], 'public');
        $this->publishes([
            __DIR__.'/config/sits_insta_feed.php' => config_path('sits_insta_feed.php'),
        ], 'config');
        // component
        // $this->publishes([
        //     __DIR__.'/resources/views/components' => resource_path('views/components/vendor/sitsinstafeed'),
        // ], 'views');
        // component end
 
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
        ])->post($apiUrl, [
            'user_domain'   => $this->userDomain,
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
    public function getSitsUrl($type = null){
        $apiUrl    =   $this->sitsApiBaseUrl . 'sits-get-feed-url';

        $response  =   Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiToken,
            'Accept'        => 'application/json',
        ])->get($apiUrl, [
            'type' => $type,
            'user_domain'   => $this->userDomain,
        ]);

        if ($response->successful()) {
            $data  =    $response->json();
            // return response()->json($data, 200);
            return (object)$data;
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


    public function getSitsComponentData($layoutType = null, $numberOfPosts = null, $mediaType = null ){

        $data = [
            'layout_type' => $layoutType,
            'number_of_posts' => $numberOfPosts,
            'media_type' => $mediaType,
            'user_domain'   => $this->userDomain,
        ];
        $apiUrl    =   $this->sitsApiBaseUrl . 'sits-get-component-data';

        $response  =   Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiToken,
            'Accept'        => 'application/json',
        ])->post($apiUrl, $data);
       
        if ($response->successful()) {
            $data  =    $response->json();
            // return response()->json($data, 200);
            return (object)$data;
        } else {
            // Handle the error response
            return [
                'error' => 'Failed to fetch data',
                'status' => $response->status(),
                'message' => $response->body(),
            ];
        }
    }

    public function getSitsContent($type = null, $mediaType = null, $numberOfPosts = null){
        //dd($this->userDomain);
        $apiUrl    =   $this->sitsApiBaseUrl . 'sits-get-content';

        $response  =   Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiToken,
            'Accept'        => 'application/json',
            ])->get($apiUrl, [
                'type' => $type,
                'media_type' => $mediaType,
                'number_of_posts' => $numberOfPosts,
                'user_domain'   => $this->userDomain,
        ]);
     //  dd($response->json());
        if ($response->successful()) {
            $data  =    $response->json();
            // return response()->json($data, 200);
            return (object)$data;
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
