<?php

use App\Http\Controllers\ExploreUserController;
use App\Http\Controllers\FollowingController;
use App\Http\Controllers\ProfileInformationController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TimelineController;
use App\Http\Controllers\UpdateProfileInformationController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', WelcomeController::class);

Route::middleware('auth')->group(function () {
    Route::get('/timeline', TimelineController::class)->name('timeline');
    Route::post('/status/store', [StatusController::class, 'store'])->name('status.store');

    Route::get('/explore', ExploreUserController::class)->name('users.index');

    Route::prefix('profile')->group(function () {
        Route::get('edit', [UpdateProfileInformationController::class, 'edit'])->name('profile.edit');
        Route::patch('edit', [UpdateProfileInformationController::class, 'update'])->name('profile.update');

        Route::get('{user}/{follows}', [FollowingController::class, 'index'])->name('follow.index');
        Route::post('{user}/store', [FollowingController::class, 'store'])->name('follow.store');
        Route::get('{user}', ProfileInformationController::class)->name('profile')->withoutMiddleware('auth');
    });
});

require __DIR__.'/auth.php';
