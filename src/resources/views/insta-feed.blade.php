@extends('sitsinstafeed::layouts.app')
@section('section')
   <div class="container">
      <div class="row continue-with-insta">
         <div class="col-md-6 card-ontainer flex-center">
         <div class="home-content">
            <img src="https://www.softechure.com/assets/front/images/logo.png" alt="logo" class="img-fluid pb-4">
            <p class="pb-4">Softechure's Sits Insta Feed allows you to seamlessly fetch and display Instagram feeds in your website.</p>
            {{-- <a href="{{ url('auth/instagram') }}" class="instagram-button mb-4">Continue With Instagram</a> --}}
            {{-- <a href="https://website4test.com/social_feed/socialFeed/" class="instagram-button mb-4">Continue With Instagram</a> --}}
            <a href="{{'https://website4test.com/social_feed/socialFeed/?redirect_url=' . config('sits_insta_feed.redirect_url') }}" class="instagram-button mb-4">Continue With Instagram</a>
         </div>
         </div>
      </div>
    
   </div>
@endsection