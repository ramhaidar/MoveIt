@extends('dashboard.admin.dashboard_admin_template')

@if ($adaisinya == null)
    @section('contentx')
        <link href="/css/pembatas.css" rel="stylesheet" />
        <main class="flex-nowrap px-5">
            <div class="row">
                <div class="w-75 container py-2 text-center">
                    <h2>Tidak Ada Riwayat E-Receipt Sekarang, Silakan Cek Lagi Nanti.</h2>
                </div>
                <div class="b-example-divider b-example-vr"></div>
                <div class="text-center">
                    <a class="w-50 btn btn-primary btn-lg center" href="{{ request()->fullUrl() }}" role="button">Refresh</a>
                </div>
            </div>
        </main>
    @endsection
@elseif ($orderid == null)
    @section('contentx')
        <div class="container-fluid justify-content-center table-responsive">
            <table class="table table-dark table-striped table-hover table-bordered">
                <thead>
                    <tr class="table-primary">
                        <th style="max-width: 2cm;">ID Pesanan</th>
                        <th>Nama Customer</th>
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
                        <th>#</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider table-striped">
                    @foreach ($pesanan as $item)
                        @if ($item->is_completed == 1)
                            <tr class="table-light">
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->user->name }}</td>
                                <th>{{ $item->driver->name ?? '...' }}</th>
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
                                <td>
                                    <form action="{{ route('admin.ereceipt.lihat.action') }}" method="POST">
                                        @csrf
                                        <input type="hidden" class="form-control form-control-lg" type="orderid" name="orderid" value="{{ $item->id }}" required />
                                        <button type="submit" class="btn-link" style="padding: 0;
                                        border: none;
                                        background: none;">Lihat E-Receipt</button>
                                    </form>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection
@else
    @section('contentx')
        <div class="card">
            <div class="card-body mx-4">
                <div class="container">
                    <p class="mx-1 text-center" style="font-size: 30px;">Terima Kasih sudah Menggunakan Jasa MoveIt!
                    </p>
                    <div class="row">
                        <ul class="list-unstyled">
                            <li class="text-black fs-5"><strong>Customer: {{ $pemesan->name }}</strong></li>
                            <li class="text-muted mt-1"><span class="font-monospace text-black">Invoice</span>
                                #{{ $orderan->id }}</li>
                        </ul>
                        <div class="container">
                            <div class="row align-items-start">
                                <div class="col-6 col-sm-2 text-black">Waktu Dibuat</div>
                                <div class="col text-black">: {{ $orderan->created_at }}</div>
                                <div class="w-100"></div>
                                <div class="col-6 col-sm-2 text-black">Waktu Diterima</div>
                                <div class="col text-black">: {{ $orderan->accepted_at }}</div>
                                <div class="w-100"></div>
                                <div class="col-6 col-sm-2 text-black">Waktu Diselesaikan</div>
                                <div class="col text-black">: {{ $orderan->completed_at }}</div>
                                <hr>
                                <div class="w-100"></div>
                                <div class="col-6 col-sm-2 text-black">Alamat Pickup</div>
                                <div class="col text-black">: {{ $orderan->alamat_pickup }}</div>
                                <div class="w-100"></div>
                                <div class="col-6 col-sm-2 text-black">Alamat Tujuan</div>
                                <div class="col text-black">: {{ $orderan->alamat_tujuan }}</div>
                                <hr>
                            </div>
                        </div>
                        <hr>
                        <div class="text-black">
                            <div class="row">
                                <div class="col-xl-10">
                                    <p>Driver:</p>
                                </div>
                                <div class="col-xl-2">
                                    <p class="float-end">{{ $pengantar->name }}
                                    </p>
                                </div>
                                <hr>
                            </div>
                            <div class="row">
                                <div class="col-xl-10">
                                    <p>Nama Penerima:</p>
                                </div>
                                <div class="col-xl-2">
                                    <p class="float-end text-end">{{ $orderan->nama_penerima }}
                                    </p>
                                </div>
                                <hr>
                            </div>
                            <div class="row">
                                <div class="col-xl-10">
                                    <p>Berat: </p>
                                </div>
                                <div class="col-xl-2">
                                    <p class="float-end text-end">{{ $orderan->berat }}kg
                                    </p>
                                </div>
                                <hr>
                            </div>
                            <div class="row">
                                <div class="col-xl-10">
                                    <p>Deskripsi: </p>
                                </div>
                                <div class="col-xl-2">
                                    <p class="float-end text-end">{{ $orderan->deskripsi }}
                                    </p>
                                </div>
                                <hr>
                            </div>
                            <div class="row">
                                <div class="col-xl-10">
                                    <p>Metode Pembayaran: </p>
                                </div>
                                <div class="col-xl-2">
                                    <p class="float-end text-end">{{ $orderan->metode_pembayaran }}
                                    </p>
                                </div>
                                <hr>
                            </div>
                            <div class="row">
                                <div class="col-xl-10">
                                    <p>Jarak: </p>
                                </div>
                                <div class="col-xl-2">
                                    <p class="float-end text-end">{{ $orderan->jarak }}km
                                    </p>
                                </div>
                                <hr style="border: 2px solid black;">
                            </div>
                            <div class="row text-black">
                                <div class="col-xl-12">
                                    <p class="float-end fw-bold">Tarif: {{ $orderan->tarif }}
                                    </p>
                                </div>
                                <hr style="border: 2px solid black;">
                            </div>
                            <div class="text-center" style="margin-top: 10px;">
                                <a><u class="text-info">🚀</u></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
@endif
