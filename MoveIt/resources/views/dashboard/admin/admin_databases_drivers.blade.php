@extends('dashboard.admin.dashboard_admin_template')

@if ($adaisinya == null)
    @section('contentx')
        <style>
            .b-example-divider {
                height: 3rem;
                background-color: rgba(0, 0, 0, .0);
                border: solid rgba(0, 0, 0, .0);
                border-width: 1px 0;
                box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .0), inset 0 .125em .5em rgba(0, 0, 0, .0);
            }

            .b-example-vr {
                flex-shrink: 0;
                width: 1.5rem;
                height: 670px;
            }
        </style>
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

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
            <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
            <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
        </head>
        <style>
            .gradient-custom {
                background: #6a11cb;
                background: -webkit-linear-gradient(to right, rgb(32, 32, 32), rgb(49, 49, 49));
                background: linear-gradient(to right, rgb(32, 32, 32), rgb(49, 49, 49));
            }

            .img-circle {
                width: 200px;
                height: 200px;
                border: solid 3px #ffa600;
                border-radius: 50%;
                overflow: hidden;
                display: inline-block;
                vertical-align: middle;
            }
        </style>

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
                                    <h2 class="fw-bold mb-2 text-uppercase">Ubah Driver</h2>
                                    <p class="text-dark-50 mb-5">- * - * -</p>
                                    <form action="{{ route('admin.database.drivers.action') }}" method="POST">
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
                                                    <option selected value=1>true</option>
                                                    <option value=0>false</option>
                                                @else
                                                    <option selected value=0>false</option>
                                                    <option value=1>true</option>
                                                @endif
                                            </select>
                                            <label class="form-label" for="pause_status">Pause Status</label>
                                        </div>
                                        <div class="form-floating form-dark mb-4">
                                            <select class="form-select form-control-lg" type="jenis_kendaraan" id="jenis_kendaraan" value="{{ $users->driver->jenis_kendaraan }}" name="jenis_kendaraan" required>
                                                <option value="{{ $users->driver->jenis_kendaraan }}" selected>{{ $users->driver->jenis_kendaraan }}</option>
                                                @if ($users->driver->jenis_kendaraan != 'Motor')
                                                    <option value="Motor">Motor</option>
                                                @endif
                                                @if ($users->driver->jenis_kendaraan != 'Van')
                                                    <option value="Van">Van</option>
                                                @endif
                                                @if ($users->driver->jenis_kendaraan != 'PickUp')
                                                    <option value="PickUp">PickUp</option>
                                                @endif
                                                @if ($users->driver->jenis_kendaraan != 'Engkel')
                                                    <option value="Engkel">Engkel</option>
                                                @endif
                                                @if ($users->driver->jenis_kendaraan != 'CDD')
                                                    <option value="CDD">CDD</option>
                                                @endif
                                            </select>
                                            <label class="form-label" for="jenis_kendaraan">Jenis Kendaraan</label>
                                        </div>
                                        <div class="form-outline form-dark mb-4">
                                            <input class="form-control form-control-lg" type="nomor_polisi" name="nomor_polisi" value="{{ $users->driver->nomor_polisi }}" required />
                                            <label class="form-label" for="nomor_polisi">Nomor Polisi</label>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript">
            $(function() {
                $('.datepicker').datepicker({
                    format: 'dd/mm/yyyy',
                    startDate: '-3d'
                });
                $.fn.datepicker.defaults.format = "dd/mm/yyyy";
            });
        </script>
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
                        <th>ID Driver</th>
                        <th>Nama Driver</th>
                        <th>Username</th>
                        <th>E-Mail</th>
                        <th>Tanggal Lahir</th>
                        <th>NIK</th>
                        <th>Nomor Telepon</th>
                        <th>Pause Status</th>
                        <th>Jenis Kendaraan</th>
                        <th>Nomor Polisi</th>
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
                            <td>{{ $item->driver->jenis_kendaraan }}</td>
                            <td>{{ $item->driver->nomor_polisi }}</td>
                            <td>{{ $item->created_at }}</td>
                            <th>{{ $item->updated_at }}</th>
                            <td>
                                <form action="{{ route('admin.database.drivers.action') }}" method="POST">
                                    @csrf
                                    <input type="hidden" class="form-control form-control-lg" type="hapusid" name="hapusid" value="{{ $item->id }}" required />
                                    <button type="submit" class="btn-link" style="padding: 0; border: none; background: none;">Hapus</button>
                                </form>
                                <form action="{{ route('admin.database.drivers.action') }}" method="POST">
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
