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

Route::get('/', [App\Http\Controllers\WebController::class, 'index']);
Route::get('/paket/lazismu-kota-malang/{url}', [App\Http\Controllers\WebController::class, 'detail']);
Route::post('/order', [App\Http\Controllers\WebController::class, 'order']);
Route::get('/order-success/{enc}', [App\Http\Controllers\WebController::class, 'success']);

Route::post('/register-validate', [App\Http\Controllers\UsersController::class, 'registerValidate']);
Route::get('/validate-wa-number/{wa}', [App\Http\Controllers\UsersController::class, 'numberWAValidate']);
Route::get('/send-otp/{wa}', [App\Http\Controllers\UsersController::class, 'sendOTP']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/paket', [App\Http\Controllers\PackagesController::class, 'index']);
Route::get('/paket/tambah', [App\Http\Controllers\PackagesController::class, 'tambah']);
Route::post('/paket/post', [App\Http\Controllers\PackagesController::class, 'post']);
Route::get('/paket/ubah/{id}', [App\Http\Controllers\PackagesController::class, 'ubah']);
Route::post('/paket/put', [App\Http\Controllers\PackagesController::class, 'put']);
Route::post('/paket/hapus', [App\Http\Controllers\PackagesController::class, 'hapus']);

Route::get('/petugas', [App\Http\Controllers\UsersController::class, 'index']);
Route::get('/petugas/tambah', [App\Http\Controllers\UsersController::class, 'tambah']);
Route::post('/petugas/post', [App\Http\Controllers\UsersController::class, 'post']);
Route::get('/petugas/ubah/{id}', [App\Http\Controllers\UsersController::class, 'ubah']);
Route::post('/petugas/put', [App\Http\Controllers\UsersController::class, 'put']);
Route::post('/petugas/hapus', [App\Http\Controllers\UsersController::class, 'hapus']);

Route::get('/qurban', [App\Http\Controllers\TransactionController::class, 'index']);
Route::post('/qurban', [App\Http\Controllers\TransactionController::class, 'index']);
Route::get('/qurban/tambah', [App\Http\Controllers\TransactionController::class, 'tambah']);
Route::post('/qurban/post', [App\Http\Controllers\TransactionController::class, 'post']);
Route::get('/qurban/ubah/{id}', [App\Http\Controllers\TransactionController::class, 'ubah']);
Route::get('/qurban/detail/{id}', [App\Http\Controllers\TransactionController::class, 'detail']);
Route::post('/qurban/put', [App\Http\Controllers\TransactionController::class, 'put']);
Route::post('/qurban/hapus', [App\Http\Controllers\TransactionController::class, 'hapus']);
Route::post('/qurban/confirm', [App\Http\Controllers\TransactionController::class, 'confirm']);


Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);
