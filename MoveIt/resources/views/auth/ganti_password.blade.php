@section('title', 'Ganti Password')

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
                                <h2 class="fw-bold mb-5 text-uppercase">Ganti Password</h2>
                                <form action="{{ route('ganti.password.action') }}" method="POST">
                                    @csrf
                                    <div class="form-outline form-dark mb-4">
                                        <input class="form-control form-control-lg" autocomplete="off" type="password" name="old_password" required />
                                        <label class="form-label" for="old_password">Password Saat Ini</label>
                                    </div>
                                    <div class="form-outline form-dark mb-4">
                                        <input class="form-control form-control-lg" autocomplete="off" type="password" name="new_password" required />
                                        <label class="form-label" for="new_password">Password Baru</label>
                                    </div>
                                    <div class="form-outline form-dark mb-4">
                                        <input class="form-control form-control-lg" autocomplete="off" type="password" name="new_password_confirmation" required />
                                        <label class="form-label" for="new_password_confirmation">Konfirmasi Password Baru</label>
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary form-control mb-2 mt-2">Ganti Password</button>
                                        @if ($account->is_customer)
                                            <a class="btn bg-dark text-white form-control" href="{{ route('dashboard_customer') }}">Kembali</a>
                                        @endif
                                        @if ($account->is_driver)
                                            <a class="btn bg-dark text-white form-control" href="{{ route('dashboard_driver') }}">Kembali</a>
                                        @endif
                                        @if ($account->is_admin)
                                            <a class="btn bg-dark text-white form-control" href="{{ route('dashboard_admin') }}">Kembali</a>
                                        @endif
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
