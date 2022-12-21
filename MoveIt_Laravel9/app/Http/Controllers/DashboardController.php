<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // * [Start] Controller Untuk Admin //
    public function admin()
    {
        $user = Auth::user();
        if ($user->is_admin)
        {
            return view('dashboard/dashboard_admin', [
                'account' => $user, 
                'users' => User::all(), 
                'drivers' => Driver::all()
            ],);
        }
    }

    public function admin_komplain()
    {
        $user = Auth::user();
        if ($user->is_admin)
        {
            return view('dashboard.admin.admin_komplain', [
                'account' => $user, 
                'users' => User::all(), 
                'drivers' => Driver::all()
            ],);
        }
    }

    public function admin_ereceipt()
    {
        $user = Auth::user();
        if ($user->is_admin)
        {
            return view('dashboard.admin.admin_ereceipt', [
                'account' => $user, 
                'users' => User::all(), 
                'drivers' => Driver::all()
            ],);
        }
    }

    public function admin_pesanan()
    {
        $user = Auth::user();
        if ($user->is_admin)
        {
            return view('dashboard.admin.admin_pesanan', [
                'account' => $user, 
                'users' => User::all(), 
                'drivers' => Driver::all()
            ],);
        }
    }

    public function admin_database_users()
    {
        $user = Auth::user();
        if ($user->is_admin)
        {
            return view('dashboard.admin.admin_databases_users', [
                'account' => $user, 
                'users' => User::all(), 
                'drivers' => Driver::all()
            ],);
        }
    }

    public function admin_database_drivers()
    {
        $user = Auth::user();
        if ($user->is_admin)
        {
            return view('dashboard.admin.admin_databases_drivers', [
                'account' => $user, 
                'users' => User::all(), 
                'drivers' => Driver::all()
            ],);
        }
    }
    // * [End] Controller Untuk Admin //

    // * [Start] Controller Untuk Driver //
    public function driver()
    {
        $user = Auth::user();
        if ($user->is_driver)
        {
            $userId = Auth::id();
            $test = User::with('driver')->where('id', Auth::id())->get();
            return view('dashboard/dashboard_driver', [
                'account' => $user, 
                'test' => $test, 
                'accountId' => $userId, 
                'users' => User::all(), 
                'drivers' => Driver::all()
            ],);
        }
    }

    public function driver_pesanan_tersedia()
    {
        $user = Auth::user();
        if ($user->is_driver)
        {
            $userId = Auth::id();
            $test = User::with('driver')->where('id', Auth::id())->get();
            return view('dashboard.driver.driver_pesanan_tersedia', [
                'account' => $user, 
                'test' => $test, 
                'accountId' => $userId, 
                'users' => User::all(), 
                'drivers' => Driver::all()
            ],);
        }
    }

    public function driver_pesanan_proses()
    {
        $user = Auth::user();
        if ($user->is_driver)
        {
            $userId = Auth::id();
            $test = User::with('driver')->where('id', Auth::id())->get();
            return view('dashboard.driver.driver_pesanan_proses', [
                'account' => $user, 
                'test' => $test, 
                'accountId' => $userId, 
                'users' => User::all(), 
                'drivers' => Driver::all()
            ],);
        }
    }

    public function driver_pesanan_riwayat()
    {
        $user = Auth::user();
        if ($user->is_driver)
        {
            $userId = Auth::id();
            $test = User::with('driver')->where('id', Auth::id())->get();
            return view('dashboard.driver.driver_pesanan_riwayat', [
                'account' => $user, 
                'test' => $test, 
                'accountId' => $userId, 
                'users' => User::all(), 
                'drivers' => Driver::all()
            ],);
        }
    }

    public function driver_komplain_proses()
    {
        $user = Auth::user();
        if ($user->is_driver)
        {
            $userId = Auth::id();
            $test = User::with('driver')->where('id', Auth::id())->get();
            return view('dashboard.driver.driver_komplain_proses', [
                'account' => $user, 
                'test' => $test, 
                'accountId' => $userId, 
                'users' => User::all(), 
                'drivers' => Driver::all()
            ],);
        }
    }

    public function driver_komplain_riwayat()
    {
        $user = Auth::user();
        if ($user->is_driver)
        {
            $userId = Auth::id();
            $test = User::with('driver')->where('id', Auth::id())->get();
            return view('dashboard.driver.driver_komplain_riwayat', [
                'account' => $user, 
                'test' => $test, 
                'accountId' => $userId, 
                'users' => User::all(), 
                'drivers' => Driver::all()
            ],);
        }
    }
    // * [End] Controller Untuk Driver //

    // * [Start] Controller Untuk Customer //
    public function customer()
    {
        $user = Auth::user();
        if ($user->is_customer)
        {
            $userId = Auth::id();
            return view('dashboard/dashboard_customer', [
                'account' => $user, 
                'accountId' => $userId, 
                'users' => User::all(), 
                'drivers' => Driver::all(),
            ],);
        }
    }

    public function customer_pesanan_buat()
    {
        $user = Auth::user();
        if ($user->is_customer)
        {
            $userId = Auth::id();
            return view('dashboard.customer.customer_pesanan_buat', [
                'account' => $user,
                'accountId' => $userId,
                // 'users' => User::all()->where('id', $userId),
                'users' => User::find($userId),
                'drivers' => Driver::all(),
            ],);
        }
    }

    public function customer_pesanan_proses()
    {
        $user = Auth::user();
        if ($user->is_customer)
        {
            $userId = Auth::id();
            return view('dashboard.customer.customer_pesanan_proses', [
                'account' => $user,
                'accountId' => $userId,
                'users' => User::all(),
                'drivers' => Driver::all()
            ],);
        }
    }

    public function customer_pesanan_riwayat()
    {
        $user = Auth::user();
        if ($user->is_customer)
        {
            $userId = Auth::id();
            return view('dashboard.customer.customer_pesanan_riwayat', [
                'account' => $user,
                'accountId' => $userId,
                'users' => User::all(),
                'drivers' => Driver::all()
            ],);
        }
    }

    public function customer_ereceipt()
    {
        $user = Auth::user();
        if ($user->is_customer)
        {
            $userId = Auth::id();
            return view('dashboard.customer.customer_ereceipt', [
                'account' => $user,
                'accountId' => $userId,
                'users' => User::all(),
                'drivers' => Driver::all()
            ],);
        }
    }

    public function customer_komplain_buat()
    {
        $user = Auth::user();
        if ($user->is_customer)
        {
            $userId = Auth::id();
            return view('dashboard.customer.customer_komplain_buat', [
                'account' => $user,
                'accountId' => $userId,
                'users' => User::all(),
                'drivers' => Driver::all()
            ],);
        }
    }

    public function customer_komplain_proses()
    {
        $user = Auth::user();
        if ($user->is_customer)
        {
            $userId = Auth::id();
            return view('dashboard.customer.customer_komplain_proses', [
                'account' => $user,
                'accountId' => $userId,
                'users' => User::all(),
                'drivers' => Driver::all()
            ],);
        }
    }

    public function customer_komplain_riwayat()
    {
        $user = Auth::user();
        if ($user->is_customer)
        {
            $userId = Auth::id();
            return view('dashboard.customer.customer_komplain_riwayat', [
                'account' => $user,
                'accountId' => $userId,
                'users' => User::all(),
                'drivers' => Driver::all()
            ],);
        }
    }
    // * [End] Controller Untuk Customer //
}
