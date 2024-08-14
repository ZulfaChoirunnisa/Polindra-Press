@extends('layouts.index')
@section('main-content')
    <div class="pagetitle">
        <h1>Form Pengajuan Buku</h1>
        <nav>
            <ol class="breadcrumb" >
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

                        <!-- Menampilkan Pesan Kesalahan -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Custom Styled Validation -->
                        <form class="row g-3" method="POST" enctype="multipart/form-data" action="{{ route('Pengaju.Buku.Store') }}">
                            @csrf
                            <div class="col-md-12">
                                <label for="judul" class="form-label">Judul Buku</label>
                                <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul') }}" required>
                            </div>
                            <div class="col-md-12">
                                <label for="jumlahHalaman" class="form-label">Jumlah Halaman</label>
                                <input type="text" class="form-control" id="jumlahHalaman" name="jumlahHalaman" value="{{ old('jumlahHalaman') }}" required>
                            </div>
                            <div class="col-md-12">
                                <label for="daftarPustaka" class="form-label">Daftar Pustaka</label>
                                <input type="text" class="form-control" id="daftarPustaka" name="daftarPustaka" value="{{ old('daftarPustaka') }}" required>
                            </div>
                            <div class="col-md-12">
                                <label for="resensi" class="form-label">Resensi Buku</label>
                                <input type="text" class="form-control" id="resensi" name="resensi" value="{{ old('resensi') }}" required>
                            </div>
                            <div class="col-md-12">
                                <label for="tahunTerbit" class="form-label">Tahun Terbit</label>
                                <input type="text" class="form-control" id="tahunTerbit" name="tahunTerbit" value="{{ old('tahunTerbit') }}" required>
                            </div>
                            <!-- <div class="col-md-12">
                                <label for="harga" class="form-label">Harga</label>
                                <input type="number" class="form-control" id="harga" name="harga" value="{{ old('harga') }}" required>
                            </div> -->
                            <div class="col-md-12">
                                <label for="suratKeaslian" class="form-label">Surat Keaslian (File PDF)</label>
                                <input type="file" class="form-control" id="suratKeaslian" name="suratKeaslian" accept=".pdf" required>
                            </div>
                            <div class="col-md-12">
                                <label for="draftBuku" class="form-label">Draft Buku (File PDF)</label>
                                <input type="file" class="form-control" id="draftBuku" name="draftBuku" accept=".pdf" required>
                            </div>
                            <div class="col-md-12">
                                <label for="coverBuku" class="form-label">Cover Buku Depan (image)</label>
                                <input type="file" class="form-control" id="coverBuku" name="coverBuku" accept=".jpg, .jpeg, .png" required>
                            </div>
                            <div class="col-md-12">
                                <label for="coverBukuBelakang" class="form-label">Cover Buku Belakang (image)</label>
                                <input type="file" class="form-control" id="coverBukuBelakang" name="coverBukuBelakang" accept=".jpg, .jpeg, .png" required>
                            </div>
                            <h5 class="card-title">Biodata Penulis</h5>
                            <div class="col-md-6">
                                <label for="namaPenulis" class="form-label">Nama Penulis</label>
                                <input type="text" class="form-control" id="namaPenulis" name="namaPenulis" value="{{ old('namaPenulis') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="noTeleponPenulis" class="form-label">No Telefon</label>
                                <input type="text" class="form-control" id="noTeleponPenulis" name="noTeleponPenulis" value="{{ old('noTeleponPenulis') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="alamatPenulis" class="form-label">Alamat</label>
                                <input type="text" class="form-control" id="alamatPenulis" name="alamatPenulis" value="{{ old('alamatPenulis') }}" required>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                                    <label class="form-check-label" for="invalidCheck">
                                        Setuju dengan syarat dan ketentuan
                                    </label>
                                    <div class="invalid-feedback">
                                        Anda harus setuju sebelum mengirim.
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Ajukan Buku</button>
                            </div>
                        </form><!-- End Custom Styled Validation -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
