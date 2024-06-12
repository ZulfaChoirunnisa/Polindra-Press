@extends('layouts.index')
@section('main-content')
    <div class="pagetitle">
        <h1>Data Pengajuan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
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
                                    <th>Resensi</th>
                                    <th>Surat Keaslian</th>
                                    <th>ISBN</th>
                                    <th>Tahun Terbit</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($buku as $bukus)
                                    <tr>
                                        <td>{{ $bukus->judul }}</td>
                                        <td>{{ $bukus->jumlahHalaman }}</td>
                                        <td>{{ $bukus->daftarPustaka }}</td>
                                        <td>{{ $bukus->resensi }}</td>
                                        <td><a href="{{ Storage::url($bukus->suratKeaslian) }}" target="_blank">Lihat
                                                PDF</a>
                                        </td>
                                        <td>{{ $bukus->isbn }}</td>
                                        <th>{{ $bukus->tahunTerbit }}</th>
                                        <td>
                                            @if ($bukus->status == 'pending')
                                                <span class="badge bg-info">Pending</span>
                                            @elseif ($bukus->status == 'accept')
                                                <span class="badge bg-primary">Accepted</span>
                                            @elseif ($bukus->status == 'revisi')
                                                <span class="badge bg-warnign">Revisi</span>
                                            @elseif ($bukus->status == 'tolak')
                                                <span class="badge bg-danger">Tolak</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#verticalycentered{{ $bukus->id }}">
                                                <i class="bx bxs-edit-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @foreach ($buku as $show)
        <div class="modal fade" id="verticalycentered{{ $show->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{ url('Admin/buku/review/' . $show->id) }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">Vertically Centered</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-striped" style="width: 100%">
                                    <tr>
                                        <td class="text-right">Penulis</td>
                                        <td>:</td>
                                        <td>
                                            {{ $show->penulis->username }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">Judul Halaman</td>
                                        <td>:</td>
                                        <td>
                                            {{ $show->judul }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">Daftar Pustaka</td>
                                        <td>:</td>
                                        <td>
                                            {{ $show->daftarPustaka }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">Resensi</td>
                                        <td>:</td>
                                        <td>
                                            {{ $show->resensi }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">Surat Keaslian</td>
                                        <td>:</td>
                                        <td><a href="{{ Storage::url($show->suratKeaslian) }}" target="_blank">Lihat
                                                PDF</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">Cover Buku</td>
                                        <td>:</td>
                                        <td>
                                            <img src="{{ Storage::url($bukus->coverBuku) }}"
                                                class="img-fluid rounded-start" style="width: 50px; height: 50px;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">Tahun terbit</td>
                                        <td>:</td>
                                        <td>
                                            {{ $show->tahunTerbit }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">Harga</td>
                                        <td>:</td>
                                        <td>
                                            {{ $show->harga }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">NoProduk</td>
                                        <td>:</td>
                                        <td>
                                            {{ $show->noProduk }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">ISBN</td>
                                        <td>:</td>
                                        <td>
                                            {{ $show->isbn }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">Status</td>
                                        <td>:</td>
                                        <td>
                                            @if ($show->status == 'pending')
                                                <span class="badge bg-info">Pending</span>
                                            @elseif ($show->status == 'accept')
                                                <span class="badge bg-primary">Accepted</span>
                                            @elseif ($show->status == 'revisi')
                                                <span class="badge bg-warnign">Revisi</span>
                                            @elseif ($show->status == 'tolak')
                                                <span class="badge bg-danger">Tolak</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">Komentar</td>
                                        <td>:</td>
                                        <td>
                                            <textarea name="catatan" class="form-control"></textarea>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit" name="status" value="accept">Accepted</button>
                            <button class="btn btn-warning" type="submit" name="status" value="revisi">Revisi</button>
                            <button class="btn btn-danger" type="submit" name="status" value="tolak">Tolak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

< @endsection
