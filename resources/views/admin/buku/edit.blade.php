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

                        <!-- Custom Styled Validation -->
                        <form class="row g-3" method="POST" enctype="multipart/form-data"
                            action="{{ route('Admin.Buku.Storeedit', $buku->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="col-md-12">
                                <label for="Judul" class="form-label">Judul Buku</label>
                                <input type="text" class="form-control" id="Judul" name="Judul"
                                    value="{{ $buku->judul }}" disabled>
                            </div>
                            <div class="col-md-12">
                                <label for="JumlahHalaman" class="form-label">Jumlah Halaman</label>
                                <input type="text" class="form-control" value="{{ $buku->jumlahHalaman }}" disabled>
                            </div>
                            <div class="col-md-12">
                                <label for="DaftarPustaka" class="form-label">Daftar Pustaka</label>
                                <input type="text" class="form-control" value="{{ $buku->daftarPustaka }}" disabled>
                            </div>
                            <div class="col-md-12">
                                <label for="Resensi" class="form-label">Resensi Buku</label>
                                <input type="text" class="form-control" value="{{ $buku->resensi }}" disabled>
                            </div>
                            <div class="col-md-12">
                                <label for="tahunterbit" class="form-label">Tambahkan Tahun Terbit</label>
                                <input type="text" class="form-control" value="{{ $buku->tahunTerbit }}" disabled>
                            </div>
                            <div class="col-md-12">
                                <label for="harga" class="form-label">Tambahkan Harga</label>
                                <input type="text" class="form-control" value="{{ $buku->harga }}" disabled>
                            </div>
                            <div class="col-md-12">
                                <label for="ISBN" class="form-label">Tambahkan ISBN</label>
                                <input type="text" class="form-control" id="ISBN" name="isbn"
                                    value="{{ $buku->ISBN }}">
                            </div>
                            <div class="col-md-12">
                                <label for="noproduk" class="form-label">Tambahkan Product Number</label>
                                <input type="text" class="form-control" id="noproduk" name="noProduk"
                                    value="{{ $buku->noproduk }}">
                            </div>
                            <div class="col-md-12">
                                <label for="Suratkeaslian" class="form-label">File Surat Keasliaan</label>
                                <a href="{{ Storage::url($buku->suratKeaslian) }}" target="_blank">Lihat
                                    PDF</a>
                            </div>
                            <div class="col-md-12">
                                <label for="coverbuku" class="form-label">File Cover Buku</label>
                                <img src="{{ Storage::url($buku->coverBuku) }}" class="img-fluid rounded-start"
                                    style="width: 50px; height: 50px;">
                            </div>
                            <div class="col-md-12">
                                <label for="lembarbelakang" class="form-label">File Lembar Belakang</label>
                                <img src="{{ Storage::url($buku->coverBukuBelakang) }}" class="img-fluid rounded-start"
                                    style="width: 50px; height: 50px;">
                            </div>
                            <h5 class="card-title">Biodata Penulis</h5>
                            <div class="col-md-6">
                                <label for="NAMA" class="form-label">Masukan Nama Penulis</label>
                                <input type="text" class="form-control" value="{{ $buku->penulis->nama }}" disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="NoTelepon" class="form-label">No Telefon</label>
                                <input type="text" class="form-control" value="{{ $buku->penulis->noTelepon }}"
                                    disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="Alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control" value="{{ $buku->penulis->alamat }}"
                                    disabled>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </form><!-- End Custom Styled Validation -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
