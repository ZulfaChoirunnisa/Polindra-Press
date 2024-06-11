@extends('layouts.index')
@section('main-content')
    <div class="pagetitle">
      <h1>Data Ajuan</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
          <li class="breadcrumb-item active">Data Ajuan</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data tables</h5>
              <p>Berikut adalah tabel data pengajuan penerbitan buku yang anda kirim, klik edit untuk revisi.</p>
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
                    <th>Komentar</th>
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
                    <th>{{$bukus->admin_comments}}</th>
                    <td>{{$bukus->status}}</td>
                    @if ($bukus->status == 'tolak'|| $bukus->status == 'pending' || $bukus->status == 'accepted')
                    <td>
                    <!-- <a type="button" class="btn btn-warning" href ="{{route('Pengaju.Buku.Editreview', $bukus->id)}}"><i class="bx bxs-edit-alt"></i></a> -->
                    </td>
                    @else
                    <td>
                    <a type="button" class="btn btn-warning" href ="{{route('Pengaju.Buku.Editreview', $bukus->id)}}"><i class="bx bxs-edit-alt"></i></a>
                    </td>
                    @endif
                    
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