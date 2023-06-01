@section('title', 'Registrasi Customer')

@extends('app')

@section('content')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
</head>

<style>
    .gradient-custom {
        /* fallback for old browsers */
        background: #6a11cb ;

        /* Chrome 10-25, Safari 5.1-6 */
        background: -webkit-linear-gradient(to right, rgb(32, 32, 32), rgb(49, 49, 49));

        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
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

{{-- <body> --}}


<body class="gradient-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-6">
                <div class="card bg-white text-dark" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">

                        {{-- <div class="mb-md-5 mt-md-4 pb-5"> --}}
                        <div class="">

                            <img class="mx-auto d-block img-circle mb-4" src="{{URL::asset('/logo/MoveIt_Circle.png')}}">

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
                                    <input class="form-control form-control-lg" type="username" name="username" value="{{ old('username') }}" required />
                                    <label class="form-label" for="username">Username</label>
                                </div>

                                <div class="form-outline form-dark mb-4">
                                    <input class="form-control form-control-lg" type="password" name="password" required />
                                    <label class="form-label" for="password">Password</label>
                                </div>

                                <div class="mb-3">
                                    <button class="btn btn-primary form-control mb-2 mt-2">Login</button>
                                    <a class="btn bg-dark text-white form-control" href="{{ route('home') }}">Back</a>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript">
        $(function() {
            // $('#datetimepicker').datetimepicker();
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy'
                , startDate: '-3d'
            });
            $.fn.datepicker.defaults.format = "dd/mm/yyyy";
        });

    </script>
{{-- </body> --}}
{{-- </html> --}}

@endsection