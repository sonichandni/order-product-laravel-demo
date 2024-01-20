<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('welcome');
});

Route::get('register', function () {
    return view('register');
});

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'register'])->name('register');

Route::group(['middleware' => 'auth'], function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('dashboard', [OrderController::class, 'dashboard'])->name('dashboard');
    Route::get('add_order', [OrderController::class, 'add_order'])->name('add_order');
    Route::post('add_order', [OrderController::class, 'add_order'])->name('add_order');
    Route::get('order_details/{id}', [OrderController::class, 'order_details'])->name('order_details');
});