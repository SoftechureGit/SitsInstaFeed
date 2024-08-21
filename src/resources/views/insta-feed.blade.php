{{-- @extends('sitsinstafeed::layouts.app')
@section('section')
   <div class="container">
      <div class="row continue-with-insta">
         <div class="col-md-6 card-ontainer flex-center">
         <div class="home-content">
            @dd($apiToken)
            <img src="https://www.softechure.com/assets/front/images/logo.png" alt="logo" class="img-fluid pb-4">
            <p class="pb-4">Softechure's Sits Insta Feed allows you to seamlessly fetch and display Instagram feeds in your website.</p>
             <a href="{{'https://website4test.com/social_feed/socialFeed/?redirect_url=' . url('/sits-insta-feed-home') }}" class="instagram-button mb-4">Continue With Instagram</a>
         </div>
         </div>
      </div>
    
   </div>
@endsection

@section('script')
   
@endsection --}}


@extends('sitsinstafeed::layouts.app')
@section('section')
   <div class="container">
      <div class="row continue-with-insta">
         <div class="col-md-6 card-container flex-center">
            <div class="home-content">
               <img src="https://www.softechure.com/assets/front/images/logo.png" alt="logo" class="img-fluid pb-4">
               <p class="pb-4">Softechure's Sits Insta Feed allows you to seamlessly fetch and display Instagram feeds on your website.</p>
               <a href="{{'https://website4test.com/social_feed/socialFeed/?redirect_url=' . url('/sits-insta-feed-home') }}" class="instagram-button mb-4">Continue With Instagram</a>

               @if($apiToken)
               <div class="mt-4 w-100">
                  <p class="text-start">Your API Token:</p>
                  <input type="text" id="apiToken" class="form-control mb-2" value="{{ $apiToken }}" readonly>
                  <p class="note-message  mb-2"><b>NOTE: </b>Copy the api token and place it to the <b>config/sits_insta_feed.php</b> file with 'api_token' key.</p>
                  <button id="copyButton" class="instagram-button">Copy</button>
               </div>
               @endif
            </div>
         </div>
      </div>
   </div>
@endsection

@section('script')
<script>
// copy
   document.addEventListener('DOMContentLoaded', function() {
      if (!window.copyButtonInitialized) { // Check if it's already initialized
         var copyButton = document.getElementById('copyButton');
         if (copyButton) {
            copyButton.addEventListener('click', function() {
               var apiToken = '{{ $apiToken }}';
               if (apiToken) {
                  navigator.clipboard.writeText(apiToken).then(function() {
                     alert('API Token copied to clipboard!');
                  }, function(err) {
                     console.error('Could not copy text: ', err);
                  });
               }
            });
         }
         window.copyButtonInitialized = true; // Mark as initialized
      }
   });

// copy end

// clean url
   document.addEventListener('DOMContentLoaded', function() {
      if (window.location.hash === '#_') {
         history.replaceState(null, null, window.location.href.split('#')[0]);
      }
   });
// clean url end
</script>
@endsection
