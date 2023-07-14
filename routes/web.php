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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/users', [App\Http\Controllers\Auth\RegisterController::class, 'newRegister'])->name('new_register');

Route::get('/deposit', [App\Http\Controllers\DepositController::class, 'index'])->name('deposit_list');
Route::post('/deposit', [App\Http\Controllers\DepositController::class, 'store'])->name('deposit_add');

Route::get('/withdrawal', [App\Http\Controllers\WithDrawalController::class, 'index'])->name('withdrawal_list');
Route::post('/withdrawal', [App\Http\Controllers\WithDrawalController::class, 'store'])->name('withdrawal_add');

