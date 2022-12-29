@extends('dashboard.driver.dashboard_driver_template')

@section('contentx')
    <div class="container-fluid d-flex justify-content-center table-responsive">
        <table class="table table-dark table-striped table-hover table-bordered">
            <thead>
                <tr class="table-primary">
                    <th>ID Pesanan</th>
                    <th>Nama Cusomer</th>
                    <th>Nama Penerima</th>
                    <th>Alamat Pickup</th>
                    <th>Alamat Tujuan</th>
                    <th>Berat</th>
                    <th>Deskripsi</th>
                    <th>Jarak</th>
                    <th>Tarif</th>
                    <th>Waktu Dibuat</th>
                    <th>Waktu Diterima</th>
                    <th>Waktu Diselesaikan</th>
                </tr>
            </thead>
            <tbody class="table-group-divider table-striped">
                @foreach ($pesanan as $item)
                    @if ($item->is_completed == 1 and $item->driver_id == $driver_data->id)
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
