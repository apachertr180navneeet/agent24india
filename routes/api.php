<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api;
use App\Http\Controllers\Api\Auth;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');



// Auth Routes
Route::middleware('api')->post('send-otp', [Auth\LoginController::class, 'sendOtp'])->name('api.sendOtp');
Route::middleware('api')->post('login', [Auth\LoginController::class, 'store'])->name('api.login');
Route::middleware('api')->post('register', [Auth\LoginController::class, 'register'])->name('api.register');
// Route::middleware(['return-json', 'auth:api'])->post('/check-login', [Auth\LoginController::class, 'checkLogin'])->name('api.checkLogin');
Route::middleware('authenticates')->get('logout', [Auth\LoginController::class, 'logout']);
//------------

// Profile
Route::middleware(['api', 'auth:api'])->prefix('profile')->group(function(){
    Route::get('get', [Api\ProfileController::class, 'index']);
    Route::post('update', [Api\ProfileController::class, 'update']);
});