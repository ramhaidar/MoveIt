<?php

use App\Http\Middleware\CekLogin;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsAdminMiddleware;
use App\Http\Middleware\IsDriverMiddleware;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\IsCustomerMiddleware;

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

// * Route Registrasi //
Route::get('/registrasi-customer', [UserController::class, 'registrasi_customer'])
    ->name('registrasi-customer');
Route::post('/registrasi-customer', [UserController::class, 'registrasi_customer_action'])
    ->name('registrasi.customer.action');
Route::get('/registrasi-driver', [UserController::class, 'registrasi_driver'])
    ->name('registrasi-driver');
Route::post('/registrasi-driver', [UserController::class, 'registrasi_driver_action'])
    ->name('registrasi.driver.action');

// * Route Login & Logout //
Route::get('/login', [UserController::class, 'login'])
    ->name('login');
Route::post('/login', [UserController::class, 'login_action'])
    ->name('login.action');
Route::get('logout', [UserController::class, 'logout'])
    ->name('logout');

// * Route Cek Login //
Route::get('/cek-login', [UserController::class, 'cek_login'])
    ->name('cek-login');

// * Route Ganti Password //
Route::get('/ganti-password', [UserController::class, 'ganti_password'])
    ->name('ganti-password')
    ->middleware(Authenticate::class);
Route::post('/ganti-password', [UserController::class, 'ganti_password_action'])
->name('ganti.password.action')
->middleware(Authenticate::class);

// * Authentication Guard //
Route::get('/hanya-driver', function () {
    return view("driver");
})
->middleware(Authenticate::class)
->middleware(IsDriverMiddleware::class)
->name('hanya_driver');

Route::get('/hanya-customer', function () {
    return view("customer");
})
    ->middleware(Authenticate::class)
    ->middleware(IsCustomerMiddleware::class)
    ->name('hanya_customer');

Route::get('/hanya-admin', function () {
    return view("admin");
})
    ->middleware(Authenticate::class)
    ->middleware(IsAdminMiddleware::class)
    ->name('hanya_admin');

// * Route Dashboard //
Route::get('/dashboard-admin', [DashboardController::class, 'admin'])
    ->middleware(Authenticate::class)
    ->middleware(IsAdminMiddleware::class)
    ->name('dashboard_admin');

Route::get('/dashboard-driver', [DashboardController::class, 'driver'])
    ->middleware(Authenticate::class)
    ->middleware(IsDriverMiddleware::class)
    ->name('dashboard_driver');

Route::get('/dashboard-customer', [DashboardController::class, 'customer'])
    ->middleware(Authenticate::class)
    ->middleware(IsCustomerMiddleware::class)
    ->name('dashboard_customer');