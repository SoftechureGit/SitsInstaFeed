<?php

namespace Sits\SitsInstaFeed\Http\Controllers;
// use GuzzleHttp\Client;
// use Carbon\Carbon;
// use Illuminate\Support\Facades\Http;
// use Illuminate\Support\Facades\File;
// use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
   public function index(){
    //return $apiKey = config('sits_insta_feed.redirect_url');
    $apiToken = request()->filled('api_token') ? request()->input('api_token') : null;
    return view('sitsinstafeed::insta-feed', compact('apiToken'));
   }
    
}
