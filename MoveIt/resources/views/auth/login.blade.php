@section('title', 'Login')

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

                                <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                                <p class="text-dark-50 mb-5">Masukkan Kredensial</p>

                                <form action="{{ route('login.action') }}" method="POST">
                                    @csrf

                                    <div class="form-outline form-dark mb-4">
                                        <input class="form-control form-control-lg" autocomplete="off" type="username" name="username" value="{{ old('username') }}" required />
                                        <label class="form-label" for="username">Username</label>
                                    </div>

                                    <div class="form-outline form-dark mb-4">
                                        <input class="form-control form-control-lg" autocomplete="off" type="password" name="password" required />
                                        <label class="form-label" for="password">Password</label>
                                    </div>

                                    <div class="mb-3">
                                        <button class="btn btn-primary form-control mb-2 mt-2">Login</button>
                                        <a class="btn bg-dark text-white form-control" href="{{ route('home') }}">Kembali</a>
                                    </div>

                                    <div class="mt-4">
                                        <p class="small">
                                            <a class="text-dark">Belum Punya Akun?</a>
                                            <a class="small"><br></a>
                                            <a class="text-dark-50" href="{{ route('registrasi-customer') }}">Registrasi Customer</a>
                                            <br>
                                            <a class="text-dark-50" href="{{ route('registrasi-driver') }}">Registrasi Driver</a>
                                        </p>
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
