<!DOCTYPE html>
<html lang="en">

@include('layouts.landingpage.head')

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

            <a href="index.html" class="logo d-flex align-items-center">
                <img src="assets/admin/img/POLINDRA.png" alt="">
                <span>PolindraPress</span>
            </a>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto" href="{{ url('/') }}">Home</a></li>
                    <li><a class="nav-link scrollto active" href="#buku">Buku</a></li>
                    <li><a class="nav-link scrollto" href="{{ url('/login') }}">Login</a></li>
                    <li><a class="nav-link scrollto" href="{{ url('/register') }}">Registrasi</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->


    <main id="main">

        <section id="buku" class="services">
            <div class="container" data-aos="fade-up">
                <header class="section-header">
                </header>
                <div class="row">
                    <div class="col-md-9">
                        <div class="card-body">
                            <h1 class="card-title">{{ $detailBuku->judul }}</h1>
                            <!-- <h3 class="mt-2">Rp {{ number_format($detailBuku->harga, 0, ',', '.') }}</h3> -->
                            <table class="table w-100">
                                <tbody>
                                    <tr>
                                        <th scope="row" class="w-25">Judul</th>
                                        <td>{{ $detailBuku->judul }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="w-25">Penulis</th>
                                        <td>{{ $detailBuku->penulis->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="w-25">Tahun Terbit</th>
                                        <td>{{ $detailBuku->tahunTerbit }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="w-25">Jumlah Halaman</th>
                                        <td>{{ $detailBuku->jumlahHalaman }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="w-25">Harga</th>
                                        <td>{{ $detailBuku->harga }}</td>
                                    </tr>
                                    <tr>
                                    <tr>
                                        <th scope="row" class="w-25">ISBN</th>
                                        <td>{{ $detailBuku->isbn }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="w-25">Nomer Produk</th>
                                        <td>{{ $detailBuku->noProduk }}</td>
                                    <tr>
                                        <th scope="row" class="w-25">Update Terakhir</th>
                                        <td>
                                            <small class="text-body-secondary">
                                                {{ \Carbon\Carbon::parse($detailBuku->updated_at)->diffForHumans() }}
                                            </small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="w-25">Resensi Buku</th>
                                        <td>{{ $detailBuku->resensi }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <img src="{{ Storage::url($detailBuku->coverBuku) }}" style="width: 100%; height: auto;"
                            class="img-fluid rounded-start" alt="{{ $detailBuku->coverBuku }}">
                    </div>
                </div>
            </div>
        </section>



    </main><!-- End #main -->

    @include('layouts.landingpage.footer')

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    @include('layouts.landingpage.js')

</body>

</html>
