<?php

use App\Http\Controllers\Api\V1\CompletePercentageController;
use App\Http\Controllers\Api\V1\PercentageController;
use App\Http\Controllers\Api\V1\UserProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function () {
    Route::apiResource('/percentage', PercentageController::class);
    Route::patch('/percentages/{percentage}/complete', CompletePercentageController::class);
    Route::get('/profile', [UserProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
    Route::middleware(['auth:sanctum'])->patch('/v1/percentages/{id}/complete', [PercentageController::class, 'update']);

});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
