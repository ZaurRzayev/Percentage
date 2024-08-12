<?php

use App\Http\Controllers\Api\V1\UserProfileController;
use App\Http\Controllers\Api\V1\PostController;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');

})->name('dashboard');

Route::post('/send-id', [JobController::class, 'sendId']);


Route::get('/', [PostController::class, 'index']);
Route::post('/save', [PostController::class, 'save']);
Route::post('/send-id', [JobController::class, 'sendId']);
Route::middleware(['auth'])->group(function () {
//    Route::get('/profile', [UserProfileController::class, 'show'])->name('profile.show');
//    Route::get('/profile/edit', [UserProfileController::class, 'edit'])->name('profile.edit');
//    Route::put('/profile/{user}', [UserProfileController::class, 'update'])->name('profile.update');
//    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
//    Route::get('/', [PostController::class, 'index']);


});

require __DIR__.'/auth.php';
