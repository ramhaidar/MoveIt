@extends('dashboard.customer.dashboard_customer_template')

@if ($pesanan != null)
    @section('contentx')
        <link href="{{ asset('css/pembatas.css') }}" rel="stylesheet">
        <main class="flex-nowrap px-5">
            <div class="row">
                <div class="w-75 container py-2 text-center">
                    <h2>Untuk Melakukan Komplain Silahkan Hubungi Kontak Berikut dengan Menyertakan Bukti E-Receipt:</h2>
                    <br>
                    <h2>WhatsApp: +6281282763509</h2>
                    <h2>E-Mail: lalamovesudo@gmail.com</h2>
                    <h2>Atau Tekan Tombol Dibawah.</h2>
                </div>
                <div class="b-example-divider b-example-vr"></div>
                <div class="text-center">
                    <a class="w-50 btn btn-lg center text-white" style="background-color: #0dc342" href="http://api.whatsapp.com/send/?phone=6281282763509" rel="noreferrer noopener" target="_blank" role="button">WhatsApp</a>
                </div>
                <div class="text-center mt-2">
                    <a class="w-50 btn btn-lg center text-white" style="background-color: #fbbc04" href="mailto:lalamovesudo@gmail.com" rel="noreferrer noopener" target="_blank" role="button">E-Mail</a>
                </div>
            </div>
        </main>
    @endsection
@else
    @section('contentx')
        <link href="{{ asset('css/pembatas.css') }}" rel="stylesheet">
        <main class="flex-nowrap px-5">
            <div class="row">
                <div class="w-75 container py-2 text-center">
                    <h2>Tidak Ada Riwayat Pesanan, Silakan Mulai Untuk Membuat Pesanan Terlebih Dahulu.</h2>
                </div>
                <div class="b-example-divider b-example-vr"></div>
                <div class="text-center">
                    <a class="w-50 btn btn-primary btn-lg center" href="{{ route('customer_pesanan_buat') }}" role="button">Buat Pesanan</a>
                </div>
            </div>
        </main>
    @endsection
@endif
