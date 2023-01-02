@extends('dashboard.customer.dashboard_customer_template')

@if ($orderid != null)
@section('contentx')
<div class="card">
    <div class="card-body mx-4">
        <div class="container">
            <p class="my-5 mx-5" style="font-size: 30px;">Terima Kasih sudah Menggunakan Jasa MoveIt!</p>
            <div class="row">
            <ul class="list-unstyled">
                <li class="text-black"><strong>{{ $pemesan->name }}</strong></li>
                <li class="text-muted mt-1"><span class="text-black">Invoice</span> #{{ $orderan->id }}</li>
                <li class="text-black mt-1">{{ $orderan->tanggal }} | {{ $orderan->jam }}</li>
                <li class="text-black mt-1">Alamat Pickup: {{ $orderan->alamat_pickup }}</li>
                <li class="text-black mt-1">Alamat Tujuan: {{ $orderan->alamat_tujuan }}</li>
            </ul>
            <hr>
            <div class="col-xl-10">
                <p>Nama Penerima:</p>
            </div>
            <div class="col-xl-2">
                <p class="float-end">{{ $orderan->nama_penerima }}
                </p>
            </div>
            <hr>
            </div>
            <div class="row">
            <div class="col-xl-10">
                <p>Berat: </p>
            </div>
            <div class="col-xl-2">
                <p class="float-end">{{ $orderan->berat }}kg
                </p>
            </div>
            <hr>
            </div>
            <div class="row">
            <div class="col-xl-10">
                <p>Deskripsi</p>
            </div>
            <div class="col-xl-2">
                <p class="float-end">{{ $orderan->deskripsi }}
                </p>
            </div>
            <hr>
            </div>
            <div class="row">
            <div class="col-xl-10">
                <p>Jarak</p>
            </div>
            <div class="col-xl-2">
                <p class="float-end">{{ $orderan->jarak }}km
                </p>
            </div>
            <hr style="border: 2px solid black;">
            </div>
            <div class="row text-black">
    
            <div class="col-xl-12">
                <p class="float-end fw-bold">Tarif: Rp{{ number_format($orderan->tarif, 2, ',', '.') }}
                </p>
            </div>
            <hr style="border: 2px solid black;">
            </div>
            <div class="text-center" style="margin-top: 90px;">
            <a><u class="text-info">🚀</u></a>
            </div>
        </div>
    </div>
</div>
@endsection
@endif