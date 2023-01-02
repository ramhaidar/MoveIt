@extends('dashboard.customer.dashboard_customer_template')

@if ($pesanan != null)
    @section('contentx')
        <div class="container-fluid d-flex justify-content-center table-responsive">
            <table class="table table-dark table-striped table-hover table-bordered table-responsive">
                <thead>
                    <tr class="table-primary">
                        <th>ID Pesanan</th>
                        <th>Nama Driver</th>
                        <th>Nama Penerima</th>
                        <th>Alamat Pickup</th>
                        <th>Alamat Tujuan</th>
                        <th>Berat</th>
                        <th>Deskripsi</th>
                        <th>Jarak</th>
                        <th>Tarif</th>
                        <th>Metode Pembayaran</th>
                        <th>Waktu Dibuat</th>
                        <th>Waktu Diterima</th>
                        <th>Waktu Diselesaikan</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider table-striped">
                    @foreach ($pesanan as $item)
                        @if ($item->is_completed == 1)
                            <tr class="table-light">
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->driver->name ?? '' }}</td>
                                <td>{{ $item->nama_penerima }}</td>
                                <td>{{ $item->alamat_pickup }}</td>
                                <td>{{ $item->alamat_tujuan }}</td>
                                <td>{{ $item->berat }}</td>
                                <td>{{ $item->deskripsi }}</td>
                                <td>{{ $item->jarak }}</td>
                                <td>{{ $item->tarif }}</td>
                                <td>{{ $item->metode_pembayaran }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->accepted_at }}</td>
                                <td>{{ $item->completed_at }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
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
