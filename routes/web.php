<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\BillController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LanguageStoreController;
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

Route::post('/language', LanguageStoreController::class)->name('language.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/racuni', [BillController::class, 'index'])->name('racuni');
    Route::post('/racuni/sacuvaj', [BillController::class, 'store'])->name('racuni.store');
    Route::get('/racuni/unos', [BillController::class, 'create'])->name('racuni.create');
    Route::get('/racuni/{bill}', [BillController::class, 'edit'])->name('racuni.edit');
    Route::patch('/racuni/{bill}', [BillController::class, 'update'])->name('racuni.update'); 
    Route::delete('/racuni/{bill}', [BillController::class, 'destroy'])->name('racuni.destroy'); 

    Route::get('/kategorije', [CategoryController::class, 'index'])->name('kategorije');
    Route::post('/kategorije/sacuvaj', [CategoryController::class, 'store'])->name('kategorije.store');
    Route::get('/kategorije/unos', [CategoryController::class, 'create'])->name('kategorije.create');
    Route::get('/kategorije/{category}', [CategoryController::class, 'edit'])->name('kategorije.edit');
    Route::patch('/kategorije/{category}', [CategoryController::class, 'update'])->name('kategorije.update'); 
    Route::delete('/kategorije/{category}', [CategoryController::class, 'destroy'])->name('kategorije.destroy'); 

    Route::get('/brands', [BrandController::class, 'index'])->name('brands');
    Route::post('/brands/sacuvaj', [BrandController::class, 'store'])->name('brands.store');
    Route::get('/brands/unos', [BrandController::class, 'create'])->name('brands.create');
    Route::get('/brands/{brand}', [BrandController::class, 'edit'])->name('brands.edit');
    Route::patch('/brands/{brand}', [BrandController::class, 'update'])->name('brands.update'); 
    Route::delete('/brands/{brand}', [BrandController::class, 'destroy'])->name('brands.destroy'); 

    Route::get('/prodavnice', [StoreController::class, 'index'])->name('prodavnice');
    Route::post('/prodavnice/sacuvaj', [StoreController::class, 'store'])->name('prodavnice.store');
    Route::get('/prodavnice/unos', [StoreController::class, 'create'])->name('prodavnice.create');
    Route::get('/prodavnice/{store}', [StoreController::class, 'edit'])->name('prodavnice.edit');
    Route::patch('/prodavnice/{store}', [StoreController::class, 'update'])->name('prodavnice.update'); 
    Route::delete('/prodavnice/{store}', [StoreController::class, 'destroy'])->name('prodavnice.destroy'); 

    Route::get('/proizvodi', [ProductController::class, 'index'])->name('proizvodi');
    Route::post('/proizvodi/sacuvaj', [ProductController::class, 'store'])->name('proizvodi.store');
    Route::get('/proizvodi/unos', [ProductController::class, 'create'])->name('proizvodi.create');
    Route::get('/proizvodi/{product}', [ProductController::class, 'edit'])->name('proizvodi.edit');
    Route::patch('/proizvodi/{product}', [ProductController::class, 'update'])->name('proizvodi.update'); 
    Route::delete('/proizvodi/{product}', [ProductController::class, 'destroy'])->name('proizvodi.destroy'); 
    
    Route::get('/duzina_garancije', [WarrantyLengthController::class, 'index'])->name('duzina_garancije');
    Route::post('/duzina_garancije/sacuvaj', [WarrantyLengthController::class, 'store'])->name('duzina_garancije.store');
    Route::get('/duzina_garancije/unos', [WarrantyLengthController::class, 'create'])->name('duzina_garancije.create');
    Route::get('/duzina_garancije/{warrantyLength}', [WarrantyLengthController::class, 'edit'])->name('duzina_garancije.edit');
    Route::patch('/duzina_garancije/{warrantyLength}', [WarrantyLengthController::class, 'update'])->name('duzina_garancije.update'); 
    Route::delete('/duzina_garancije/{warrantyLength}', [WarrantyLengthController::class, 'destroy'])->name('duzina_garancije.destroy'); 
    
    Route::get('/statistika', StatisticIndexController::class)->name('statistika'); 
});

require __DIR__.'/auth.php';
