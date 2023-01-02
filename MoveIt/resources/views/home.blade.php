@section('title', 'Home')

@extends('app')

@section('head')
    <link href="/css/home.css" rel="stylesheet" />
@endsection

@section('content')
    <nav class="navbar navbar-expand-lg navbar-dark d-none d-lg-block" style="z-index: 2000;">
        <div class="container-fluid">
            <a href="{{ request()->fullUrl() }}" id="LogoKiriAtas">
                <img src="/logo/MoveIt_Transparan2.png" class="img-fluid" />
            </a>
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarExample01" aria-controls="navbarExample01" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarExample01">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                </ul>
                <ul class="navbar-nav list-inline">
                    <li>
                        @auth
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                @if ($users->is_admin)
                                    <a class="btn btn-success me-md-1">Admin</a>
                                    <a class="btn btn-primary me-md-1" href="{{ route('dashboard_admin') }}" role="button">Dashboard</a>
                                    <button type="button" class="btn btn-danger me-md-1" data-bs-toggle="modal" data-bs-target="#logoutModal">LogOut</button>
                                @endif
                                @if ($users->is_driver)
                                    <a class="btn btn-success me-md-1">Driver</a>
                                    <a class="btn btn-primary me-md-1" href="{{ route('dashboard_driver') }}" role="button">Dashboard</a>
                                    <button type="button" class="btn btn-danger me-md-1" data-bs-toggle="modal" data-bs-target="#logoutModal">LogOut</button>
                                @endif
                                @if ($users->is_customer)
                                    <a class="btn btn-success me-md-1">Customer</a>
                                    <a class="btn btn-primary me-md-1" href="{{ route('dashboard_customer') }}" role="button">Dashboard</a>
                                    <button type="button" class="btn btn-danger me-md-1" data-bs-toggle="modal" data-bs-target="#logoutModal">LogOut</button>
                                @endif
                            </div>
                        @endauth
                        @guest
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a class="btn btn-dark me-md-1 bg-dark" href="{{ route('login') }}" role="button">Login</a>
                                <a class="btn btn-dark me-md-1 bg-dark" href="{{ route('registrasi-customer') }}" role="button">Registrasi Customer</a>
                                <a class="btn btn-dark bg-dark" href="{{ route('registrasi-driver') }}" role="button">Registrasi Driver</a>
                            </div>
                        @endguest
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div id="introCarousel" class="carousel slide carousel-fade shadow-2-strong" data-mdb-ride="carousel">
        <ol class="carousel-indicators">
            <li data-mdb-target="#introCarousel" data-mdb-slide-to="0" class="active"></li>
            <li data-mdb-target="#introCarousel" data-mdb-slide-to="1"></li>
            <li data-mdb-target="#introCarousel" data-mdb-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="mask" style="background-color: rgba(0, 0, 0, 0.6);">
                    <div class="d-flex justify-content-center align-items-center h-100">
                        <div class="text-white text-center">
                            <h1 class="mb-3">Deliver Faster</h1>
                            <h5 class="mb-4">The 24/7 on-demand delivery app</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="mask" style="background-color: rgba(0, 0, 0, 0.3);">
                    <div class="d-flex justify-content-center align-items-center h-100">
                        <div class="text-white text-center">
                            <h1 class="mb-3">Deliver Faster</h1>
                            <h5 class="mb-4">The 24/7 on-demand delivery app</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="mask" style="background: linear-gradient(45deg,rgba(29, 236, 197, 0.7),rgba(91, 14, 214, 0.7) 100%);">
                    <div class="d-flex justify-content-center align-items-center h-100">
                        <div class="text-white text-center">
                            <h1 class="mb-3">Deliver Faster</h1>
                            <h5 class="mb-4">The 24/7 on-demand delivery app</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#introCarousel" role="button" data-mdb-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#introCarousel" role="button" data-mdb-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    </header>
    <footer class="bg-light text-lg-start">
        <div class="text-center py-4 align-items-center">
            <p>Follow MoveIt! on social media</p>
            <a href="https://www.youtube.com/" class="btn btn-primary m-1" role="button" rel="nofollow" target="_blank">
                <i class="fab fa-youtube"></i>
            </a>
            <a href="https://www.facebook.com/" class="btn btn-primary m-1" role="button" rel="nofollow" target="_blank">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://twitter.com/" class="btn btn-primary m-1" role="button" rel="nofollow" target="_blank">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="https://github.com/" class="btn btn-primary m-1" role="button" rel="nofollow" target="_blank">
                <i class="fab fa-github"></i>
            </a>
        </div>
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            MoveIt! © 2022 Copyright:
            <a class="text-dark">MoveIt.com</a>
        </div>
    </footer>
    <div class="modal fade" id="logoutModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Siap untuk Keluar?</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">Pilih "Logout" di bawah jika Anda siap untuk mengakhiri sesi Anda saat ini.</div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Batal</button>
                    <a class="btn btn-danger" href="{{ route('logout') }}">Logout</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="/js/mdb.min.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
@endsection
