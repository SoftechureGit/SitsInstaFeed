<?php

namespace Sits\SitsInstaFeed\Http\Controllers;
// use GuzzleHttp\Client;
// use Carbon\Carbon;
// use Illuminate\Support\Facades\Http;
// use Illuminate\Support\Facades\File;
// use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
   // public function index(){
   //    //return $apiKey = config('sits_insta_feed.redirect_url');
   //    $apiToken   =   request()->filled('api_token') ? request()->input('api_token') : null;
   //    #test
   //    $key        =   'api_token'; 
   //    $value      =   $apiToken;
   //    // Update the configuration array
   //    $configPath =   config_path('sits_insta_feed.php');
   //    $config     =   File::getRequire($configPath);

   //    // Modify the configuration
   //    $keys  = explode('.', $key);
   //    $array = &$config;
   //    foreach ($keys as $keyPart) {
   //       if (!isset($array[$keyPart])) {
   //             $array[$keyPart] = [];
   //       }
   //       $array = &$array[$keyPart];
   //    }
   //    $array    = $value;

   //    // Save the updated configuration to the file
   //    File::put($configPath, '<?php return ' . var_export($config, true) . ';');

   //    // Optionally, you might want to clear the config cache
   //    \Artisan::call('config:cache');

   //    #test end
   //    return view('sitsinstafeed::insta-feed', compact('apiToken'));
   // }

   public function index() {
      $apiToken = request()->filled('api_token') ? request()->input('api_token') : null;
  
      $key = 'api_token'; 
      $value = $apiToken;
      $configUpdated = false;  // Initialize a flag for the update status
  
      try {
          // Update the configuration array
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
  
          // Save the updated configuration to the file
          File::put($configPath, '<?php return ' . var_export($config, true) . ';');
          $configUpdated = true;  // Set the flag to true if the update is successful
  
          // Clear the config cache
          \Artisan::call('config:cache');
      } catch (\Exception $e) {
          $configUpdated = false;  // Set the flag to false if there's an error
      }
      // $configUpdated = false;
      return view('sitsinstafeed::insta-feed', compact('apiToken', 'configUpdated'));
  }
  

//    public function updateConfig(Request $request)
//     {
//         dd('jumbo');
//       return $request->api_token;
//         $key = $request->input('key'); 
//         $value = $request->input('value');
//         // Update the configuration array
//         $configPath = config_path('app.php');
//         $config = File::getRequire($configPath);

//         // Modify the configuration
//         $keys = explode('.', $key);
//         $array = &$config;
//         foreach ($keys as $keyPart) {
//             if (!isset($array[$keyPart])) {
//                 $array[$keyPart] = [];
//             }
//             $array = &$array[$keyPart];
//         }
//         $array = $value;

//         // Save the updated configuration to the file
//         File::put($configPath, '<?php return ' . var_export($config, true) . ';');

//         // Optionally, you might want to clear the config cache
//         \Artisan::call('config:cache');

//         return response()->json(['message' => 'Configuration updated successfully.']);
//     }
}
