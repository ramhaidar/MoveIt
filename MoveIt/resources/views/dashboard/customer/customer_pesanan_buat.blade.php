@extends('dashboard.customer.dashboard_customer_template')

@if (!$users->pause_status)
    @section('contentx')

        <body class="bg-light">
            <div class="container">
                <div class="py-2 text-center">
                    <h2>Buat Pesanan</h2>
                </div>
                @if (session('success'))
                    <p class="alert alert-success">{{ session('success') }}</p>
                @endif
                @if ($errors->any())
                    @foreach ($errors->all() as $err)
                        <p class="alert alert-danger">{{ $err }}</p>
                    @endforeach
                @endif
                <div class="row g-5">
                    <div class="col-md-0 col-lg-0">
                        <h4 class="mb-3">Isi Form Berikut:</h4>
                        <form name="pesanan" class="needs-validation" novalidate action="{{ route('customer.pesanan.buat.action') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="nama_penerima" class="form-label">Nama Penerima</label>
                                    <input name="nama_penerima" autocomplete="off" type="text" class="form-control" id="nama_penerima" placeholder="Fawwaz Hamid" required>
                                    <div class="invalid-feedback">
                                        Masukkan Nama Penerima!
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="alamat_pickup" class="form-label">Alamat Pickup</label>
                                    <input name="alamat_pickup" autocomplete="off" type="text" class="form-control" id="alamat_pickup" placeholder="Jl. Telekomunikasi No.1, Sukapura, Kec. Dayeuhkolot, Kabupaten Bandung, Jawa Barat 40267" required>
                                    <div class="invalid-feedback">
                                        Masukkan Alamat Pickup!
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="alamat_tujuan" class="form-label">Alamat Tujuan</label>
                                    <input name="alamat_tujuan" autocomplete="off" type="text" class="form-control" id="alamat_tujuan" placeholder="Jl. H. Umayah 1, Citeureup, Kec. Dayeuhkolot, Kabupaten Bandung, Jawa Barat 40257" required>
                                    <div class="invalid-feedback">
                                        Masukkan Alamat Tujuan!
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="berat" class="form-label">Berat (kg)</label>
                                    <input name="berat" autocomplete="off" type="number" min="0" class="form-control" id="berat" placeholder="1" required>
                                    <div class="invalid-feedback">
                                        Masukkan Berat Barang!
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="deskripsi" class="form-label">Deskripsi Barang</label>
                                    <input name="deskripsi" autocomplete="off" type="text" class="form-control" id="deskripsi" placeholder="Barang Pecah Belah" required>
                                    <div class="invalid-feedback">
                                        Masukkan Deskripsi Barang!
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="jarak" class="form-label">Jarak (km)</label>
                                    <input name="jarak" autocomplete="off" type="number" min="0" class="form-control" id="jarak" placeholder="3" required>
                                    <div class="invalid-feedback">
                                        Masukkan Jarak Pengiriman!
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="tarif" class="form-label">Tarif</label>
                                    <input readonly="true" autocomplete="off" name="tarif" class="form-control" id="tarif" placeholder="" required>
                                    <div class="invalid-feedback">
                                        Masukkan Tarif Pengiriman!
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                                    <select autocomplete="off" name="metode_pembayaran" class="form-select" id="metode_pembayaran" placeholder="" required>
                                        <option value="Bayar di Tempat Pickup" selected>Bayar di Tempat Pickup</option>
                                        <option value="Bayar di Tempat Tujuan">Bayar di Tempat Tujuan</option>
                                        <div class="invalid-feedback">
                                            Masukkan Metode Pembayaran!
                                        </div>
                                    </select>
                                </div>
                            </div>
                            <hr class="my-4">
                            <button class="w-100 btn btn-primary btn-lg" type="submit">Konfirmasi Pesanan</button>
                        </form>
                    </div>
                </div>
                <footer class="my-1 pt-1 text-muted text-center text-small"></footer>
            </div>
            <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
            <script src="/js/form-validation.js"></script>
            <script src="/js/tarif-customer.js"></script>
        </body>
    @endsection
@else
    @section('contentx')
        <link href="{{ asset('css/pembatas.css') }}" rel="stylesheet">
        <main class="flex-nowrap px-5">
            <div class="row">
                <div class="w-75 container py-2 text-center">
                    {{-- <h2>Selesaikan Pesanan yang Sedang Berlangsung Terlebih Dahulu, Untuk Membuat Pesanan Baru</h2> --}}
                    <h2>Ada Pesanan yang Sedang Berlangsung, Customer Hanya di Perbolehkan Memiliki Satu Pesanan yang
                        Berlangsung dalam Satu Waktu</h2>
                </div>
                <div class="b-example-divider b-example-vr"></div>
                <div class="text-center">
                    <a class="w-50 btn btn-primary btn-lg center" href="{{ route('customer_pesanan_proses') }}" role="button">Ke Menu Proses Pesanan</a>
                </div>
            </div>
        </main>
    @endsection
@endif
