@extends('dashboard.driver.dashboard_driver_template')


@section('contentx')
<div class="container-fluid d-flex justify-content-center table-responsive">
    <table class="table table-dark table-striped table-hover table-bordered">
        <thead>
            <tr class="table-primary">
                <th>ID Pesanan</th>
                <th>Alamat Pickup</th>
                <th>Alamat Tujuan</th>
                <th>Berat</th>
                <th>Deskripsi</th>
                <th>Jarak</th>
                <th>Tarif</th>
                <th>Tanggal Dibuat</th>
                <th>Jam Dibuat</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody class="table-group-divider table-striped">
            @foreach ($pesanan as $item)
            @if($item->driver_id == $driver_data->id AND $item->is_completed == false)
            <tr class="table-light">
                <td>{{ $item->id }}</td>
                <td>{{ $item->alamat_pickup }}</td>
                <td>{{ $item->alamat_tujuan }}</td>
                <td>{{ $item->berat }}</td>
                <td>{{ $item->deskripsi }}</td>
                <td>{{ $item->jarak }}</td>
                <td>{{ $item->tarif }}</td>
                <td>{{ $item->tanggal }}</td>
                <td>{{ $item->jam }}</td>
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
