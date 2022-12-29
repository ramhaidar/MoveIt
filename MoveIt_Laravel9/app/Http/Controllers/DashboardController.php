<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // * [Start] Controller Untuk Admin //
    public function admin()
    {
        $user = Auth::user();
        if ($user->is_admin) {
            return view('dashboard/dashboard_admin', [
                'account' => $user,
                'users' => User::all(),
                'drivers' => Driver::all(),
            ], );
        }
    }

    public function admin_komplain()
    {
        $user = Auth::user();
        if ($user->is_admin) {
            return view('dashboard.admin.admin_komplain', [
                'account' => $user,
                'users' => User::all(),
                'drivers' => Driver::all(),
            ], );
        }
    }

    public function admin_ereceipt()
    {
        $user = Auth::user();
        if ($user->is_admin) {
            return view('dashboard.admin.admin_ereceipt', [
                'account' => $user,
                'users' => User::all(),
                'drivers' => Driver::all(),
            ], );
        }
    }

    public function admin_pesanan()
    {
        $user = Auth::user();
        if ($user->is_admin) {
            return view('dashboard.admin.admin_pesanan', [
                'account' => $user,
                'users' => User::all(),
                'drivers' => Driver::all(),
            ], );
        }
    }

    public function admin_database_users()
    {
        $user = Auth::user();
        if ($user->is_admin) {
            return view('dashboard.admin.admin_databases_users', [
                'account' => $user,
                'users' => User::all(),
                'drivers' => Driver::all(),
            ], );
        }
    }

    public function admin_database_drivers()
    {
        $user = Auth::user();
        if ($user->is_admin) {
            return view('dashboard.admin.admin_databases_drivers', [
                'account' => $user,
                'users' => User::all(),
                'drivers' => Driver::all(),
            ], );
        }
    }
    // * [End] Controller Untuk Admin //

    // * [Start] Controller Untuk Driver //
    public function driver()
    {
        $user = Auth::user();
        if ($user->is_driver) {
            $userId = Auth::id();
            $drivers = User::with('driver')->where('id', Auth::id())->get();
            return view('dashboard/dashboard_driver', [
                'account' => $user,
                'drivers' => $drivers,
                'accountId' => $userId,
                'users' => User::all(),
            ], );
        }
    }

    public function driver_pesanan_tersedia()
    {
        $user = Auth::user();
        $jenis_Kendaraan = Driver::select('jenis_Kendaraan')->where('id', $user->driver_id)->get('jenis_Kendaraan')->first()->jenis_Kendaraan;
        if ($jenis_Kendaraan == "Motor") {
            $min = 0;
            $max = 10;
        } elseif ($jenis_Kendaraan == "Van") {
            $min = 11;
            $max = 60;
        } elseif ($jenis_Kendaraan == "PickUp") {
            $min = 61;
            $max = 80;
        } elseif ($jenis_Kendaraan == "Engkel") {
            $min = 81;
            $max = 199;
        } elseif ($jenis_Kendaraan == "CDD") {
            $min = 200;
            $max = 500;
        }
        $userId = Auth::id();
        $driver = User::with('driver')->where('id', Auth::id())->get();
        $test = Pesanan::all()->first();
        $adaisinya = Pesanan::where('berat', '>=', $min)
                        ->where('berat', '<=', $max)
                        ->where('is_completed', 0)
                        ->get()->first();

        return view('dashboard.driver.driver_pesanan_tersedia', [
            'account' => $user,
            'drivers' => $driver,
            'accountId' => $userId,
            'users' => User::find($userId),
            'pesanan' => Pesanan::all(),
            'jenis_Kendaraan' => $jenis_Kendaraan,
            'min' => $min,
            'max' => $max,
            'adaisinya' => $adaisinya,
        ], );
    }

    public function driver_pesanan_proses()
    {
        $user = Auth::user();
        if ($user->is_driver) {
            $userId = Auth::id();
            $drivers = User::with('driver')->where('id', Auth::id())->get();
            $driver_data = Driver::where('id', User::where('id', Auth::id())->get('driver_id')->first()->driver_id)->get()->first();
            return view('dashboard.driver.driver_pesanan_proses', [
                'account' => $user,
                'drivers' => $drivers,
                'accountId' => $userId,
                'driver_data' => $driver_data,
                'pesanan' => Pesanan::all(),
                'users' => User::find($userId),
            ], );
        }
    }

    public function driver_pesanan_riwayat()
    {
        $user = Auth::user();
        if ($user->is_driver) {
            $userId = Auth::id();
            $drivers = User::with('driver')->where('id', Auth::id())->get();
            $driver_data = Driver::where('id', User::where('id', Auth::id())->get('driver_id')->first()->driver_id)->get()->first();
            return view('dashboard.driver.driver_pesanan_riwayat', [
                'account' => $user,
                'drivers' => $drivers,
                'accountId' => $userId,
                'driver_data' => $driver_data,
                'pesanan' => Pesanan::all(),
                'users' => User::find($userId),
            ], );
        }
    }

    public function driver_komplain_proses()
    {
        $user = Auth::user();
        if ($user->is_driver) {
            $userId = Auth::id();
            $drivers = User::with('driver')->where('id', Auth::id())->get();
            return view('dashboard.driver.driver_komplain_proses', [
                'account' => $user,
                'drivers' => $drivers,
                'accountId' => $userId,
                'users' => User::find($userId),
            ], );
        }
    }

    public function driver_komplain_riwayat()
    {
        $user = Auth::user();
        if ($user->is_driver) {
            $userId = Auth::id();
            $drivers = User::with('driver')->where('id', Auth::id())->get();
            return view('dashboard.driver.driver_komplain_riwayat', [
                'account' => $user,
                'drivers' => $drivers,
                'accountId' => $userId,
                'users' => User::find($userId),
            ], );
        }
    }
    // * [End] Controller Untuk Driver //

    // * [Start] Controller Untuk Customer //
    public function customer()
    {
        $user = Auth::user();
        if ($user->is_customer) {
            $userId = Auth::id();
            return view('dashboard/dashboard_customer', [
                'account' => $user,
                'accountId' => $userId,
                'users' => User::find($userId),
                'drivers' => Driver::all(),
            ], );
        }
    }

    public function customer_pesanan_buat()
    {
        $user = Auth::user();
        if ($user->is_customer) {
            $userId = Auth::id();
            return view('dashboard.customer.customer_pesanan_buat', [
                'account' => $user,
                'accountId' => $userId,
                'users' => User::find($userId),
                'drivers' => Driver::all(),
            ], );
        }
    }

    public function customer_pesanan_proses()
    {
        $user = Auth::user();
        if ($user->is_customer) {
            $userId = Auth::id();
            return view('dashboard.customer.customer_pesanan_proses', [
                'account' => $user,
                'accountId' => $userId,
                'users' => User::find($userId),
                'drivers' => Driver::all(),
                'pesanan' => Pesanan::where('customer_id', Auth::id())->get()->all(),
            ], );
        }
    }

    public function customer_pesanan_riwayat()
    {
        $user = Auth::user();
        if ($user->is_customer) {
            $userId = Auth::id();
            return view('dashboard.customer.customer_pesanan_riwayat', [
                'account' => $user,
                'accountId' => $userId,
                'users' => User::find($userId),
                'drivers' => Driver::all(),
                'pesanan' => Pesanan::where('customer_id', Auth::id())->get()->all(),
            ], );
        }
    }

    public function customer_ereceipt()
    {
        // if ($theid != null) {
        //     $theid = (int) $theid;
        //     $user = Auth::user();
        //     $userId = Auth::id();
        //     $orderan = Pesanan::where('customer_id', Auth::id())->get()->where('id', $theid)->first();
        //     $pemesan = User::where('id', $orderan->customer_id)->get()->first();

        //     if ($user->is_customer) {
        //         $userId = Auth::id();
        //         return view('dashboard.customer.customer_ereceipt', [
        //             'account' => $user,
        //             'accountId' => $userId,
        //             'users' => User::find($userId),
        //             'pemesan' => $pemesan,
        //             'orderan' => $orderan,
        //             'orderid' => $orderan->id,
        //         ], );
        //     }
        // } else {
        $userId = Auth::id();
        return view('dashboard.customer.customer_ereceipt', [
            'account' => Auth::user(),
            'accountId' => $userId,
            'users' => User::find($userId),
            'drivers' => Driver::all(),
            'pesanan' => Pesanan::where('customer_id', Auth::id())->get()->all(),
            'orderid' => null,
        ], );
        // }
    }

    public function customer_ereceipt_action(Request $request)
    {
        // dd($request->orderid);

        $theid = (int) $request->orderid;

        $user = Auth::user();
        $userId = Auth::id();
        $orderan = Pesanan::where('customer_id', Auth::id())->get()->where('id', $theid)->first();
        $pemesan = User::where('id', $orderan->customer_id)->get()->first();
        $pengantar = User::where('driver_id', $orderan->driver_id)->get()->first();

        return view('dashboard.customer.customer_ereceipt', [
            'account' => $user,
            'accountId' => $userId,
            'users' => User::find($userId),
            'pemesan' => $pemesan,
            'orderan' => $orderan,
            'orderid' => $orderan->id,
            'pengantar' => $pengantar,
        ], );
    }

    public function customer_ereceipt_id($theid)
    {
        $user = Auth::user();
        $userId = Auth::id();
        $orderan = Pesanan::where('customer_id', Auth::id())->get()->where('id', $theid)->first();
        $pemesan = User::where('id', $orderan->customer_id)->get()->first();

        // return redirect()->route('customer_ereceipt_lihat')
        //     ->with('account', $user)
        //     ->with('accountId', $userId)
        //     ->with('users', User::find($userId))
        //     ->with('pemesan', $pemesan)
        //     ->with('orderan', $orderan)
        //     ->with('orderid', $orderan->id);

        return view('dashboard.customer.customer_ereceipt_lihat', [
            'account' => $user,
            'accountId' => $userId,
            'users' => User::find($userId),
            'pemesan' => $pemesan,
            'orderan' => $orderan,
            'orderid' => $orderan->id,
        ], );
    }

    public function customer_ereceipt_lihat()
    {
        $user = Auth::user();
        $userId = Auth::id();
        $orderan = Pesanan::where('customer_id', Auth::id())->get()->where('id', $theid)->first();
        $pemesan = User::where('id', $orderan->customer_id)->get()->first();

        // return redirect()->route('customer_ereceipt_lihat')
        //     ->with('account', $user)
        //     ->with('accountId', $userId)
        //     ->with('users', User::find($userId))
        //     ->with('pemesan', $pemesan)
        //     ->with('orderan', $orderan)
        //     ->with('orderid', $orderan->id);

        return view('dashboard.customer.customer_ereceipt', [
            'account' => $user,
            'accountId' => $userId,
            'users' => User::find($userId),
            'pemesan' => $pemesan,
            'orderan' => $orderan,
            'orderid' => $orderan->id,
        ], );
    }

    public function customer_komplain_buat()
    {
        $user = Auth::user();
        if ($user->is_customer) {
            $userId = Auth::id();
            return view('dashboard.customer.customer_komplain_buat', [
                'account' => $user,
                'accountId' => $userId,
                'users' => User::find($userId),
                'drivers' => Driver::all(),
            ], );
        }
    }

    public function customer_komplain_proses()
    {
        $user = Auth::user();
        if ($user->is_customer) {
            $userId = Auth::id();
            return view('dashboard.customer.customer_komplain_proses', [
                'account' => $user,
                'accountId' => $userId,
                'users' => User::find($userId),
                'drivers' => Driver::all(),
            ], );
        }
    }

    public function customer_komplain_riwayat()
    {
        $user = Auth::user();
        if ($user->is_customer) {
            $userId = Auth::id();
            return view('dashboard.customer.customer_komplain_riwayat', [
                'account' => $user,
                'accountId' => $userId,
                'users' => User::find($userId),
                'drivers' => Driver::all(),
            ], );
        }
    }
    // * [End] Controller Untuk Customer //
}
