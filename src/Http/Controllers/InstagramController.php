<?php

namespace Sits\SitsInstaFeed\Http\Controllers;
use GuzzleHttp\Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
// use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;

class InstagramController extends Controller
{
    public function redirectToInstagram()
    {
        // return Socialite::driver('instagram')->redirect();
        $appId = env('INSTAGRAM_CLIENT_ID');
        $redirectUri = urlencode(env('INSTAGRAM_REDIRECT_URI'));
        // return redirect()->to("https://api.instagram.com/oauth/authorize?app_id={$appId}&redirect_uri={$redirectUri}&scope=user_profile,user_media&response_type=code");
        return redirect()->to("https://api.instagram.com/oauth/authorize?app_id={$appId}&redirect_uri={$redirectUri}&scope=user_profile,user_media&response_type=code");
    }

    // public function redirectToInstagram()
    //     {
           
    //         $appId = env('INSTAGRAM_CLIENT_ID');
    //         $redirectUri = urlencode(env('INSTAGRAM_REDIRECT_URI'));
    //         $scope = 'instagram_graph_user_profile,instagram_graph_user_media';
    //         return redirect()->to("https://api.instagram.com/oauth/authorize?client_id={$appId}&redirect_uri={$redirectUri}&scope={$scope}&response_type=code");
    //     }


    public function handleInstagramCallback()
    {
       
       $code = request()->code;
    // return $code;

       // $appId = env('INSTAGRAM_CLIENT_ID');
       // $secret = env('INSTAGRAM_CLIENT_SECRET');
       // $redirectUri = env('INSTAGRAM_REDIRECT_URI');
   
       $client = new Client();
       # Get access token
       $response = $client->request('POST', 'https://api.instagram.com/oauth/access_token', [
                   'form_params'              =>   [
                       'app_id'               =>   env('INSTAGRAM_CLIENT_ID'),
                       'app_secret'           =>   env('INSTAGRAM_CLIENT_SECRET'),
                       'grant_type'           =>   'authorization_code',
                       'redirect_uri'         =>   env('INSTAGRAM_REDIRECT_URI'),
                       'code' => $code 
                       ]
       ]);
       
       $content = $response->getBody()->getContents(); // Get the response body content
       $data = json_decode($content, true); 
       
       $accessToken    =     $data['access_token'];
       return $data;
    }

    public function instagramFeed(){
     
        
        $response = Http::get('https://graph.instagram.com/me/media', [
                         'fields'          =>     'id,caption,media_type,media_url,permalink,thumbnail_url,timestamp,username',
                         //for tester
                         'access_token'    =>     'IGQWRNR1c3aWpOV056SWxudURtVEJWV1VzUkxCanhfOExZAcWxvd1h0N2x6SkVRREg5STZA6Vm1YQkM1UThSeTV6TllhNlowR0hJaTFlTElMaFVEbDI4VmlfWWxqQjJxeFRfcmNBdkt0bmpoVWttQm5fNWwyanZAMNWFTVG5MZADBWYk9ZAZAwZDZD'
                         //for user   
                        //  'access_token'    =>     'IGQWRNaWozdUZApeGsyMFhKZAnZA2d1FZANDg3TkdreGRqMHZABdlhMZAjVmLWR1RTN2U000U2lfNnREcFpoY0ZALOHNhLWpiTldKMlNuU25aOGx5Umg2c3RfTW5ucVIwRTBtVFlDSXczNmRrWTBEZAnRubXZAEeHQ0ZAEJnMXdTdk45a09LR1ZANSVUZD'
                    ]);
                    
        return $response->json();
        // Define the file path
        $instagramPostFilePath = storage_path('app/instagram/instagram_post.json');

        // Ensure the directory exists
        $directory = dirname($instagramPostFilePath);
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true); // Create the directory with appropriate permissions
        }

        // Write the JSON data to the file
        File::put($instagramPostFilePath, json_encode($response->json(), JSON_PRETTY_PRINT));
        
        
        // return redirect('/admin/instagram-single');
        
        return $response->json();
        
    }
    
}
