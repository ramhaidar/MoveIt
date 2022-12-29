<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriverController extends Controller
{
    public function driver_pesanan_terima(Request $request, $id)
    {
        Pesanan::where('id', $id)->update(array('driver_id' => User::where('id', Auth::id())->get('driver_id')->first()->driver_id));

        Pesanan::where('id', $id)->update(array('accepted_at' => Carbon::now()));

        User::where('id', Auth::id())->update(array('pause_status' => true));

        return redirect()->route('driver_pesanan_proses')->with('success', 'Pesanan Sukses Diterima.');
    }

    public function driver_pesanan_selesai(Request $request, $id)
    {
        Pesanan::where('id', $id)->update(array('is_completed' => true));

        Pesanan::where('id', $id)->update(array('completed_at' => Carbon::now()));

        User::where('id', Auth::id())->update(array('pause_status' => false));

        User::where('id', Pesanan::where('id', $id)->get('customer_id')->first()->customer_id)->update(array('pause_status' => false));

        return redirect()->route('driver_pesanan_riwayat')->with('success', 'Pesanan Sukses Diselesaikan.');
    }
}
