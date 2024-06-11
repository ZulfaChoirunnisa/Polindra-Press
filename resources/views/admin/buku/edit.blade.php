@extends('layouts.index')
@section('main-content')
    <div class="pagetitle">
      <h1>Form Edit</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
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
              <form class="row g-3" method="POST"  enctype="multipart/form-data" action="{{route('Admin.Buku.Storeedit', $buku->id)}}" >
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="col-md-12">
                  <label for="Judul" class="form-label">Judul Buku</label>
                  <input type="text" class="form-control" id="Judul" name="Judul" value="{{$buku->Judul}}" required>
                </div>
                <div class="col-md-12">
                  <label for="JumlahHalaman" class="form-label">Jumlah Halaman</label>
                  <input type="text" class="form-control" id="JumlahHalaman" name="JumlahHalaman" value="{{$buku->JumlahHalaman}}" required>
                </div>
                <div class="col-md-12">
                  <label for="DaftarPustaka" class="form-label">Daftar Pustaka</label>
                  <input type="text" class="form-control" id="DaftarPustaka" name="DaftarPustaka" value="{{$buku->DaftarPustaka}}" required>
                </div>
                <div class="col-md-12">
                  <label for="Resensi" class="form-label">Resensi Buku</label>
                  <input type="text" class="form-control" id="Resensi" name="Resensi" value="{{$buku->Resensi}}" required>
                </div> 
                <div class="col-md-12">
                  <label for="tahunterbit" class="form-label">Tambahkan Tahun Terbit</label>
                  <input type="text" class="form-control" id="tahunterbit" name="tahunterbit" value="{{$buku->tahunterbit}}">
                </div> 
                <div class="col-md-12">
                  <label for="harga" class="form-label">Tambahkan Harga</label>
                  <input type="text" class="form-control" id="harga" name="harga" value="{{$buku->harga}}">
                </div> 
                <div class="col-md-12">
                  <label for="ISBN" class="form-label">Tambahkan ISBN</label>
                  <input type="text" class="form-control" id="ISBN" name="ISBN" value="{{$buku->ISBN}}">
                </div> 
                <div class="col-md-12">
                  <label for="noproduk" class="form-label">Tambahkan Product Number</label>
                  <input type="text" class="form-control" id="noproduk" name="noproduk" value="{{$buku->noproduk}}">
                </div> 
                <div class="col-md-12">
                  <label for="harga" class="form-label">Tambahkan Harga</label>
                  <input type="text" class="form-control" id="harga" name="harga" value="{{$buku->harga}}">
                </div>
                <div class="col-md-12">
                  <label for="Suratkeaslian" class="form-label">File Surat Keasliaan</label>
                  <img src="{{ asset('storage/'.$buku->suratkeaslian) }}" class="rounded-circle" style="max-width:10%">
                  <!-- <input type="file" class="form-control" id="Suratkeaslian" name="Suratkeaslian" value="{{$buku->Suratkeaslian}}" > -->
                </div> 
                <div class="col-md-12">
                  <label for="coverbuku" class="form-label">File Cover Buku</label>
                  <img src="{{ asset('storage/'.$buku->coverbuku) }}" class="rounded-circle" style="max-width:10%">
                  <!-- <input type="file" class="form-control" id="coverbuku" name="coverbuku" value="{{$buku->coverbuku}}" > -->
                </div> 
                <div class="col-md-12">
                  <label for="lembarbelakang" class="form-label">File Lembar Belakang</label>
                  <img src="{{ asset('storage/'.$buku->lembarbelakang) }}" class="rounded-circle" style="max-width:10%">
                  <!-- <input type="file" class="form-control" id="lembarbelakang" name="lembarbelakang" value="{{$buku->lembarbelakang}}" > -->
                </div> 
                <h5 class="card-title">Biodata Penulis</h5>
                <div class="col-md-6">
                  <label for="NAMA" class="form-label">Masukan Nama Penulis</label>
                  <input type="text" class="form-control" id="NAMA" name="NAMA" value="{{caripenulis($buku->id)->NAMA}}"required>
                </div> 
                <div class="col-md-6">
                  <label for="NoTelepon" class="form-label">No Telefon</label>
                  <input type="text" class="form-control" id="NoTelepon" name="NoTelepon" value="{{caripenulis($buku->id)->NoTelepon}}" required>
                </div> 
                <div class="col-md-6">
                  <label for="Alamat" class="form-label">Alamat</label>
                  <input type="text" class="form-control" id="Alamat" name="Alamat" value="{{caripenulis($buku->id)->Alamat}}" required>
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