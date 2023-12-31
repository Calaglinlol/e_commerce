<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware('check.dirty:api')->group(function () {
//     Route::resource('products', ProductController::class);
// });

Route::resource('products', ProductController::class);
Route::post('signup', [AuthController::class, 'signup']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:api')->group(function () {
    Route::get('user', [AuthController::class, 'user']);   
    Route::get('logout', [AuthController::class, 'logout']);   
    Route::post('carts/checkout', [CartController::class, 'checkout']);   
    Route::resource('carts', CartController::class);
    Route::resource('cart-items', CartItemController::class);
});
