@extends('layouts.index')
@section('main-content')
    <div class="pagetitle">
      <h1>Form Ajuan</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active">Form Ajuan Buku</li>
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
              <form class="row g-3" method="POST" enctype="multipart/form-data" action="{{route('Admin.Buku.postreview',$buku->id)}}" >
                @csrf
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
                  <label for="tahunterbit" class="form-label">Tahun Terbit</label>
                  <input type="text" class="form-control" id="tahunterbit" name="tahunterbit" value="{{$buku->tahunterbit}}">
                </div> 
                <!-- <div class="col-md-12">
                  <label for="harga" class="form-label">Harga</label>
                  <input type="text" class="form-control" id="harga" name="harga" value="{{$buku->harga}}">
                </div>  -->
                <div class="col-md-12">
                  <label for="coverbuku" class="form-label">File Cover Buku Depan</label>
                  <img src="{{ asset('storage/'.$buku->coverbuku) }}" class="rounded-circle" style="max-width:10%">
                  <!-- <input type="file" class="form-control" id="coverbuku" name="coverbuku" value="{{$buku->coverbuku}}" > -->
                </div> 
                <div class="col-md-12">
                  <label for="coverbuku" class="form-label">File Cover Buku Belakang</label>
                  <img src="{{ asset('storage/'.$buku->coverBukuBelakang) }}" class="rounded-circle" style="max-width:10%">
                  <!-- <input type="file" class="form-control" id="coverbuku" name="coverbuku" value="{{$buku->coverbuku}}" > -->
                </div> 
                <div class="col-md-12">
                  <label for="suratkeaslian" class="form-label">File Surat Keasliaan : </label>
                  <img src="{{ asset('storage/'.$buku->suratkeaslian) }}" class="rounded-circle" style="max-width:10%">
                </div> 
                <div class="col-md-12">
                  <label for="draftBuku" class="form-label">File Surat Keasliaan : </label>
                  <img src="{{ asset('storage/'.$buku->draftBuku) }}" class="rounded-circle" style="max-width:10%">
                </div> 
                <h5 class="card-title">Biodata Penulis</h5>
                <div class="col-md-6">
                  <label for="nama" class="form-label">Nama Penulis</label>
                  <input type="text" class="form-control" id="namaPenulis" name="namaPenulis" value="{{caripenulis($buku->id)->NAMA}}"required>
                </div> 
                <div class="col-md-6">
                  <label for="noTeleponPenulis" class="form-label">No Telefon</label>
                  <input type="text" class="form-control" id="NoTelepon" name="NoTelepon" value="{{caripenulis($buku->id)->NoTelepon}}" required>
                </div> 
                <div class="col-md-6">
                  <label for="alamatPenulis" class="form-label">Alamat</label>
                  <input type="text" class="form-control" id="Alamat" name="Alamat" value="{{caripenulis($buku->id)->Alamat}}" required>
                </div> 
                <h5 class="card-title">Review Anda</h5>
                <div class="col-md-12">
                  <label for="admin_comments" class="form-label">Komentar</label>
                  <textarea type="text" class="form-control" id="admin_comments" name="admin_comments" row="5" required></textarea>
                </div> 
                <div class="col-12">
                  <!-- <input type="checkbox" id="acceptCheckbox" name="acceptCheckbox" value="accepted"> -->
                  <label for="acceptCheckbox">Status</label>
                  <select name="status" id="status">
                    <option value="accept">Terima</option>
                    <option value="revisi">Revisi</option>
                    <option value="rejected">Tolak</option>
                  </select>
                </div>
                <!-- <div class="col-12">
                  <input type="checkbox" id="rejectCheckbox" name="rejectCheckbox" value="rejected">
                  <label for="rejectCheckbox">Tolak</label>
                </div> -->
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