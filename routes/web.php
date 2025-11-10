<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Livewire\Actions\Logout;

Route::post('/logout', Logout::class)->name('logout');

Route::resource('posts', PostController::class)->middleware('auth');


Route::middleware(['auth'])->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('posts.index');
    Route::resource('posts', PostController::class);
    Route::view('profile', 'profile')->name('profile');
});

require __DIR__ . '/auth.php';
