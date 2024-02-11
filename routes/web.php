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
    return view('Auth.login');
});

Auth::routes();

Route::get('/available', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('index');

Route::get('/bids', [App\Http\Controllers\HomeController::class, 'Bids'])->name('bids');
Route::get('/revision', [App\Http\Controllers\HomeController::class, 'revision'])->name('revision');
Route::get('/dispute', [App\Http\Controllers\HomeController::class, 'Dispute'])->name('dispute');
Route::get('/current', [App\Http\Controllers\HomeController::class, 'current'])->name('current');
Route::get('/finished', [App\Http\Controllers\HomeController::class, 'Finished'])->name('finished');
Route::get('/order/{OrderId}', [App\Http\Controllers\HomeController::class, 'order'])->name('order');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
Route::get('/new_order',[App\Http\Controllers\HomeController::class, 'new_order']);
Route::get('/new_files/{id}',[App\Http\Controllers\HomeController::class, 'new_files'])->name('new_files');
Route::get('/users', [App\Http\Controllers\HomeController::class, 'users'])->name('users');
Route::get('/order_details/{id}', [App\Http\Controllers\HomeController::class, 'order_details'])->name('order_details');
Route::get('/assignOrders', [App\Http\Controllers\HomeController::class, 'AssignOrdera'])->name('AssignOrders');
Route::get('/orders/{OrderId}', [App\Http\Controllers\HomeController::class, 'AssignedOrder'])->name('assignedOrders');

//post new order
Route::post('/orders', [App\Http\Controllers\DataController::class, 'orders'])->name('orders');
Route::post('/get_files/{id}',[App\Http\Controllers\DataController::class, 'files'])->name('get_files');
Route::post('/place_bid/{id}',[App\Http\Controllers\DataController::class, 'place_bid'])->name('place_bid');
Route::post('/remove_bid/{id}',[App\Http\Controllers\DataController::class, 'remove_bid'])->name('remove_bid');
Route::post('/available/{id}',[App\Http\Controllers\DataController::class, 'available'])->name('available');
Route::post('/changeUser/{id}',[App\Http\Controllers\SupportController::class, 'changeUser'])->name('changeUser');
Route::post('/deleteUser/{id}',[App\Http\Controllers\SupportController::class, 'deleteUser'])->name('deleteUser');
Route::post('/send_messages/{id}', [App\Http\Controllers\DataController::class, 'Messages'])->name('Messages');
Route::post('/ReviseOrder', [App\Http\Controllers\SupportController::class, 'ReviseOrder'])->name('ReviseOrder');
Route::get('/setOrders/{OrderId}', [App\Http\Controllers\SupportController::class, 'AssignOrders'])->name('AssignOrders');
Route::post('/ChangeStatus/{id}', [App\Http\Controllers\SupportController::class, 'ChangeStatus'])->name('ChangeStatus');

