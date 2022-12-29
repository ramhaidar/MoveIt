<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function customer_buat_pesanan(Request $request)
    {
        $request->validate([
            'nama_penerima' => 'required',
            'alamat_pickup' => 'required',
            'alamat_tujuan' => 'required',
            'berat' => 'required|numeric|between:0,500',
            'deskripsi' => 'required',
            'jarak' => 'required|numeric|min:0',
            'tarif' => 'required|numeric|min:0',
        ]);

        // $TanggalPesanan = date("Y-m-d");
        // $WaktuPesanan = date("H:i:s");

        $pesanan = new Pesanan([
            'nama_penerima' => $request->nama_penerima,
            'alamat_pickup' => $request->alamat_pickup,
            'alamat_tujuan' => $request->alamat_tujuan,
            'berat' => $request->berat,
            'deskripsi' => $request->deskripsi,
            'jarak' => $request->jarak,
            'tarif' => $request->tarif,
            // 'tanggal' => $TanggalPesanan,
            // 'jam' => $WaktuPesanan,
            'is_completed' => false,
            'customer_id' => Auth::id(),
        ]);
        $pesanan->save();

        User::where('id', Auth::id())->update(array('pause_status' => true));

        return redirect()->route('customer_pesanan_proses')->with('success', 'Pesanan Sukses Dibuat.');
    }

    public function customer_ereceipt_lihat(Request $request, $theid)
    {
        $user = Auth::user();
        $userId = Auth::id();
        $orderan = Pesanan::where('customer_id', Auth::id())->get()->where('id', $theid)->first();
        $pemesan = User::where('id', $orderan->customer_id)->get()->first();

        return view('dashboard.customer.customer_ereceipt', [
            'account' => $user,
            'accountId' => $userId,
            'users' => User::find($userId),
            'pemesan' => $pemesan,
            'orderan' => $orderan,
            'orderid' => $orderan->id,
        ], );
    }
}
