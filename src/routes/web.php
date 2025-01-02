<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/products', [ProductController::class, 'index']);
Route::post('/search',
[ProductController::class, 'search']);
Route::get('/products/{id}',
[ProductController::class, 'detail'])->name('products.detail');
Route::get('/products/{id}/update',
[ProductController::class, 'update'])->name('product.update');
Route::post('/delete', [ProductController::class, 'delete']);
Route::post('/update', [ProductController::class, 'update']);
Route::post('/add',[ProductController::class,'add']);
Route::post('/store',[ProductController::class,'store']);