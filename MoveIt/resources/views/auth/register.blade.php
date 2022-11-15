@extends('app')
@section('content')

    <div class="vh-100 d-flex justify-content-center align-items-center">
        <div class="login-box">

            <img class="mx-auto d-block img-circle mb-3" src="{{URL::asset('/logo/MoveIt_Circle.png')}}" >

            @if ($errors->any())
                @foreach ($errors->all() as $err)
                    <p class="alert alert-danger">{{ $err }}</p>
                @endforeach
            @endif

            <form action="{{ route('register.action') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name">Nama Lengkap <span class="text-danger">*</span></label>
                    <input class="form-control" type="name" name="name" value="{{ old('name') }}" required/>
                </div>

                <div class="mb-3">
                    <label>Username <span class="text-danger">*</span></label>
                    <input class="form-control" type="username" name="username" value="{{ old('username') }}" required/>
                </div>

                <div class="mb-3">
                    <label>Email <span class="text-danger">*</span></label>
                    <input class="form-control" type="email" name="email" value="{{ old('email') }}" required/>
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

                <div class="mb-3">
                    <label>NIK <span class="text-danger">*</span></label>
                    <input class="form-control" type="nik" name="nik" required/>
                </div>

                <div class="mb-3">
                    <label>Password <span class="text-danger">*</span></label>
                    <input class="form-control" type="password" name="password" required/>
                </div>

                <div class="mb-3">
                    <label>Password Confirmation<span class="text-danger">*</span></label>
                    <input class="form-control" type="password" name="password_confirm" required/>
                </div>

                <div class="mb-3">
                    <button class="btn btn-primary form-control mb-2 mt-2">Register</button>
                    <a class="btn btn-danger form-control" href="{{ route('home') }}">Back</a>
                </div>

            </form>
        </div>
    </div>

    <body class="text-center">
    
        <main class="form-signin w-100 m-auto">
          <form>
            <img class="mb-4" src="/docs/5.2/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
        
            <div class="form-floating">
              <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
              <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating">
              <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
              <label for="floatingPassword">Password</label>
            </div>
        
            <div class="checkbox mb-3">
              <label>
                <input type="checkbox" value="remember-me"> Remember me
              </label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
            <p class="mt-5 mb-3 text-muted">© 2017–2022</p>
          </form>
        </main>
        
        
            
          
        
        <style nonce="61e09c0486254d8f9044f4bd203" data-source="URL Shortener Unshortener" type="text/css">#smgm_bgdiv{ text-align: center;position:fixed;top:0px;left:0px;z-index:9991;width:100%;height:100%;background-color:black;opacity:0.7;display:block;visibility:visible;}</style><style nonce="61e09c0486254d8f9044f4bd203" data-source="URL Shortener Unshortener" type="text/css">#smgm_dialogbox { vertical-align:middle;left:40px;top:15px;border:3px solid #000 !important;text-align:center !important;background-color:#fff !important;color:#000 !important;font-family:arial,verdana !important;z-Index:9999;position:fixed;width:18%;height:50%;margin-left:auto;margin-right:auto;display:block;visibility:visible;}</style><style nonce="61e09c0486254d8f9044f4bd203" data-source="URL Shortener Unshortener" type="text/css">.smgm_buttons { color:#000 !important;font: 90% 'arial','trebuchet ms',helvetica,sans-serif !important;background-color:#B2CCFF !important;border:2px solid !important;border-color: #E0EBFF #000 #000 #E0EBFF !important;vertical-align: top !important;}</style><style nonce="61e09c0486254d8f9044f4bd203" data-source="URL Shortener Unshortener" type="text/css">.smgm_table { margin-bottom:10px !important;border:0px !important;border-collapse:collapse !important;margin-left:auto;margin-right:auto; }</style></body>


@endsection
