<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriverController extends Controller
{
    public function driver_pesanan_terima(Request $request, $id)
    {
        Pesanan::where('id', $id)->update(array('driver_id' => User::where('id', Auth::id())->get('driver_id')->first()->driver_id));

        User::where('id', Auth::id())->update(array('pause_status' => true));

        return redirect()->route('driver_pesanan_proses')->with('success', 'Pesanan Sukses Diterima.');
    }

    public function driver_pesanan_selesai(Request $request, $id)
    {
        Pesanan::where('id', $id)->update(array('is_completed' => true));

        User::where('id', Auth::id())->update(array('pause_status' => false));

        User::where('id', Pesanan::where('id', $id)->get('customer_id')->first()->customer_id)->update(array('pause_status' => false));

        return redirect()->route('driver_pesanan_proses')->with('success', 'Pesanan Sukses Diterima.');
    }
}
