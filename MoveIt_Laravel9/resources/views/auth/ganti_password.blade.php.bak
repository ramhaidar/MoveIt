@section('title', 'Ganti Password')

@extends('app')

@section('content')

    <div class="vh-100 d-flex justify-content-center align-items-center">
        <div class="login-box">

            @if(session('success'))
                <p class="alert alert-success">{{ session('success') }}</p>
            @endif

            @if($errors->any())
                @foreach($errors->all() as $err)
                    <p class="alert alert-danger">{{ $err }}</p>
                @endforeach
            @endif

            <form action="{{ route('ganti.password.action') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Password Saat Ini <span class="text-danger">*</span></label>
                    <input class="form-control" type="password" name="old_password" required/>
                </div>
                <div class="mb-3">
                    <label>Password Baru <span class="text-danger">*</span></label>
                    <input class="form-control" type="password" name="new_password" required/>
                </div>
                <div class="mb-3">
                    <label>Konfirmasi Password Baru <span class="text-danger">*</span></label>
                    <input class="form-control" type="password" name="new_password_confirmation" required/>
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary form-control mb-2 mt-2">Change</button>
                    <a class="btn btn-danger form-control" href="{{ route('home') }}">Back</a>
                </div>
            </form>
        </div>
    </div>

@endsection