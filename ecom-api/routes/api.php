<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Public routes
Route::prefix('v1')->group(function() {
    Route::POST('register', 'UserController@register');
    Route::POST('login', 'UserController@login');
});

Route::middleware(['auth:api'])->prefix('v1')->group(function() {
    // Product
    Route::POST('product', 'ProductController@storeProduct');
    Route::PUT('product/{productId}', 'ProductController@updateProduct');
    Route::DELETE('product/{productId}', 'ProductController@deleteProduct');
    Route::GET('product/{productId}', 'ProductController@getProduct');
    Route::GET('product', 'ProductController@getProducts');

    // Order
    Route::POST('order', 'OrderController@createOrder');
    // Route::PUT('order/{orderId}', 'OrderController@updateOrder');
    // Route::DELETE('order/{orderId}', 'OrderController@cancelOrder');
});