<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UrlController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:api')->group(function () {
    Route::resource('products', ProductController::class);
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/shorten', [UrlController::class, 'shorten']);
    Route::get('/{shortUrl}', [UrlController::class, 'redirect']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});