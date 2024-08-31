@extends('sitsinstafeed::layouts.app')
@section('styles')
    <style>
        .alert {
            border: 0;
            color: white;
            width: 100%;
        }

        .alert-success {
            background-color: #1a657c;
        }

        .alert-danger {
            background-color: #1a657c;
        }
    </style>
@endsection
@section('section')
    <div class="container">
        <div class="row continue-with-insta">

            <div class="col-md-6 card-container flex-center flex-column">

                @if (isset($configUpdated) && $apiToken)
                    @if ($configUpdated)
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Package Setup Is Done Sucessfully!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @else
                        <div class="alert alert-danger alert-dismissible fade show " role="alert">
                            Some Error Occure Try Again !
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                @endif
                <div class="home-content">
                    <img src="https://www.softechure.com/assets/front/images/logo.png" alt="logo"
                        class="img-fluid pb-4">
                    <p class="pb-4">Softechure's Sits Insta Feed allows you to seamlessly fetch and display Instagram
                        feeds on your website.</p>

                    @if (isset($configUpdated))
                        @if ($configUpdated && $apiToken)
                            <a href="{{ url('') }}" class="instagram-button mb-4">Home</a>
                        @else
                            <a href="{{ 'https://website4test.com/social_feed/socialFeed/?redirect_url=' . url('/sits-insta-feed-home') }}"
                                class="instagram-button mb-4">Continue With Instagram</a>
                        @endif
                    @endif


                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.location.hash === '#_') {
                history.replaceState(null, null, window.location.href.split('#')[0]);
            }
        });
    </script>
@endsection
