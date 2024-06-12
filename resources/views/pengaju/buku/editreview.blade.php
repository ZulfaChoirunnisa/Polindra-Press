@extends('layouts.index')
@section('main-content')
    <div class="pagetitle">
        <h1>Form Edit</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Form Edit</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Buku</h5>
                        <form class="row g-3" method="POST" enctype="multipart/form-data"
                            action="{{ route('Pengaju.Buku.updatereview', $buku->id) }}">
                            @method('PUT')
                            @csrf
                            <div class="col-md-12">
                                <label for="judul" class="form-label">Judul Buku</label>
                                <input type="text" class="form-control" id="judul" name="judul"
                                    value="{{ $buku->judul }}" required>
                            </div>
                            <div class="col-md-12">
                                <label for="jumlahHalaman" class="form-label">Jumlah Halaman</label>
                                <input type="text" class="form-control" id="jumlahHalaman" name="jumlahHalaman"
                                    value="{{ $buku->jumlahHalaman }}" required>
                            </div>
                            <div class="col-md-12">
                                <label for="daftarPustaka" class="form-label">Daftar Pustaka</label>
                                <input type="text" class="form-control" id="daftarPustaka" name="daftarPustaka"
                                    value="{{ $buku->daftarPustaka }}" required>
                            </div>
                            <div class="col-md-12">
                                <label for="resensi" class="form-label">Resensi Buku</label>
                                <input type="text" class="form-control" id="Resensi" name="resensi"
                                    value="{{ $buku->resensi }}" required>
                            </div>
                            <div class="col-md-12">
                                <label for="tahunTerbit" class="form-label">Masukan Tahun Terbit</label>
                                <input type="text" class="form-control" id="tahunTerbit" name="tahunTerbit"
                                    value="{{ $buku->tahunTerbit }}" required>
                            </div>
                            <div class="col-md-12">
                                <label for="harga" class="form-label">Masukan Harga</label>
                                <input type="text" class="form-control" id="harga" name="harga"
                                    value="{{ $buku->harga }}">
                            </div>
                            <div class="col-md-12">
                                <label for="suratKeaslian" class="form-label">Masukan Surat Keasliaan File pdf</label>
                                <input type="file" accept=".pdf" class="form-control" id="suratKeaslian"
                                    name="suratKeaslian">
                                <label for="suratkeaslian" class="form-label">Surat Keaslian Lama</label>
                                <a href="{{ Storage::url($buku->suratKeaslian) }}" target="_blank">Lihat
                                    PDF</a>
                            </div>
                            <div class="col-md-12">
                                <label for="coverbuku" class="form-label">Masukan Cover Buku File image</label>
                                <input type="file" accept=".jpg, .jpeg, .png" class="form-control" id="coverBuku"
                                    name="coverBuku">
                                <label for="coverbuku" class="form-label mt-4">Masukan Cover Buku Depan Lama</label>
                                <img src="{{ Storage::url($buku->coverBuku) }}" class="img-fluid rounded-start"
                                    style="width: 50px; height: 50px;">
                            </div>
                            <div class="col-md-12">
                                <label for="coverBukuBelakang" class="form-label">Masukan Lembar Belakang File image</label>
                                <input type="file" class="form-control" id="coverBukuBelakang" name="coverBukuBelakang"
                                    accept=".jpg, .jpeg, .png">
                                <label for="coverbuku" class="form-label mt-4">Masukan Cover Buku Belakang Lama</label>
                                <img src="{{ Storage::url($buku->coverBukuBelakang) }}" class="img-fluid rounded-start"
                                    style="width: 50px; height: 50px;">
                            </div>
                            <h5 class="card-title">Biodata Penulis</h5>
                            <div class="col-md-6">
                                <label for="namaPenulis" class="form-label">Masukan Nama Penulis</label>
                                <input type="text" class="form-control" id="namaPenulis" name="namaPenulis"
                                    value="{{ $buku->penulis->nama }}"required>
                            </div>
                            <div class="col-md-6">
                                <label for="noTeleponPenulis" class="form-label">No Telefon</label>
                                <input type="number" class="form-control" id="noTeleponPenulis" name="noTeleponPenulis"
                                    value="{{ $buku->penulis->noTelepon }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="alamatPenulis" class="form-label">Alamat</label>
                                <input type="text" class="form-control" id="alamatPenulis" name="alamatPenulis"
                                    value="{{ $buku->penulis->alamat }}" required>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
