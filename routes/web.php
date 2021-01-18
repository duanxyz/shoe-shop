<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemDetailsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RajaOngkirController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ShowAllController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    ]);
});

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('details/{id}', [ItemDetailsController::class, 'index'])->name('details');
    Route::resource('cart', CartController::class);
    Route::get('buy-directly/{item}/quantity/{quantity}', [OrderController::class, 'index'])->name('buy_directly');
    Route::resource('order', OrderController::class);
    Route::post('ongkos-kirim', [RajaOngkirController::class, 'getCost'])->name('ongkos-kirim');
    Route::get('show-all/{filter}', [ShowAllController::class, 'index'])->name('show-all');
    Route::get('search', [SearchController::class, 'index'])->name('search');
});
