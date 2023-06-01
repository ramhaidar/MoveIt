<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Pesanan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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

    public function admin_ereceipt()
    {
        $userId = Auth::id();
        $adaisinya = Pesanan::where('is_completed', 1)->where('is_deleted', false)->get()->all();
        return view('dashboard.admin.admin_ereceipt', [
            'account' => Auth::user(),
            'accountId' => $userId,
            'users' => User::find($userId),
            'drivers' => Driver::all(),
            'pesanan' => Pesanan::where('is_deleted', false)->get()->all(),
            'orderid' => null,
            'adaisinya' => $adaisinya,
        ], );
    }

    public function admin_ereceipt_lihat(Request $request)
    {
        $theid = (int) $request->orderid;

        $user = Auth::user();
        $userId = Auth::id();
        $orderan = Pesanan::where('id', $theid)->first();
        $pemesan = User::where('id', $orderan->customer_id)->get()->first();
        $pengantar = User::where('driver_id', $orderan->driver_id)->get()->first();
        $adaisinya = Pesanan::where('is_completed', 1)->where('is_deleted', false)->get()->all();

        return view('dashboard.admin.admin_ereceipt', [
            'account' => $user,
            'accountId' => $userId,
            'users' => User::find($userId),
            'pesanan' => Pesanan::where('is_deleted', false)->get()->all(),
            'pemesan' => $pemesan,
            'orderan' => $orderan,
            'pengantar' => $pengantar,
            'orderid' => $orderan->id,
            'adaisinya' => $adaisinya,
        ], );
    }

    public function admin_pesanan()
    {
        $userId = Auth::id();
        $adaisinya = Pesanan::where('is_completed', 1)->where('is_deleted', false)->get()->all();

        return view('dashboard.admin.admin_pesanan', [
            'account' => Auth::user(),
            'accountId' => $userId,
            'users' => User::find($userId),
            'drivers' => Driver::all(),
            'pesanan' => Pesanan::where('is_deleted', false)->get()->all(),
            'orderid' => null,
            'adaisinya' => $adaisinya,
        ], );
    }

    public function admin_pesanan_hapus(Request $request)
    {
        Pesanan::where('id', $request->hapusorder)->update(array('is_deleted' => true));

        return redirect()->route('admin_pesanan');
    }

    public function admin_database_users()
    {
        $user = Auth::user();
        $adaisinya = User::where('is_customer', true)->where('is_deleted', false)->get()->all();
        if ($user->is_admin) {
            return view('dashboard.admin.admin_databases_users', [
                'account' => $user,
                'users' => User::where('is_customer', true)->where('is_deleted', false)->get()->all(),
                'adaisinya' => $adaisinya,
                'ubahid' => null,
                'hapusid' => null,
                'ubahini' => null,
            ], );
        }
    }

    public function admin_database_users_action(Request $request)
    {
        if ($request->hapusid != null) {
            User::where('id', $request->hapusid)->update(array('is_deleted' => true));
        }
        if ($request->ubahid != null) {
            return view('dashboard.admin.admin_databases_users', [
                'account' => Auth::user(),
                'users' => User::where('is_customer', true)->where('is_deleted', false)->where('id', $request->ubahid)->get()->first(),
                'adaisinya' => User::where('is_customer', true)->where('is_deleted', false)->get()->all(),
                'ubahid' => $request->ubahid,
            ], );
        }
        if ($request->ubahini != null) {
            $userid = User::where('id', $request->ubahini)->get()->first()->id;
            $request->validate([
                'name' => ['required', 'min:6', 'max:30'],
                'username' => [Rule::unique('users', 'username')->ignore($userid), 'required', 'alpha_dash', 'min:6', 'max:10'],
                'email' => [Rule::unique('users', 'email')->ignore($userid), 'required'],
                'nik' => [Rule::unique('users', 'nik')->ignore($userid), 'required'],
                'nomor_telepon' => [Rule::unique('users', 'nomor_telepon')->ignore($userid), 'required', 'regex:/^08.*$/i', 'min_digits:11', 'max_digits:13', 'numeric'],
                'tanggal_lahir' => ['required', 'date_format:Y-m-d'],
                'pause_status' => ['required', 'boolean'],
            ]);

            User::where('id', $request->ubahini)->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'tanggal_lahir' => $request->tanggal_lahir,
                'nik' => $request->nik,
                'nomor_telepon' => $request->nomor_telepon,
                'pause_status' => $request->pause_status,
            ]);
            return redirect()->route('admin_database_users')->with('success', 'Pengubahan Data Customer Berhasil.');
        }
        return redirect()->route('admin_database_users');
    }

    public function admin_database_drivers()
    {
        $user = Auth::user();
        $adaisinya = User::where('is_driver', true)->where('is_deleted', false)->get()->all();
        if ($user->is_admin) {
            return view('dashboard.admin.admin_databases_drivers', [
                'account' => $user,
                'users' => User::where('is_driver', true)->where('is_deleted', false)->get()->all(),
                'adaisinya' => $adaisinya,
                'ubahid' => null,
                'hapusid' => null,
                'ubahini' => null,
            ], );
        }
    }

    public function admin_database_drivers_action(Request $request)
    {
        $start_time = microtime(true);

        if ($request->hapusid != null) {
            User::where('id', $request->hapusid)->update(array('is_deleted' => true));
        }
        if ($request->ubahid != null) {
            return view('dashboard.admin.admin_databases_drivers', [
                'account' => Auth::user(),
                'users' => User::where('is_driver', true)->where('is_deleted', false)->where('id', $request->ubahid)->get()->first(),
                'adaisinya' => User::where('is_driver', true)->where('is_deleted', false)->get()->all(),
                'ubahid' => $request->ubahid,
            ], );
        }
        if ($request->ubahini != null) {
            $userid = User::where('id', $request->ubahini)->get()->first()->id;
            $driverid = User::where('id', $request->ubahini)->get()->first()->driver_id;
            $driver = Driver::where('id', $driverid)->first();

            $request->validate([
                'name' => ['required', 'min:6', 'max:30'],
                'username' => [Rule::unique('users', 'username')->ignore($userid), 'required', 'alpha_dash', 'min:6', 'max:10'],
                'email' => [Rule::unique('users', 'email')->ignore($userid), 'required'],
                'nik' => [Rule::unique('users', 'nik')->ignore($userid), 'required'],
                'nomor_telepon' => [Rule::unique('users', 'nomor_telepon')->ignore($userid), 'required', 'regex:/^08.*$/i', 'min_digits:11', 'max_digits:13', 'numeric'],
                'tanggal_lahir' => ['required', 'date_format:Y-m-d'],
                'pause_status' => ['required', 'boolean'],
                'jenis_kendaraan' => ['required', 'not_regex:/Kendaraan/i'],
                'nomor_polisi' => [Rule::unique('drivers', 'nomor_polisi')->ignore($driverid), 'required'],
            ]);

            User::where('id', $request->ubahini)->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'tanggal_lahir' => $request->tanggal_lahir,
                'nik' => $request->nik,
                'nomor_telepon' => $request->nomor_telepon,
                'pause_status' => $request->pause_status,
            ]);

            Driver::where('id', $driverid)->update([
                'jenis_kendaraan' => $request->jenis_kendaraan,
                'nomor_polisi' => $request->nomor_polisi,
            ]);

            return redirect()->route('admin_database_drivers')->with('success', 'Pengubahan Data Driver Berhasil.');
        }
        return redirect()->route('admin_database_drivers');

        $end_time = microtime(true);
        $response_time = ($end_time - $start_time) * 1000; // konversi ke milisecond

        echo "Response time: $response_time ms";
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
        $adaisinya = Pesanan::where('is_deleted', false)
            ->where('berat', '>=', $min)
            ->where('berat', '<=', $max)
            ->where('is_completed', 0)
            ->where('driver_id', null)
            ->get()->first();

        return view('dashboard.driver.driver_pesanan_tersedia', [
            'account' => $user,
            'drivers' => $driver,
            'accountId' => $userId,
            'users' => User::find($userId),
            'pesanan' => Pesanan::where('is_deleted', false)->get()->all(),
            'jenis_Kendaraan' => $jenis_Kendaraan,
            'min' => $min,
            'max' => $max,
            'adaisinya' => $adaisinya,
        ], );
    }

    public function driver_pesanan_terima(Request $request, $id)
    {
        if (Pesanan::where('id', $id)->get()->first()->driver_id == null) {

            Pesanan::where('id', $id)->update(array('driver_id' => User::where('id', Auth::id())->get('driver_id')->first()->driver_id));

            Pesanan::where('id', $id)->update(array('accepted_at' => Carbon::now()));

            User::where('id', Auth::id())->update(array('pause_status' => true));
        }

        return redirect()->route('driver_pesanan_proses')->with('success', 'Pesanan Sukses Diterima.');
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
                'pesanan' => Pesanan::where('is_deleted', false)->get()->all(),
                'users' => User::find($userId),
            ], );
        }
    }

    public function driver_pesanan_selesai(Request $request, $id)
    {
        Pesanan::where('id', $id)->update(array('is_completed' => true));

        Pesanan::where('id', $id)->update(array('completed_at' => Carbon::now()));

        User::where('id', Auth::id())->update(array('pause_status' => false));

        User::where('id', Pesanan::where('id', $id)->get('customer_id')->first()->customer_id)->update(array('pause_status' => false));

        return redirect()->route('driver_pesanan_riwayat')->with('success', 'Pesanan Sukses Diselesaikan.');
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
                'pesanan' => Pesanan::where('is_deleted', false)->get()->all(),
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

    public function customer_pesanan_buat_action(Request $request)
    {
        $request->validate([
            'nama_penerima' => 'required',
            'alamat_pickup' => 'required',
            'alamat_tujuan' => 'required',
            'berat' => 'required|numeric|between:0,500',
            'deskripsi' => 'required',
            'jarak' => 'required|numeric|min:0',
            'tarif' => 'required',
            'metode_pembayaran' => 'required',
        ]);

        $pesanan = new Pesanan([
            'nama_penerima' => $request->nama_penerima,
            'alamat_pickup' => $request->alamat_pickup,
            'alamat_tujuan' => $request->alamat_tujuan,
            'berat' => $request->berat,
            'deskripsi' => $request->deskripsi,
            'jarak' => $request->jarak,
            'tarif' => $request->tarif,
            'metode_pembayaran' => $request->metode_pembayaran,
            'is_completed' => false,
            'customer_id' => Auth::id(),
        ]);
        $pesanan->save();

        User::where('id', Auth::id())->update(array('pause_status' => true));

        return redirect()->route('customer_pesanan_proses')->with('success', 'Pesanan Sukses Dibuat.');
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
                'pesanan' => Pesanan::where('is_deleted', false)->where('customer_id', Auth::id())->get()->all(),
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
                'pesanan' => Pesanan::where('is_deleted', false)->where('customer_id', Auth::id())->get()->all(),
            ], );
        }
    }

    public function customer_ereceipt()
    {
        $userId = Auth::id();
        return view('dashboard.customer.customer_ereceipt', [
            'account' => Auth::user(),
            'accountId' => $userId,
            'users' => User::find($userId),
            'drivers' => Driver::all(),
            'pesanan' => Pesanan::where('customer_id', Auth::id())->where('is_deleted', false)->get()->all(),
            'orderid' => null,
        ], );
    }

    public function customer_ereceipt_action(Request $request)
    {
        $theid = (int) $request->orderid;

        $user = Auth::user();
        $userId = Auth::id();
        $orderan = Pesanan::where('customer_id', Auth::id())->where('is_deleted', false)->get()->where('id', $theid)->first();
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

    public function customer_komplain()
    {
        $user = Auth::user();
        if ($user->is_customer) {
            $userId = Auth::id();
            return view('dashboard.customer.customer_komplain_buat', [
                'account' => $user,
                'accountId' => $userId,
                'users' => User::find($userId),
                'drivers' => Driver::all(),
                'pesanan' => Pesanan::where('is_deleted', false)->where('customer_id', Auth::id())->get()->all(),
            ], );
        }
    }
// * [End] Controller Untuk Customer //
}