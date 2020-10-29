<?php
/**
 * Namespace Web
 * php version 7.4.10
 * 
 * @category Route
 * @package  Routes
 * @author   ranghivanhuy <ranghivanhuy@gmail.com>
 * @license  The MIT License (MIT) Copyright © ranghivanhuy
 * @link     https://github.com/ranghivanhuy/laravel
 */
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

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

Route::get('/', function () {
    return view('layouts.master');
});

Route::group(['prefix' => 'products'], function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('/create', [ProductController::class, 'create'])
        ->name('products.create');
    Route::post('/create', [ProductController::class, 'store'])
        ->name('products.store');
    Route::get('/edit/{id}', [ProductController::class, 'edit'])
        ->name('products.edit');
    Route::put('/edit/{id}', [ProductController::class, 'update'])
        ->name('products.update');
    Route::delete('/destroy', [ProductController::class, 'destroy'])
        ->name('products.destroy'); // Destroy single product
    Route::delete('/delete/{id}', [ProductController::class, 'deleteProductImage'])
        ->name('products.delete'); // Delete image from product image
    Route::delete('/prodDelete/{id}', [ProductController::class, 'deleteOnlyImage'])
        ->name('products.prodDelete'); // Delete image from product image
});

Route::group(['prefix' => 'categories'], function () {
    Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/create', [CategoryController::class, 'create'])
        ->name('categories.create');
    Route::post('/create', [CategoryController::class, 'store'])
        ->name('categories.store');
    Route::get('/edit/{id}', [CategoryController::class, 'edit'])
        ->name('categories.edit');
    Route::put('/edit/{id}', [CategoryController::class, 'update'])
        ->name('categories.update');
    Route::get('/show/{id}', [CategoryController::class, 'show'])
        ->name('categories.show');
    Route::delete('/destroy/{id}', [CategoryController::class, 'destroy'])
        ->name('categories.destroy');
});
