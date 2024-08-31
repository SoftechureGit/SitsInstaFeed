<?php

use Illuminate\Support\Facades\Route;
use Sits\SitsInstaFeed\Http\Controllers\InstagramController;
use Sits\SitsInstaFeed\Http\Controllers\HomeController;

Route::get('sits-insta-feed-home', [HomeController::class, 'index']);
Route::post('update-config', [HomeController::class, 'updateConfig'])->name('update_config');