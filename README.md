# Sits Insta Feed Package

The `sits-insta-feed` package provides a simple way to integrate Instagram feeds into your Laravel project. Follow the steps below to install and use the package.

## Installation

1. **Create a Laravel Project**

   Set your base URL and asset URL as needed.

2. **Install the Package**

   Run the following command to require the package via Composer:

   ```bash
   composer require sits/sits-insta-feed
   ```

3. **Register Provider**
   Open the `config/app.php` file and add the service provider to the providers array:
   ```bash
   'providers' => [
    Sits\SitsInstaFeed\SitsInstaFeedServiceProvider::class,
   ],
   ```
   If your laravel version is 11 or higher than you have to register the provider in `bootstrap/providers.php` like:
   ```bash
   return [
       Sits\SitsInstaFeed\SitsInstaFeedServiceProvider::class,
   ];
   ```
4. **Publish Package Assets**
   Publish the package assets by running the following Artisan command:
   ```bash
   php artisan vendor:publish --provider="Sits\SitsInstaFeed\SitsInstaFeedServiceProvider"
   ```
5. **Obtain API Token**
   Access the URL to complete the setup and obtain your API token:
   ```bash
   /sits-insta-feed-home
   ```
   Follow the on-screen instructions to receive an API token. Once you have the token, update the `config/sits_insta_feed.php` configuration file with the token:
   ```bash
    return [
    'api_token' => 'your_copied_api_token',
    ];
   ```

## Usage

1. **Import the Service Provider**
   In your controller or wherever you want to use the package, import the `SitsInstaFeedServiceProvider`:

   ```bash
   use Sits\SitsInstaFeed\SitsInstaFeedServiceProvider;
   ```

2. **Fetch Feed Data**
   Create a method in your controller to fetch and return the Instagram feed data. Example:

   ```bash
   public function home() {
       $provider = new SitsInstaFeedServiceProvider(app());
       return $provider->getSitsFeedJson();
   }
   ```

   Replace home with the appropriate method name or context where you need to display the Instagram feed data.

3. **Functions You Can Call**
   a. To fetech the URL of the posts of link account you can use the
   ```bash
    getSitsUrl($type);

    $provider = new SitsInstaFeedServiceProvider(app());
    return $provider->getSitsUrl('slider');
   ```
   Wher type can be `"slider"` or `"grid"`, it will return the appropriate url according to input.
   b. To fetech the json of the posts of link account you can use the
   ```bash
   getSitsFeedJson();

   $provider = new SitsInstaFeedServiceProvider(app());
   return $provider->getSitsFeedJson();
   ```
