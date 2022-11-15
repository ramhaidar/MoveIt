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

Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'register_action'])->name('register.action');
Route::get('/register-driver', [UserController::class, 'register_driver'])->name('register_driver');
Route::post('/register-driver', [UserController::class, 'register_driver_action'])->name('register.driver.action');

Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'login_action'])->name('login.action');

Route::get('/password', [UserController::class, 'password'])->name('password');
Route::post('/password', [UserController::class, 'password_action'])->name('password.action');

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

