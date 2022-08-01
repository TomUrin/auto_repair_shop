<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkshopController as W;
use App\Http\Controllers\MechanicController as M;
use App\Http\Controllers\ServiceController as S;
use App\Http\Controllers\OrderController as O;

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
    return view('welcome');
});

// //Front
Route::get('', [W::class, 'pick'])->name('workshops-pick');

// Workshops

Route::prefix('workshops')->name('workshops-')->group(function () {
    Route::get('', [W::class, 'index'])->name('index');
    Route::get('create', [W::class, 'create'])->name('create');
    Route::post('', [W::class, 'store'])->name('store');
    Route::get('edit/{workshop}', [W::class, 'edit'])->name('edit');
    Route::put('{workshop}', [W::class, 'update'])->name('update');
    Route::delete('{workshop}', [W::class, 'destroy'])->name('delete');
    Route::get('show/{id}', [W::class, 'show'])->name('show');    
});

// Mechanics

Route::prefix('mechanics')->name('mechanics-')->group(function () {
    Route::get('', [M::class, 'index'])->name('index');
    Route::get('create', [M::class, 'create'])->name('create');
    Route::post('', [M::class, 'store'])->name('store');
    Route::get('edit/{mechanic}', [M::class, 'edit'])->name('edit');
    Route::put('{mechanic}', [M::class, 'update'])->name('update');
    Route::delete('{mechanic}', [M::class, 'destroy'])->name('delete');
    Route::get('show/{id}', [M::class, 'show'])->name('show');
    Route::put('delete-picture/{mechanic}', [M::class, 'deletePicture'])->name('delete-picture'); 
});

// Services

Route::prefix('services')->name('services-')->group(function () {
    Route::get('', [S::class, 'index'])->name('index');
    Route::get('create', [S::class, 'create'])->name('create');
    Route::post('', [S::class, 'store'])->name('store');
    Route::get('edit/{services}', [S::class, 'edit'])->name('edit');
    Route::put('{services}', [S::class, 'update'])->name('update');
    Route::delete('{services}', [S::class, 'destroy'])->name('delete');
    Route::get('show/{id}', [S::class, 'show'])->name('show');    
});

// Orders

Route::post('add-animal-to-order', [O::class, 'add'])->name('selectedServices-add');
Route::get('my-orders', [O::class, 'showMyOrders'])->name('my-orders');
Route::prefix('order')->name('selectedServices-')->group(function () {
    Route::get('', [O::class, 'index'])->name('index');
    Route::put('status/{order}', [O::class, 'setStatus'])->name('status');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
