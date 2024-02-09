<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('Writers.index');
});

Auth::routes();

Route::get('/available', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/bids', [App\Http\Controllers\HomeController::class, 'Bids'])->name('bids');
Route::get('/revision', [App\Http\Controllers\HomeController::class, 'revision'])->name('revision');
Route::get('/dispute', [App\Http\Controllers\HomeController::class, 'Dispute'])->name('dispute');
Route::get('/current', [App\Http\Controllers\HomeController::class, 'current'])->name('current');
Route::get('/finished', [App\Http\Controllers\HomeController::class, 'Finished'])->name('finished');
Route::get('/order/{id}', [App\Http\Controllers\HomeController::class, 'order'])->name('order');
Route::get('/new_order',[App\Http\Controllers\HomeController::class, 'new_order']);
Route::get('/new_files',[App\Http\Controllers\HomeController::class, 'new_files'])->name('new_files');

//post new order
Route::post('/orders', [App\Http\Controllers\DataController::class, 'orders'])->name('orders');
