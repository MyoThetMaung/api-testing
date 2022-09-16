<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\PhotoApiController;
use App\Http\Controllers\ProductApiController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register',[ApiAuthController::class,'register'])->name('api.register');
Route::post('login',[ApiAuthController::class,'login'])->name('api.login');


Route::middleware(['auth:sanctum'])->group(function(){
    Route::post('logout',[ApiAuthController::class,'logout'])->name('api.logout');
    Route::post('logoutAll',[ApiAuthController::class,'logoutAll'])->name('api.logoutAll');
    Route::post('token',[ApiAuthController::class,'token'])->name('api.token');

    Route::apiResource('products',ProductApiController::class);
    Route::apiResource('photos',PhotoApiController::class);
});