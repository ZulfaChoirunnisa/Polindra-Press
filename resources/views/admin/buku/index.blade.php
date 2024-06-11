@extends('layouts.index')
@section('main-content')
    <div class="pagetitle">
      <h1>Data Pengajuan</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active">Data Pengajuan</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data tables</h5>
              <p>Berikut adalah tabel data pengajuan penerbitan buku, klik detail untuk review data ajuan.</p>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>
                      <b>J</b>udul
                    </th>
                    <th>Halaman</th>
                    <th>Dafpus</th>
                    <!-- <th data-type="date" data-format="YYYY/DD/MM">Start Date</th> -->
                    <th>Resensi</th>
                    <th>Surat Keaslian</th>
                    <th>ISBN</th>
                    <th>Tahun Terbit</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($buku as $bukus)
                  <tr>
                    <td>{{$bukus->Judul}}</td>
                    <td>{{$bukus->JumlahHalaman}}</td>
                    <td>{{$bukus->DaftarPustaka}}</td>
                    <td>{{$bukus->Resensi}}</td>
                    <td><img src="{{ asset('storage/'.$bukus->suratkeaslian) }}" class="rounded-circle" style="max-width:20%"></td>
                    <td>{{$bukus->ISBN}}</td>
                    <th>{{$bukus->tahunterbit}}</th>
                    <td>{{$bukus->status}}</td>
                    <td>
                    <a type="button" class="btn btn-secondary" href ="{{route('Admin.Buku.Review', $bukus->id)}}"><i class="bi bi-collection"></i></a>
                    </td>
                  </tr>
                 @endforeach
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>
@endsection