<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\BillController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StatisticIndexController;
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

    Route::get('/racuni', [BillController::class, 'index'])->name('bills');
    Route::post('/racuni/store', [BillController::class, 'store'])->name('bills.store');
    Route::get('/racuni/create', [BillController::class, 'create'])->name('bills.create');
    Route::get('/racuni/{bill}', [BillController::class, 'edit'])->name('bills.edit');
    Route::patch('/racuni/{bill}', [BillController::class, 'update'])->name('bills.update'); 
    Route::delete('/racuni/{bill}', [BillController::class, 'destroy'])->name('bills.destroy'); 

    Route::get('/kategorije', [CategoryController::class, 'index'])->name('categories');
    Route::post('/kategorije/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/kategorije/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::get('/kategorije/{category}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::patch('/kategorije/{category}', [CategoryController::class, 'update'])->name('categories.update'); 
    Route::delete('/kategorije/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy'); 

    Route::get('/prodavnice', [StoreController::class, 'index'])->name('stores');
    Route::post('/prodavnice/store', [StoreController::class, 'store'])->name('store.store');
    Route::get('/prodavnice/create', [StoreController::class, 'create'])->name('store.create');
    Route::get('/prodavnice/{store}', [StoreController::class, 'edit'])->name('store.edit');
    Route::patch('/prodavnice/{store}', [StoreController::class, 'update'])->name('store.update'); 
    Route::delete('/prodavnice/{store}', [StoreController::class, 'destroy'])->name('store.destroy'); 

    Route::get('/proizvodi', [ProductController::class, 'index'])->name('products');
    Route::post('/proizvodi/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/proizvodi/create', [ProductController::class, 'create'])->name('products.create');
    Route::get('/proizvodi/{product}', [ProductController::class, 'edit'])->name('products.edit');
    Route::patch('/proizvodi/{product}', [ProductController::class, 'update'])->name('products.update'); 
    Route::delete('/proizvodi/{product}', [ProductController::class, 'destroy'])->name('products.destroy'); 
    
    Route::get('/duzina-garancije', [WarrantyLengthController::class, 'index'])->name('warranty_lengths');
    Route::post('/duzina-garancije/store', [WarrantyLengthController::class, 'store'])->name('warranty_lengths.store');
    Route::get('/duzina-garancije/create', [WarrantyLengthController::class, 'create'])->name('warranty_lengths.create');
    Route::get('/duzina-garancije/{warrantyLength}', [WarrantyLengthController::class, 'edit'])->name('warranty_lengths.edit');
    Route::patch('/duzina-garancije/{warrantyLength}', [WarrantyLengthController::class, 'update'])->name('warranty_lengths.update'); 
    Route::delete('/duzina-garancije/{warrantyLength}', [WarrantyLengthController::class, 'destroy'])->name('warranty_lengths.destroy'); 
    
    Route::get('/statistika', StatisticIndexController::class)->name('statistics'); 
});

require __DIR__.'/auth.php';
