@extends('dashboard.driver.dashboard_driver_template')

@if ($users->pause_status)
    @section('contentx')
        <div class="container-fluid d-flex justify-content-center table-responsive">
            <table class="table table-dark table-striped table-hover table-bordered">
                <thead>
                    <tr class="table-primary">
                        <th>ID Pesanan</th>
                        <th>Nama Customer</th>
                        <th>Nama Penerima</th>
                        <th>Alamat Pickup</th>
                        <th>Alamat Tujuan</th>
                        <th>Berat</th>
                        <th>Deskripsi</th>
                        <th>Jarak</th>
                        <th>Tarif</th>
                        <th>Metode Pembayaran</th>
                        <th>Waktu Dibuat</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider table-striped">
                    @foreach ($pesanan as $item)
                        @if ($item->driver_id == $driver_data->id and $item->is_completed == false)
                            <tr class="table-light">
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->nama_penerima }}</td>
                                <td>{{ $item->alamat_pickup }}</td>
                                <td>{{ $item->alamat_tujuan }}</td>
                                <td>{{ $item->berat }}</td>
                                <td>{{ $item->deskripsi }}</td>
                                <td>{{ $item->jarak }}</td>
                                <td>{{ $item->tarif }}</td>
                                <td>{{ $item->metode_pembayaran }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <a href="driver-pesanan-selesai/{{ $item->id }}">Selesaikan Pesanan</a>
                            </tr>
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
                    <h2>Terima Pesanan yang Tersedia Terlebih Dahulu</h2>
                </div>
                <div class="b-example-divider b-example-vr"></div>
                <div class="text-center">
                    <a class="w-50 btn btn-primary btn-lg center" href="{{ route('driver_pesanan_tersedia') }}" role="button">Ke Menu Proses Pesanan</a>
                </div>
            </div>
        </main>
    @endsection
@endif
