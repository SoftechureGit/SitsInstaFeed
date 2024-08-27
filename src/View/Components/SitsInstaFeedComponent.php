<?php
// namespace Sits\SitsInstaFeed\View\Components;

// use Illuminate\View\Component;

// class SitsInstaFeedComponent extends Component
// {
//     public $exampleProp;

//     public function __construct($exampleProp)
//     {
//         $this->exampleProp = $exampleProp;
        
//     }

//     public function render()
//     {
//         return view('sitsinstafeed::components.sits-insta-feed-component');
//     }
// }

namespace Sits\SitsInstaFeed\View\Components;

use Illuminate\View\Component;
use Sits\SitsInstaFeed\SitsInstaFeedServiceProvider;

class SitsInstaFeedComponent extends Component
{
    // public $exampleProp;
    public $layoutType;
    public $numberOfPosts;
    protected $mediaType;

    public function __construct($layoutType = null, $numberOfPosts = null, $mediaType = null )
    {
        
     
        $this->layoutType      =   $layoutType;
        $this->numberOfPosts   =   $numberOfPosts;
        $this->mediaType       =   $mediaType;

        $this->serviceProvider =   new SitsInstaFeedServiceProvider(app()); // Injecting via app() helper
    }

    public function getSomeData()
    {
        
        // Call a function from the service provider
        return $this->serviceProvider->getSitsComponentData($this->layoutType, $this->numberOfPosts, $this->mediaType);
    }

    public function render()
    {
        $someData = $this->getSomeData(); // Example of using the service provider
        $someData = (object)$someData->data;
// dd($someData);
        return view('sitsinstafeed::components.sits-insta-feed-component', compact('someData'));  
    }
}

