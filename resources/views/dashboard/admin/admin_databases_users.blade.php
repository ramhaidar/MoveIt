@extends('dashboard.admin.dashboard_admin_template')

@if ($adaisinya == null)
    @section('contentx')
        <link href="/css/pembatas.css" rel="stylesheet" />
        <main class="flex-nowrap px-5">
            <div class="row">
                <div class="w-75 container py-2 text-center">
                    <h2>Tidak Ada Data Customer.</h2>
                </div>
                <div class="b-example-divider b-example-vr"></div>
                <div class="text-center">
                    <a class="w-50 btn btn-primary btn-lg center" href="{{ request()->fullUrl() }}" role="button">Refresh</a>
                </div>
            </div>
        </main>
    @endsection
@elseif ($ubahid != null)
    @section('contentx')

        <body class="gradient-custom">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-6">
                        <div class="card bg-white text-dark" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">
                                <div class="">
                                    <img class="mx-auto d-block img-circle mb-4" src="{{ URL::asset('/logo/MoveIt_Circle.png') }}">
                                    @if (session('success'))
                                        <p class="alert alert-success">{{ session('success') }}</p>
                                    @endif
                                    @if ($errors->any())
                                        @foreach ($errors->all() as $err)
                                            <p class="alert alert-danger">{{ $err }}</p>
                                        @endforeach
                                    @endif
                                    <h2 class="fw-bold mb-2 text-uppercase">Ubah Kustomer</h2>
                                    <p class="text-dark-50 mb-5">- * - * -</p>
                                    <form action="{{ route('admin.database.users.action') }}" method="POST">
                                        @csrf
                                        <div class="form-outline form-dark mb-4">
                                            <input class="form-control form-control-lg" type="name" name="name" value="{{ $users->name }}" required />
                                            <label class="form-label" for="name">Nama Lengkap</label>
                                        </div>
                                        <div class="form-outline form-dark mb-4">
                                            <input class="form-control form-control-lg" type="username" name="username" value="{{ $users->username }}" required />
                                            <label class="form-label" for="username">Username</label>
                                        </div>
                                        <div class="form-outline form-dark mb-4">
                                            <input class="form-control form-control-lg" type="email" name="email" value="{{ $users->email }}" required />
                                            <label class="form-label" for="email">Email</label>
                                        </div>
                                        <div class="form-outline form-dark mb-4">
                                            <input class="form-control form-control-lg" type="tanggal_lahir" name="tanggal_lahir" value="{{ $users->tanggal_lahir }}" required />
                                            <label class="form-label" for="tanggal_lahir">Tanggal Lahir</label>
                                        </div>
                                        <div class="form-outline form-dark mb-4">
                                            <input class="form-control form-control-lg" type="nik" name="nik" value="{{ $users->nik }}" required />
                                            <label class="form-label" for="nik">NIK</label>
                                        </div>
                                        <div class="form-outline form-dark mb-4">
                                            <input class="form-control form-control-lg" type="nomor_telepon" name="nomor_telepon" value="{{ $users->nomor_telepon }}" required />
                                            <label class="form-label" for="nomor_telepon">Nomor Telepon</label>
                                        </div>
                                        <div class="form-floating form-dark mb-4">
                                            <select class="form-select form-control" type="pause_status" id="pause_status" name="pause_status" required>
                                                @if ($users->pause_status == true)
                                                    <option value=1 selected>true</option>
                                                    <option value=0>false</option>
                                                @else
                                                    <option value=0 selected>false</option>
                                                    <option value=1>true</option>
                                                @endif
                                            </select>
                                            <label class="form-label" for="pause_status">Pause Status</label>
                                        </div>
                                        <div class="mb-3">
                                            <input type="hidden" class="form-control form-control-lg" type="ubahini" name="ubahini" value="{{ $users->id }}" required />
                                            <button class="btn btn-primary form-control mb-2 mt-2">Ubah Data Customer</button>
                                            <a class="btn bg-dark text-white form-control" href="{{ url()->previous() }}">Kembali</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </body>
    @endsection
@else
    @section('contentx')
        <div class="container-fluid justify-content-center table-responsive">
            @if (session('success'))
                <p class="alert alert-success">{{ session('success') }}</p>
            @endif

            @if ($errors->any())
                @foreach ($errors->all() as $err)
                    <p class="alert alert-danger">{{ $err }}</p>
                @endforeach
            @endif
            <table class="table table-dark table-striped table-hover table-bordered">
                <thead>
                    <tr class="table-primary">
                        <th>ID</th>
                        <th>Nama Lengkap</th>
                        <th>Username</th>
                        <th>E-Mail</th>
                        <th>Tanggal Lahir</th>
                        <th>NIK</th>
                        <th>Nomor Telepon</th>
                        <th>Pause Status</th>
                        <th>Waktu Dibuat</th>
                        <th>Waktu Terakhir Diubah</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider table-striped">
                    @foreach ($users as $item)
                        <tr class="table-light">
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->username }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->tanggal_lahir }}</td>
                            <td>{{ $item->nik }}</td>
                            <td>{{ $item->nomor_telepon }}</td>
                            @if ($item->pause_status == true)
                                <td>True</td>
                            @else
                                <td>False</td>
                            @endif
                            <td>{{ $item->created_at }}</td>
                            <th>{{ $item->updated_at }}</th>
                            <td>
                                <form action="{{ route('admin.database.users.action') }}" method="POST">
                                    @csrf
                                    <input type="hidden" class="form-control form-control-lg" type="hapusid" name="hapusid" value="{{ $item->id }}" required />
                                    <button type="submit" class="btn-link" style="padding: 0; border: none; background: none;">Hapus</button>
                                </form>
                                <form action="{{ route('admin.database.users.action') }}" method="POST">
                                    @csrf
                                    <input type="hidden" class="form-control form-control-lg" type="ubahid" name="ubahid" value="{{ $item->id }}" required />
                                    <button type="submit" class="btn-link" style="padding: 0; border: none; background: none;">Ubah</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection
@endif
