<?php

use Illuminate\Support\Facades\Route;
use Sits\SitsInstaFeed\Http\Controllers\InstagramController;
use Sits\SitsInstaFeed\Http\Controllers\HomeController;

Route::get('auth/instagram', [InstagramController::class, 'redirectToInstagram'])->name('auth.instagram');
Route::get('auth/instagram/callback', [InstagramController::class, 'handleInstagramCallback']);
Route::get('instagram_feed', [InstagramController::class, 'instagramFeed']);
Route::get('sits-insta-feed-home', [HomeController::class, 'index']);
