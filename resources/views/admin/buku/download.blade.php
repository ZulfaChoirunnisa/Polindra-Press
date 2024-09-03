@extends('layouts.index')
@section('main-content')
    <div class="d-flex justify-content-between align-items-start mb-3">
        <div class="pagetitle">
            <h1 class="m-0 p-0">Data Buku Siap Terbit</h1>
            <nav>
                <ol class="breadcrumb mb-0 pb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Data Buku Lolos Review</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <div class="text-center mt-3">
            <a href="{{ route('SuperAdmin.Export') }}" class="btn btn-primary"><i class="bx bxs-download"></i>
                Download</a>
        </div>
    </div>
    <section class="section">
        <div class="row">
            @foreach ($buku as $b)
                <div class="col-lg-3 col-md-6">
                    <div class="card position-relative">
                        @if ($b->status == 'pending')
                            <span class="badge position-absolute bg-info">Pending</span>
                        @elseif ($b->status == 'accept')
                            <span class="badge position-absolute bg-primary">Disetujui</span>
                        @elseif ($b->status == 'revisi')
                            <span class="badge position-absolute bg-warning">Revisi</span>
                        @elseif ($b->status == 'tolak')
                            <span class="badge position-absolute bg-danger">Tolak</span>
                        @endif
                        <img src="{{ Storage::url($b->coverBuku) }}" class="card-img-top" alt="{{ $b->judul }}"
                            height="200">
                        <div class="card-body">
                            <h5 class="card-title">{{ Str::limit($b->judul, 25) }} ({{ $b->tahunTerbit }})</h5>
                            <div>
                                @if (!empty($b->isbn) && !empty($b->noProduk))
                                    @if ($b->publish == 'is_publish')
                                        <div class="badge bg-success">buku sudah di publish</div>
                                    @else
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#verticalycentered{{ $b->id }}">Terbitkan
                                            <i class="bbi bi-box-arrow-up"></i>
                                        </button>
                                    @endif
                                @else
                                    @if (auth()->user()->role == 'admin')
                                        <a type="button" class="btn btn-warning btn-sm"
                                            href ="{{ route('Admin.Buku.Edit', $b->id) }}">
                                            Edit
                                        </a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
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
                                            {{ limit_sentences($show->daftarPustaka, 20) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">Resensi</td>
                                        <td>:</td>
                                        <td>
                                            {{ limit_sentences($show->resensi, 10) }}
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
                                            <img src="{{ Storage::url($show->coverBuku) }}" class="img-fluid rounded-start"
                                                style="width: 50px; height: 50px;">
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
