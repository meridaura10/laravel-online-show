<?php

use App\Http\Controllers\BasketController;
use App\Http\Middleware\AdminCheckMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



Auth::routes();
Route::resource('products', \App\Http\Controllers\ProductController::class);
Route::resource('categories', \App\Http\Controllers\CategoryController::class);
Route::resource('orders', \App\Http\Controllers\OrderController::class);

// Route::prefix('test')->name('test.')->controller(TestController::class)->group(function (){
//     Route::get('/', 'index')->name('index');
// });

Route::post('/response/{order}', [\App\Http\Controllers\PaymentController::class, 'response'])->name('response');

Route::get('/basket', [BasketController::class, 'index'])->name('basket.index')->middleware('auth');
Route::post('/basket/add', [BasketController::class, 'addToBasket'])->name('basket.add')->middleware('auth');

Route::get('/user', [\App\Http\Controllers\User\UserController::class, 'show'])->name('user.show')->middleware('auth');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


