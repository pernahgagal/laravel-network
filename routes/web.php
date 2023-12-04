<?php

use App\Http\Controllers\FollowingController;
use App\Http\Controllers\ProfileInformationController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TimelineController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::middleware('auth')->group(function () {
    Route::get('/timeline', TimelineController::class)->name('timeline');
    Route::post('/status/store', [StatusController::class, 'store'])->name('status.store');

    Route::get('/profile/{user}/{follows}', FollowingController::class)->name('profile.follows');

    Route::get('/profile/{user}', ProfileInformationController::class)->name('profile')->withoutMiddleware('auth');
});

require __DIR__.'/auth.php';
