[View Document](https://htmlpreview.github.io/?https://github.com/SoftechureGit/SitsInstaFeed/blob/main/docs/index.html).

# SITS INSTA FEED PACKAGE

The `sits-insta-feed` package provides a simple way to integrate Instagram feeds into your Laravel project. Follow the steps below to install and use the package.

## Installation

1.  **Create a Laravel Project**

    Set your `APP_URL` and `ASSET_URL` in `.env` file as needed.

2.  **Install the Package**

    Run the following command to require the package via Composer:

    composer require sits/sits-insta-feed

3.  **Register Provider**

    Open the `config/app.php` file and add the service provider to the providers array:

        'providers' => [
            Sits\SitsInstaFeed\SitsInstaFeedServiceProvider::class,
        ],

    **Note:** If your Laravel version is 11 or higher, register the provider in `bootstrap/providers.php`:

        return [
            Sits\SitsInstaFeed\SitsInstaFeedServiceProvider::class,
        ];

4.  **Publish Package Assets**

    Publish the package assets by running the following Artisan command:

    php artisan vendor:publish --provider="Sits\\SitsInstaFeed\\SitsInstaFeedServiceProvider"

5.  **Obtain API Token**

    - **Initial Setup**

      Navigate to `{website-url}/sits-insta-feed-home` in your browser

      1.  Click "Continue with Instagram"
      2.  You will be redirected to the social feed login page

    - **Authentication** **For New Users:**
      1.  Click "Register"
      2.  Create a new account
      3.  Log in with your newly created credentials
    - **For Existing Users:**
      1.  Simply log in with your existing credentials
    - **Connecting Instagram**
      1.  After successful login, locate the Instagram tab in the sidebar
      2.  Click "Link Instagram Account"
      3.  Log in to your Instagram account when prompted
      4.  Grant the necessary permissions
      5.  You will be redirected back to your project URL
    - **Verification**

      After completing the process, verify that the configuration file has been updated:

          config/sits_insta_feed.php

    - **Troubleshooting**

      If you encounter any issues:

      - Ensure all permissions were granted correctly
      - Verify that you're logged into the correct Instagram account
      - Check your internet connection
      - Clear browser cache if needed

    **Note:** If the `config/sits_insta_feed.php` does not have the API token, repeat the step if needed.

## Usage

1.  **Import the Service Provider**

    In your controller or wherever you want to use the package, import the `SitsInstaFeedServiceProvider`:

        use Sits\SitsInstaFeed\SitsInstaFeedServiceProvider;

2.  **Fetch Feed Data**

    Create a method in your controller to fetch and return the Instagram feed data:

        public function home() {
            $provider = new SitsInstaFeedServiceProvider(app());
            return $provider->getSitsFeedJson();
        }

3.  **Get HTML Content**

    To fetch the HTML content of the posts with predefined widgets:

        $provider = new SitsInstaFeedServiceProvider(app());
        $data = $provider->getSitsContent('widget_type', 'media-type', 'number_of_post');
        $htmlContent = $data->data;

    Arguments explanation:

    - widget_type: 'slider' or 'grid' layout

      **Slider layout** ![grid](https://raw.githubusercontent.com/SoftechureGit/SitsInstaFeed/main/docs/asset/grid.png)

      **Grid layout** ![slider](https://raw.githubusercontent.com/SoftechureGit/SitsInstaFeed/main/docs/asset/slider.png)

    - media_type: 'image' or 'video'

      If you want all media types, leave it blank. `''`

    - number_of_post: Number of posts to fetch
