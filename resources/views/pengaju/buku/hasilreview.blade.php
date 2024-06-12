@extends('layouts.index')
@section('main-content')
    <div class="pagetitle">
        <h1>Data Ajuan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
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
                                    <th>No</th>
                                    <th>
                                        <b>J</b>udul
                                    </th>
                                    <th>Jumlah Halman</th>
                                    <th>Dafpus</th>
                                    <th>Resensi</th>
                                    <th>Surat Keaslian</th>
                                    <th>Cover Buku</th>
                                    <th>Tahun Terbit</th>
                                    <th>Status</th>
                                    <th>Komentar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($buku as $bukus)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $bukus->judul }}</td>
                                        <td>{{ $bukus->jumlahHalaman }}</td>
                                        <td>{{ $bukus->daftarPustaka }}</td>
                                        <td>{{ $bukus->resensi }}</td>
                                        <td><a href="{{ Storage::url($bukus->suratKeaslian) }}" target="_blank">Lihat
                                                PDF</a>
                                        </td>
                                        <td><img src="{{ Storage::url($bukus->coverBuku) }}" class="rounded-circle"
                                                style="width: 50px; height: 50px;"></td>
                                        <th>{{ $bukus->tahunTerbit }}</th>
                                        <td>
                                            @if ($bukus->status == 'pending')
                                                <span class="badge bg-info">Pending</span>
                                            @elseif ($bukus->status == 'accept')
                                                <span class="badge bg-primary">Accepted</span>
                                            @elseif ($bukus->status == 'revisi')
                                                <span class="badge bg-warning">Revisi</span>
                                            @elseif ($bukus->status == 'tolak')
                                                <span class="badge bg-danger">Tolak</span>
                                            @endif
                                        </td>
                                        <th>
                                            @if ($bukus->adminComment == null)
                                                <span>Belum ada komen</span>
                                            @else
                                                {{ $bukus->adminComment }}
                                            @endif
                                        </th>
                                        @if ($bukus->status == 'revisi')
                                            <td>
                                                <a type="button" class="btn btn-warning"
                                                    href ="{{ route('Pengaju.Buku.Editreview', $bukus->id) }}">
                                                    <i class="bx bxs-edit-alt"></i></a>
                                            </td>
                                        @else
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
