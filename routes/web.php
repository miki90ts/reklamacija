<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\BillController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WarrantyLengthController;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/bills', [BillController::class, 'index'])->name('bills');
    Route::post('/bills/store', [BillController::class, 'store'])->name('bills.store');
    Route::get('/bills/create', [BillController::class, 'create'])->name('bills.create');
    Route::get('/bills/{bill}', [BillController::class, 'edit'])->name('bills.edit');
    Route::patch('/bills/{bill}', [BillController::class, 'update'])->name('bills.update'); 
    Route::delete('/bills/{bill}', [BillController::class, 'destroy'])->name('bills.destroy'); 

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::get('/categories/{category}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::patch('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update'); 
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy'); 

    Route::get('/store', [StoreController::class, 'index'])->name('stores');
    Route::post('/store/store', [StoreController::class, 'store'])->name('store.store');
    Route::get('/store/create', [StoreController::class, 'create'])->name('store.create');
    Route::get('/store/{store}', [StoreController::class, 'edit'])->name('store.edit');
    Route::patch('/store/{store}', [StoreController::class, 'update'])->name('store.update'); 
    Route::delete('/store/{store}', [StoreController::class, 'destroy'])->name('store.destroy'); 

    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::get('/products/{product}', [ProductController::class, 'edit'])->name('products.edit');
    Route::patch('/products/{product}', [ProductController::class, 'update'])->name('products.update'); 
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy'); 
    
    Route::get('/warranty-lengths', [WarrantyLengthController::class, 'index'])->name('warranty_lengths');
    Route::post('/warranty-lengths/store', [WarrantyLengthController::class, 'store'])->name('warranty_lengths.store');
    Route::get('/warranty-lengths/create', [WarrantyLengthController::class, 'create'])->name('warranty_lengths.create');
    Route::get('/warranty-lengths/{warrantyLength}', [WarrantyLengthController::class, 'edit'])->name('warranty_lengths.edit');
    Route::patch('/warranty-lengths/{warrantyLength}', [WarrantyLengthController::class, 'update'])->name('warranty_lengths.update'); 
    Route::delete('/warranty-lengths/{warrantyLength}', [WarrantyLengthController::class, 'destroy'])->name('warranty_lengths.destroy'); 
});

require __DIR__.'/auth.php';
