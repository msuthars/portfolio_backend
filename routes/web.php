<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\GuildController;
use App\Http\Controllers\Admin\QuestController;
use App\Http\Controllers\Admin\TagController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/admin');

Route::prefix('admin')->name('admin.')->group(function () {

    // Only for visitors who are NOT logged in
    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('login', [AuthController::class, 'login'])->middleware('throttle:5,1');
    });

    // Only for logged-in users (like `_user_is_logged_in: 'TRUE'`)
    Route::middleware('auth')->group(function () {
        Route::view('/', 'admin.dashboard')->name('dashboard');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::resource('tags', TagController::class)->except('show');
        Route::resource('guilds', GuildController::class)->except('show');
        Route::resource('quests', QuestController::class)->except('show');
    });
});
