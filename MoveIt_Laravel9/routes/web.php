<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\IsAdminMiddleware;
use App\Http\Middleware\IsCustomerMiddleware;
use App\Http\Middleware\IsDriverMiddleware;
use App\Http\Middleware\PreventLoggedIn;
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

// * [Start] Base Route  //
Route::get('/', [UserController::class, 'cek_login'])->name('home');
Route::get('/welcome', function () {
    return view("welcome");
});
Route::get('/home', [UserController::class, 'home']);
Route::get('/test', function () {
    return view("test");
});
// * [End] Base Route  //

// * [Start] Route Registrasi //
Route::get('/registrasi-customer', [UserController::class, 'registrasi_customer'])
    ->middleware(PreventLoggedIn::class)
    ->name('registrasi-customer');
Route::post('/registrasi-customer', [UserController::class, 'registrasi_customer_action'])
    ->middleware(PreventLoggedIn::class)
    ->name('registrasi.customer.action');
Route::get('/registrasi-driver', [UserController::class, 'registrasi_driver'])
    ->middleware(PreventLoggedIn::class)
    ->name('registrasi-driver');
Route::post('/registrasi-driver', [UserController::class, 'registrasi_driver_action'])
    ->middleware(PreventLoggedIn::class)
    ->name('registrasi.driver.action');
// * [End] Route Registrasi //

// * [Start] Route Login & Logout //
Route::get('/login', [UserController::class, 'login'])
    ->middleware(PreventLoggedIn::class)
    ->name('login');
Route::post('/login', [UserController::class, 'login_action'])
    ->middleware(PreventLoggedIn::class)
    ->name('login.action');
Route::get('logout', [UserController::class, 'logout'])
    ->name('logout');
// * [End] Route Login & Logout //

// * [Start] Route Cek Login //
Route::get('/cek-login', [UserController::class, 'cek_login'])
    ->name('cek-login');
// * [End] Route Cek Login //

// * [Start] Route Ganti Password //
Route::get('/ganti-password', [UserController::class, 'ganti_password'])
    ->middleware(Authenticate::class)
    ->name('ganti-password');
Route::post('/ganti-password', [UserController::class, 'ganti_password_action'])
    ->middleware(Authenticate::class)
    ->name('ganti.password.action');
// * [End] Route Ganti Password //

// * [Start] Authentication Guard //
Route::get('/hanya-driver', function () {return view("driver");})
    ->middleware(Authenticate::class)
    ->middleware(IsDriverMiddleware::class)
    ->name('hanya_driver');

Route::get('/hanya-customer', function () {return view("customer");})
    ->middleware(Authenticate::class)
    ->middleware(IsCustomerMiddleware::class)
    ->name('hanya_customer');

Route::get('/hanya-admin', function () {return view("admin");})
    ->middleware(Authenticate::class)
    ->middleware(IsAdminMiddleware::class)
    ->name('hanya_admin');
// * [End] Authentication Guard //

// * [Start] Route Dashboard //
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
// * [End] Route Dashboard //

// * [Start] Route Customer //
Route::get('/customer-pesanan-buat', [DashboardController::class, 'customer_pesanan_buat'])
    ->middleware(Authenticate::class)
    ->middleware(IsCustomerMiddleware::class)
    ->name('customer_pesanan_buat');

Route::post('/customer-pesanan-buat', [CustomerController::class, 'customer_buat_pesanan'])
    ->middleware(Authenticate::class)
    ->middleware(IsCustomerMiddleware::class)
    ->name('customer.buat.pesanan');

Route::get('/customer-pesanan-proses', [DashboardController::class, 'customer_pesanan_proses'])
    ->middleware(Authenticate::class)
    ->middleware(IsCustomerMiddleware::class)
    ->name('customer_pesanan_proses');

Route::get('/customer-pesanan-riwayat', [DashboardController::class, 'customer_pesanan_riwayat'])
    ->middleware(Authenticate::class)
    ->middleware(IsCustomerMiddleware::class)
    ->name('customer_pesanan_riwayat');

Route::get('/customer-ereceipt', [DashboardController::class, 'customer_ereceipt'])
    ->middleware(Authenticate::class)
    ->middleware(IsCustomerMiddleware::class)
    ->name('customer_ereceipt');

Route::post('/customer-ereceipt', [DashboardController::class, 'customer_ereceipt_action'])
    ->middleware(Authenticate::class)
    ->middleware(IsCustomerMiddleware::class)
    ->name('customer.ereceipt.action');

// Route::get('/customer-ereceipt-lihat', [DashboardController::class, 'customer_ereceipt_lihat'])
//     ->middleware(Authenticate::class)
//     ->middleware(IsCustomerMiddleware::class)
//     ->name('customer_ereceipt_lihat');

// Route::get('/customer-ereceipt/{theid?}', [DashboardController::class, 'customer_ereceipt_id'])
//     ->middleware(Authenticate::class)
//     ->middleware(IsCustomerMiddleware::class);

// Route::get('/customer-ereceipt/{theid}', [CustomerController::class, 'customer_ereceipt_lihat'])
//     ->middleware(Authenticate::class)
//     ->middleware(IsCustomerMiddleware::class);

Route::get('/customer-komplain-buat', [DashboardController::class, 'customer_komplain_buat'])
    ->middleware(Authenticate::class)
    ->middleware(IsCustomerMiddleware::class)
    ->name('customer_komplain_buat');

Route::get('/customer-komplain-proses', [DashboardController::class, 'customer_komplain_proses'])
    ->middleware(Authenticate::class)
    ->middleware(IsCustomerMiddleware::class)
    ->name('customer_komplain_proses');

Route::get('/customer-komplain-riwayat', [DashboardController::class, 'customer_komplain_riwayat'])
    ->middleware(Authenticate::class)
    ->middleware(IsCustomerMiddleware::class)
    ->name('customer_komplain_riwayat');
// * [End] Route Customer //

// * [Start] Route Driver //
Route::get('/driver-pesanan-tersedia', [DashboardController::class, 'driver_pesanan_tersedia'])
    ->middleware(Authenticate::class)
    ->middleware(IsDriverMiddleware::class)
    ->name('driver_pesanan_tersedia');

Route::get('/driver-pesanan-terima/{id}', [DriverController::class, 'driver_pesanan_terima'])
    ->middleware(Authenticate::class)
    ->middleware(IsDriverMiddleware::class);

Route::get('/driver-pesanan-selesai/{id}', [DriverController::class, 'driver_pesanan_selesai'])
    ->middleware(Authenticate::class)
    ->middleware(IsDriverMiddleware::class);

Route::get('/driver-pesanan-proses', [DashboardController::class, 'driver_pesanan_proses'])
    ->middleware(Authenticate::class)
    ->middleware(IsDriverMiddleware::class)
    ->name('driver_pesanan_proses');

Route::get('/driver-pesanan-riwayat', [DashboardController::class, 'driver_pesanan_riwayat'])
    ->middleware(Authenticate::class)
    ->middleware(IsDriverMiddleware::class)
    ->name('driver_pesanan_riwayat');

Route::get('/driver-komplain-proses', [DashboardController::class, 'driver_komplain_proses'])
    ->middleware(Authenticate::class)
    ->middleware(IsDriverMiddleware::class)
    ->name('driver_komplain_proses');

Route::get('/driver-komplain-riwayat', [DashboardController::class, 'driver_komplain_riwayat'])
    ->middleware(Authenticate::class)
    ->middleware(IsDriverMiddleware::class)
    ->name('driver_komplain_riwayat');
// * [End] Route Driver //

// * [Start] Route Admin //
Route::get('/admin-komplain', [DashboardController::class, 'admin_komplain'])
    ->middleware(Authenticate::class)
    ->middleware(IsAdminMiddleware::class)
    ->name('admin_komplain');

Route::get('/admin-ereceipt', [DashboardController::class, 'admin_ereceipt'])
    ->middleware(Authenticate::class)
    ->middleware(IsAdminMiddleware::class)
    ->name('admin_ereceipt');

Route::get('/admin-pesanan', [DashboardController::class, 'admin_pesanan'])
    ->middleware(Authenticate::class)
    ->middleware(IsAdminMiddleware::class)
    ->name('admin_pesanan');

Route::get('/admin-database-users', [DashboardController::class, 'admin_database_users'])
    ->middleware(Authenticate::class)
    ->middleware(IsAdminMiddleware::class)
    ->name('admin_database_users');

Route::get('/admin-database-drivers', [DashboardController::class, 'admin_database_drivers'])
    ->middleware(Authenticate::class)
    ->middleware(IsAdminMiddleware::class)
    ->name('admin_database_drivers');
// * [End] Route Admin //
