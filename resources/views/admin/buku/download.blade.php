@extends('layouts.index')
@section('main-content')
    <div class="pagetitle">
        <h1>Data Buku Siap Terbit</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Data Buku Lolos Review</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card overflow-auto">
                    <div class="card-body">
                        <h5 class="card-title">Data tables</h5>
                        <p>Berikut adalah tabel data buku yang sudah lolos review.</p>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                <th>No</th>
                                    <th>
                                        <b>J</b>udul
                                    </th>
                                    <th>Jumlah Halman</th>
                                    <th>Daftar Pustaka</th>
                                    <th>Resensi</th>
                                    <th>Surat Keaslian</th>
                                    <th>Draft Buku</th>
                                    <th>Cover Buku</th>
                                    <th>Tahun Terbit</th>
                                    <th>ISBN</th>
                                    <th>Status</th>
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
                                        <td><a href="{{ Storage::url($bukus->draftBuku) }}" target="_blank">Lihat
                                                PDF</a>
                                        </td>
                                        <td><img src="{{ Storage::url($bukus->coverBuku) }}" class="rounded-circle"
                                                style="width: 50px; height: 50px;"></td>
                                        <th>{{ $bukus->tahunTerbit }}</th>
                                        <td>{{ $bukus->isbn }}</td>
                                        <td>{{ $bukus->status }}</td>
                                        <td>
                                        <td>
                                        @if (!empty($bukus->isbn) && !empty($bukus->noProduk))
                                                @if ($bukus->publish == 'is_publish')
                                                    <p>buku sudah di publish</p>
                                                @else
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#verticalycentered{{ $bukus->id }}">Terbitkan
                                                        <i class="bbi bi-box-arrow-up"></i>
                                                    </button>
                                                @endif
                                            @else
                                                <a type="button" class="btn btn-warning"
                                                    href ="{{ route('Admin.Buku.Edit', $bukus->id) }}"><i
                                                        class="bx bxs-edit-alt"></i></a>
                                        @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <a href="{{ route('export.users') }}" class="btn btn-primary"><i class="bx bxs-download"></i>
                        Download</a>
                </div>
            </div>
        </div>
    </section>

    @foreach ($buku as $show)
        <div class="modal fade" id="verticalycentered{{ $show->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{ url('Admin/Buku/Publish/' . $show->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title">Detail Buku</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-striped" style="width: 100%">
                                    <tr>
                                        <td class="text-right">Penulis</td>
                                        <td>:</td>
                                        <td>
                                            {{ $show->penulis->nama }}
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
                                            {{limit_sentences($show->daftarPustaka, 20)}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">Resensi</td>
                                        <td>:</td>
                                        <td>
                                            {{limit_sentences ($show->resensi, 10) }}
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
                                        <td class="text-right">Draft Buku</td>
                                        <td>:</td>
                                        <td><a href="{{ Storage::url($show->draftBuku) }}" target="_blank">Lihat
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
                                                <span class="badge bg-primary">Terima</span>
                                            @elseif ($show->status == 'revisi')
                                                <span class="badge bg-warnign">Revisi</span>
                                            @elseif ($show->status == 'tolak')
                                                <span class="badge bg-danger">Tolak</span>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary" type="submit" name="publish"
                                value="is_publish">Publish</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
