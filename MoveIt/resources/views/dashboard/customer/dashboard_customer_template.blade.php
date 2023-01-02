@section('title', 'Dashboard Customer')

@extends('app')

@section('head')
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard-template.css') }}" rel="stylesheet">
@endsection

@section('content')

    <body id="page-top">
        <div id="wrapper">
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
                <a class="sidebar-brand d-flex align-items-center justify-content-center">
                    <div class="sidebar-brand-icon">
                        <img src="/logo/MoveIt_Car_Circle.png" class="img-fluid img-thumbnail mt-3" id="logokiriatas" />
                    </div>
                    <div class="sidebar-brand-text ml-0 mr-2 mt-3">Dashboard</div>
                </a>
                <hr class="sidebar-divider my-0">
                <li class="nav-item active mt-3">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="fas fa-fw fa-home"></i>
                        <span>Home</span></a>
                </li>
                <hr class="sidebar-divider">
                <div class="sidebar-heading">
                    Alat-Alat
                </div>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#PesananCollapse" aria-expanded="true" aria-controls="SecondCollapse">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Pesanan</span>
                    </a>
                    <div id="PesananCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('customer_pesanan_buat') }}">Buat</a>
                            <a class="collapse-item" href="{{ route('customer_pesanan_proses') }}">Proses</a>
                            <a class="collapse-item" href="{{ route('customer_pesanan_riwayat') }}">Riwayat</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('customer_ereceipt') }}">
                        <i class="fas fa-fw fa-receipt"></i>
                        <span>E-Receipt</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('customer_komplain') }}">
                        <i class="fas fa-fw fa-tired"></i>
                        <span>Komplain</span></a>
                </li>
                <hr class="sidebar-divider">
                <hr class="sidebar-divider d-none d-md-block">
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-1" id="sidebarToggle"></button>
                </div>
                <div class="sidebar-card d-none d-lg-flex">
                    <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
                    <a href="{{ request()->fullUrl() }}" class="btn btn-success btn-sm fw-bold fs-6">Refresh</a>
                </div>
            </ul>
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                        <div class="container-fluid text-center">
                            <div class="row justify-content-start align-items-center">
                                <div class="col-4">
                                    <p></p>
                                    <a class="fw-lighter text-dark data"></a>
                                    <br>
                                    <a class="fw-lighter text-dark data"></a>
                                    <p></p>
                                </div>
                            </div>
                            <div>
                                <div class="row justify-content-start align-items-center">
                                    <div class="col-4">
                                        <p></p>
                                        <span class="mr-2 d-none d-lg-inline font-monospace text-gray-600 small">{{ $account->username }}</span>
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown no-arrow d-sm-none">
                                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-search fa-fw"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                    <form class="form-inline mr-auto w-100 navbar-search">
                                        <div class="input-group">
                                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button">
                                                    <i class="fas fa-search fa-sm"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </li>
                            <div class="topbar-divider d-none d-sm-block"></div>
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mx-3 d-none d-lg-inline text-gray-600 small">{{ $account->name }}</span>
                                    <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="{{ route('ganti-password') }}">
                                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Ganti Password
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                    <div class="container-fluid">
                        @yield('contentx')
                    </div>
                    <div class="container-fluid">
                        <div class="row"></div>
                    </div>
                </div>
                <div class="copyright text-center my-auto pb-2">
                    <span>MoveIt! &copy; 2022 Copyright</span>
                </div>
            </div>
        </div>
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
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
    </body>
@endsection

@section('script')
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
@endsection
