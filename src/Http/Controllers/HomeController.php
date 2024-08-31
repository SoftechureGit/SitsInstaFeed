<?php

namespace Sits\SitsInstaFeed\Http\Controllers;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{ 

   public function index() {
      $apiToken = request()->filled('api_token') ? request()->input('api_token') : null;
  
      $key = 'api_token'; 
      $value = $apiToken;
      $configUpdated = false; 
  
      try {
         
          $configPath = config_path('sits_insta_feed.php');
          $config = File::getRequire($configPath);
  
          // Modify the configuration
          $keys = explode('.', $key);
          $array = &$config;
          foreach ($keys as $keyPart) {
              if (!isset($array[$keyPart])) {
                  $array[$keyPart] = [];
              }
              $array = &$array[$keyPart];
          }
          if($value){
              $array = $value;
          }
  
          File::put($configPath, '<?php return ' . var_export($config, true) . ';');
          $configUpdated = true; 
         
          \Artisan::call('config:cache');
      } catch (\Exception $e) {
          $configUpdated = false;
      }
     
      return view('sitsinstafeed::insta-feed', compact('apiToken', 'configUpdated'));
  }
  

}
