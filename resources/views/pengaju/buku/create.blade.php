@extends('layouts.index')
@section('main-content')
    <div class="pagetitle">
        <h1>Form Pengajuan Buku</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Form Pengajuan Buku</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tambah Data Buku</h5>

                        <!-- Custom Styled Validation -->
                        <form class="row g-3" method="POST" enctype="multipart/form-data"
                            action="{{ route('Pengaju.Buku.Store') }}">
                            @csrf
                            <div class="col-md-12">
                                <label for="Judul" class="form-label">Masukan Judul Buku</label>
                                <input type="text" class="form-control" id="judul" name="judul" required>
                            </div>
                            <div class="col-md-12">
                                <label for="JumlahHalaman" class="form-label">Masukan Jumlah Halaman</label>
                                <input type="text" class="form-control" id="jumlahHalaman" name="jumlahHalaman" required>
                            </div>
                            <div class="col-md-12">
                                <label for="DaftarPustaka" class="form-label">Masukan Daftar Pustaka</label>
                                <input type="text" class="form-control" id="daftarPustaka" name="daftarPustaka" required>
                            </div>
                            <div class="col-md-12">
                                <label for="Resensi" class="form-label">Masukan Resensi Buku</label>
                                <input type="text" class="form-control" id="resensi" name="resensi" required>
                            </div>
                            <div class="col-md-12">
                                <label for="tahunterbit" class="form-label">Masukan Tahun Terbit</label>
                                <input type="text" class="form-control" id="tahunTerbit" name="tahunTerbit" required>
                            </div>
                            <div class="col-md-12">
                                <label for="harga" class="form-label">Masukan Harga</label>
                                <input type="number" class="form-control" id="harga" name="harga" required>
                            </div>
                            <div class="col-md-12">
                                <label for="coverbuku" class="form-label">Masukan Cover Buku Depan</label>
                                <input type="file" class="form-control" id="coverBuku" name="coverBuku"
                                    accept=".jpg, .jpeg, .png" required>
                            </div>
                            <div class="col-md-12">
                                <label for="coverbuku" class="form-label">Masukan Cover Buku Belakang</label>
                                <input type="file" class="form-control" id="coverBukuBelakang" name="coverBukuBelakang"
                                    accept=".jpg, .jpeg, .png" required>
                            </div>
                            <div class="col-md-12">
                                <label for="suratkeaslian" class="form-label">Masukan Surat Keasliaan File pdf</label>
                                <input type="file" class="form-control" id="suratKeaslian" name="suratKeaslian"
                                    accept=".pdf" required>
                            </div>
                            <h5 class="card-title">Biodata Penulis</h5>
                            <div class="col-md-6">
                                <label for="nama" class="form-label">Masukan Nama Penulis</label>
                                <input type="text" class="form-control" id="namaPenulis" name="namaPenulis" required>
                            </div>
                            <div class="col-md-6">
                                <label for="noTeleponPenulis" class="form-label">Masukan No Telefon</label>
                                <input type="text" class="form-control" id="NoTelepon" name="noTeleponPenulis" required>
                            </div>
                            <div class="col-md-6">
                                <label for="alamatPenulis" class="form-label">Masukan Alamat</label>
                                <input type="text" class="form-control" id="Alamat" name="alamatPenulis" required>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="invalidCheck"
                                        required>
                                    <label class="form-check-label" for="invalidCheck">
                                        Agree to terms and conditions
                                    </label>
                                    <div class="invalid-feedback">
                                        You must agree before submitting.
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Submit form</button>
                            </div>
                        </form><!-- End Custom Styled Validation -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
