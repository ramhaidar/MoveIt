@section('title', 'Registrasi Driver')

@extends('app')

@section('head')
    <link href="/css/registration-page.css" rel="stylesheet">
@endsection

@section('content')

    <body class="gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-6">
                    <div class="card bg-white text-dark" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            {{-- <div class="mb-md-5 mt-md-4 pb-5"> --}}
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

                                <h2 class="fw-bold mb-2 text-uppercase">Registrasi Driver</h2>
                                <p class="text-dark-50 mb-5">Masukkan Data Data</p>

                                <form action="{{ route('registrasi.driver.action') }}" method="POST">
                                    @csrf

                                    <div class="form-outline form-dark mb-4">
                                        @if (old('name') == null)
                                            <input class="form-control form-control-lg" autocomplete="off" type="name" name="name" value="Muhammad Raihan" required />
                                        @else
                                            <input class="form-control form-control-lg" autocomplete="off" type="name" name="name" value="{{ old('name') }}" required />
                                        @endif
                                        <label class="form-label" for="name">Nama Lengkap</label>
                                    </div>

                                    <div class="form-outline form-dark mb-4">
                                        @if (old('username') == null)
                                            <input class="form-control form-control-lg" autocomplete="off" type="username" name="username" value="raihan123" required />
                                        @else
                                            <input class="form-control form-control-lg" autocomplete="off" type="username" name="username" value="{{ old('username') }}" required />
                                        @endif
                                        <label class="form-label" for="username">Username</label>
                                    </div>

                                    <div class="form-outline form-dark mb-4">
                                        @if (old('email') == null)
                                            <input class="form-control form-control-lg" autocomplete="off" type="email" name="email" value="muhammadraihan@gmail.com" required />
                                        @else
                                            <input class="form-control form-control-lg" autocomplete="off" type="email" name="email" value="{{ old('email') }}" required />
                                        @endif
                                        <label class="form-label" for="email">Email</label>
                                    </div>

                                    {{-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
                                    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> --}}

                                    <div class="form-outline mb-4">
                                        @if (old('tanggal_lahir') == null)
                                            <input class="form-control form-control-lg rounded-1" autocomplete="off" type="text" name="tanggal_lahir" value="22/11/2001" id="datepicker"></p>
                                        @else
                                            <input class="form-control form-control-lg rounded-1" autocomplete="off" type="text" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" id="datepicker"></p>
                                        @endif
                                        <label class="form-label" for="tanggal_lahir">Tanggal Lahir</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        @if (old('nik') == null)
                                            <input class="form-control form-control-lg" autocomplete="off" type="nik" name="nik" value="3525016405740001" required />
                                        @else
                                            <input class="form-control form-control-lg" autocomplete="off" type="nik" name="nik" value="{{ old('nik') }}" required />
                                        @endif
                                        <label class="form-label" for="nik">NIK</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        @if (old('nomor_telepon') == null)
                                            <input class="form-control form-control-lg" autocomplete="off" type="nomor_telepon" name="nomor_telepon" value="081234567890" required />
                                        @else
                                            <input class="form-control form-control-lg" autocomplete="off" type="nomor_telepon" name="nomor_telepon" value="{{ old('nomor_telepon') }}" required />
                                        @endif
                                        <label class="form-label" for="nomor_telepon">Nomor Telepon</label>
                                    </div>

                                    {{-- <div class="form-dark mb-4">
                                        <select class="form-control form-control-lg" autocomplete="off" name="jenis_kendaraan" id="PilihKendaraan">
                                            @if (old('jenis_kendaraan') == null)
                                                <option class="text-dark" value="Motor" selected>Motor</option>
                                            @else
                                                <option selected>{{ old('jenis_kendaraan') }}</option>
                                                <option class="text-dark" value="Motor">Motor</option>
                                            @endif
                                            <option value="Van">Van</option>
                                            <option value="PickUp">PickUp</option>
                                            <option value="Engkel">Engkel</option>
                                            <option value="CDD">CDD</option>
                                        </select>
                                    </div> --}}

                                    <div class="form-floating form-dark mb-4">
                                        <select class="form-select form-control" type="jenis_kendaraan" id="jenis_kendaraan" name="jenis_kendaraan" required>
                                            @if (old('jenis_kendaraan') != null)
                                                <option class="text-dark" value="{{ old('jenis_kendaraan') }}" selected>{{ old('jenis_kendaraan') }}</option>
                                            @endif
                                            @if (old('jenis_kendaraan') != 'Motor')
                                                <option value="Motor">Motor</option>
                                            @endif
                                            @if (old('jenis_kendaraan') != 'Van')
                                                <option value="Van">Van</option>
                                            @endif
                                            @if (old('jenis_kendaraan') != 'PickUp')
                                                <option value="PickUp">PickUp</option>
                                            @endif
                                            @if (old('jenis_kendaraan') != 'Engkel')
                                                <option value="Engkel">Engkel</option>
                                            @endif
                                            @if (old('jenis_kendaraan') != 'CDD')
                                                <option value="CDD">CDD</option>
                                            @endif
                                        </select>
                                        <label class="form-label text-black" for="jenis_kendaraan">Jenis Kendaraan</label>
                                    </div>

                                    <div class="form-outline form-dark mb-4">
                                        @if (old('nomor_polisi') == null)
                                            <input class="form-control form-control-lg" autocomplete="off" type="nomor_polisi" name="nomor_polisi" required value="D 7070 UI" />
                                        @else
                                            <input class="form-control form-control-lg" autocomplete="off" type="nomor_polisi" name="nomor_polisi" required value="{{ old('nomor_polisi') }}" />
                                        @endif
                                        <label class="form-label" for="nomor_polisi">Nomor Polisi</label>
                                    </div>

                                    <div class="form-outline form-dark mb-4">
                                        <input class="form-control form-control-lg" autocomplete="off" type="password" name="password" required />
                                        <label class="form-label" for="password">Password</label>
                                    </div>

                                    <div class="form-outline form-dark mb-4">
                                        <input class="form-control form-control-lg" autocomplete="off" type="password" name="password_confirm" required />
                                        <label class="form-label" for="password">Konfirmasi Password</label>
                                    </div>

                                    <div class="mb-3">
                                        <button class="btn btn-primary form-control mb-2 mt-2">Registrasi</button>
                                        <a class="btn bg-dark text-white form-control" href="{{ route('home') }}">Kembali</a>
                                    </div>

                                    <div class="mt-4">
                                        <p class="small">
                                            <a class="text-dark">Sudah Punya Akun?</a>
                                            <a class="small"><br></a>
                                            <a class="text-dark-50" href="{{ route('login') }}">Login Disini</a>
                                            {{-- <br> --}}
                                            {{-- <a class="text-dark-50" href="{{ route('registrasi-driver') }}">Registrasi Driver</a> --}}
                                        </p>
                                    </div>

                                    {{-- <button class="btn btn-btn-dark btn-primary bg-dark btn-lg px-5 mt-5" type="submit">Login</button>  --}}

                                    {{-- <div class="d-flex justify-content-center text-center mt-4 pt-1">
                                        <a href="#!" class="text-dark"><i class="fab fa-facebook-f fa-lg"></i></a>
                                        <a href="#!" class="text-dark"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                                        <a href="#!" class="text-dark"><i class="fab fa-google fa-lg"></i></a>
                                    </div> --}}
                                </form>

                            </div>

                            {{-- <div>
                                <p class="mb-0">Don't have an account? <a href="#!" class="text-dark-50 fw-bold">Sign Up</a>
                                </p>
                            </div> --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
@endsection

@section('script')
@endsection
