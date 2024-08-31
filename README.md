# Sits Insta Feed Package

The `sits-insta-feed` package provides a simple way to integrate Instagram feeds into your Laravel project. Follow the steps below to install and use the package.

## Installation

1. **Create a Laravel Project**

   Set your `APP_URL` and `ASSET_URL` in `.env` file as needed.

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

   Follow the on-screen instructions to generate an API token. Once you have completes the process, check that `config/sits_insta_feed.php` file get updated.

   ```bash
    return [
    'api_token' => 'your_copied_api_token',
    ];
   ```

   `Note:-` if the `config/sits_insta_feed.php` does not have the api token repeat the step if needed.

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

3. **Get HTML content**

   To fetch the `html` content of the posts of link account with predefine widgit's, you can use the

   ```bash
    getSitsContent('widgit_type', 'media_type', 'number_of_post');

    $provider = new SitsInstaFeedServiceProvider(app());
    $data = $provider->getSitsContent('widgit_type', 'media-type', 'number_of_post');
    $htmlContnent = $data->data;
   ```

   Where arguments holdes the values like:
   `widgit_type` : `slider` and `grid`, it means the post content comes in these layout.
   `media_type` : It is the type of media of your posts weather you want only `image` or `video`.
   `number_of_post` : How many posts you want to fetch.
