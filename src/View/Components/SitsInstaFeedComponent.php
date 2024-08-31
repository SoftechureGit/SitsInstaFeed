<?php

namespace Sits\SitsInstaFeed\View\Components;

use Illuminate\View\Component;
use Sits\SitsInstaFeed\SitsInstaFeedServiceProvider;

class SitsInstaFeedComponent extends Component
{
   
    public $layoutType;
    public $numberOfPosts;
    protected $mediaType;

    public function __construct($layoutType = null, $numberOfPosts = null, $mediaType = null )
    {
        
     
        $this->layoutType      =   $layoutType;
        $this->numberOfPosts   =   $numberOfPosts;
        $this->mediaType       =   $mediaType;

        $this->serviceProvider =   new SitsInstaFeedServiceProvider(app());
    }

    public function getSomeData()
    {
        return $this->serviceProvider->getSitsComponentData($this->layoutType, $this->numberOfPosts, $this->mediaType);
    }

    public function render()
    {
        $someData = $this->getSomeData(); 
        $someData = (object)$someData->data;
        return view('sitsinstafeed::components.sits-insta-feed-component', compact('someData'));  
    }
}

