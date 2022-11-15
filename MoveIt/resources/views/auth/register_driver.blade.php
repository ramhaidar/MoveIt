@extends('app')
@section('content')

    <p><br><br><br><br></p>
    <div class="vh-100 d-flex justify-content-center align-items-center">
        <div class="login-box">

            <img class="mx-auto d-block img-circle mb-3" src="{{URL::asset('/logo/MoveIt_Circle.png')}}">

            @if($errors->any())
                @foreach($errors->all() as $err)
                    <p class="alert alert-danger">{{ $err }}</p>
                @endforeach
            @endif

            <form action="{{ route('register.driver.action') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Nama Lengkap <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="name" value="{{ old('name') }}" />
                </div>

                <div class="mb-3">
                    <label>Username <span class="text-danger">*</span></label>
                    <input class="form-control" type="username" name="username" value="{{ old('username') }}" />
                </div>

                <div class="mb-3">
                    <label>Email <span class="text-danger">*</span></label>
                    <input class="form-control" type="email" name="email" value="{{ old('email') }}" />
                </div>

                @if(old('tanggal_lahir') == NULL)
                <label>Tanggal Lahir <span class="text-danger">*</span></label>
                <div class="input-group date mb-3" data-provide="datepicker">
                    <div>
                    </div>
                    <input class="form-control input-group-addon rounded-1" date-format="yyyy/mm/dd" name="tanggal_lahir" value="" required>
                    <div>
                    </div>
                </div>
                @else
                <label>Tanggal Lahir <span class="text-danger">*</span></label>
                <div class="input-group date mb-3" data-provide="datepicker">
                    <div>
                    </div>
                    <input class="form-control input-group-addon rounded-1" date-format="yyyy/mm/dd" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                    <div>
                    </div>
                </div>
                @endif


                <label>Tanggal Lahir <span class="text-danger">*</span></label>
                <div class="input-group date mb-3" data-provide="datepicker">
                    <div>
                    </div>
                    <input class="form-control input-group-addon rounded-1" date-format="yyyy/mm/dd" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                    <div>
                    </div>
                </div>

                <div class="mb-3">
                    <label>NIK <span class="text-danger">*</span></label>
                    <input class="form-control" type="nik" name="nik" value="{{ old('nik') }}" />
                </div>

                <div class="mb-3">
                    <label>Jenis Kendaraan <span class="text-danger">*</span></label>
                    <input class="form-control" type="jenis_kendaraan" name="jenis_kendaraan" value="{{ old('jenis_kendaraan') }}" />
                </div>

                <div class="mb-3">
                    <label>Nomor Polisi <span class="text-danger">*</span></label>
                    <input class="form-control" type="nomor_polisi" name="nomor_polisi" value="{{ old('nomor_polisi') }}" />
                </div>

                <div class="mb-3">
                    <label>Password <span class="text-danger">*</span></label>
                    <input class="form-control" type="password" name="password" />
                </div>

                <div class="mb-3">
                    <label>Password Confirmation<span class="text-danger">*</span></label>
                    <input class="form-control" type="password" name="password_confirm" />
                </div>

                <div class="mb-3">
                    <button class="btn btn-primary form-control mb-2 mt-2">Register</button>
                    <a class="btn btn-danger form-control" href="{{ route('home') }}">Back</a>
                </div>

            </form>
        </div>
    </div>
    <p><br><br><br><br></p>

@endsection
