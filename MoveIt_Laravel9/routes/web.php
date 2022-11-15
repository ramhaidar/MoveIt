<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsCustomerMiddleware;
use App\Http\Middleware\IsDriverMiddleware;
use App\Http\Middleware\IsAdminMiddleware;

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

Route::get('/', [UserController::class, 'cek_login'])->name('home');

Route::get('/welcome', function () {
    return view("welcome");
});

Route::get('/home', [UserController::class, 'home']);

Route::get('/test', function() {
    return view("test");
});

Route::get('/registrasi-customer', [UserController::class, 'registrasi_customer'])
    ->name('registrasi-customer');
Route::post('/registrasi-customer', [UserController::class, 'registrasi_customer_action'])
    ->name('registrasi.customer.action');
Route::get('/registrasi-driver', [UserController::class, 'registrasi_driver'])
    ->name('registrasi-driver');
Route::post('/registrasi-driver', [UserController::class, 'registrasi_driver_action'])
    ->name('registrasi.driver.action');

Route::get('/login', [UserController::class, 'login'])
    ->name('login');
Route::post('/login', [UserController::class, 'login_action'])
    ->name('login.action');

Route::get('/cek-login', [UserController::class, 'cek_login'])
    ->name('cek-login');

Route::get('/ganti-password', [UserController::class, 'ganti_password'])
    ->name('ganti-password');
Route::post('/ganti-password', [UserController::class, 'ganti_password_action'])
    ->name('ganti.password.action');

// Authentication Guard #START
Route::get('/hanya-driver', function () {
    return view("driver");
})->middleware(IsDriverMiddleware::class)->name('hanya_driver');

Route::get('/hanya-customer', function () {
    return view("customer");
})->middleware(IsCustomerMiddleware::class)->name('hanya_customer');

Route::get('/hanya-admin', function () {
    return view("admin");
})->middleware(IsAdminMiddleware::class)->name('hanya_admin');
// Authentication Guard #END

Route::get('logout', [UserController::class, 'logout'])->name('logout');
