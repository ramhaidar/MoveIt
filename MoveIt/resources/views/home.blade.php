@extends('app')

@section('content')

    @auth

        <div class="vh-100 d-flex justify-content-center align-items-center">
            <div class="login-box">

                <img class="mx-auto d-block img-circle" src="{{URL::asset('/logo/MoveIt_Circle.png')}}">

                <p>Selamat Datang <b>{{ $users->name }}</b></p>

                @if ($users->is_admin)
                    <p><b>Admin</b></p>
                @endif
                @if ($users->is_customer)
                    <p><b>Customer</b></p>
                @endif
                @if ($users->is_driver)
                    <p><b>Driver</b></p>
                @endif

                <a class="btn btn-primary form-control mb-3 mt-3" href="{{ route('password') }}">Change Password</a>
                <a class="btn btn-danger form-control" href="{{ route('logout') }}">Logout</a>

            </div>
        </div>
    @endauth

    @guest
        <div class="vh-100 d-flex justify-content-center align-items-center">
            <div class="login-box">

                <img class="mx-auto d-block img-circle mb-3" src="{{URL::asset('/logo/MoveIt_Circle.png')}}">

                <a class="w-100 btn btn-lg btn-primary mb-3 mt-3" href="{{ route('login') }}">Login</a>
                <a class="w-100 btn btn-lg btn-info mb-3" href="{{ route('register') }}">Registrasi Customer</a>
                <a class="w-100 btn btn-lg btn-info" href="{{ route('register_driver') }}">Registrasi Driver</a>

            </div>
        </div>
    @endguest

@endsection