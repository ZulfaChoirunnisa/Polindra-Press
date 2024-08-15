@extends('layouts.index')
@section('main-content')
    <div class="d-flex align-items-start justify-content-between">
        <div class="pagetitle">
            <h1>Data Pengajuan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Data Pengajuan</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <div>
            <input type="search" class="form-control" placeholder="pencarian">
        </div>
    </div><!-- End Page Title -->
    <section class="section" id="content">
        <div class="row">
            @foreach ($buku as $b)
                <div class="col-lg-3 col-md-6 items">
                    <div class="card position-relative">
                        @if ($b->status == 'pending')
                            <span class="badge position-absolute bg-info">Pending</span>
                        @elseif ($b->status == 'accept')
                            <span class="badge position-absolute bg-primary">Accepted</span>
                        @elseif ($b->status == 'revisi')
                            <span class="badge position-absolute bg-warning">Revisi</span>
                        @elseif ($b->status == 'tolak')
                            <span class="badge position-absolute bg-danger">Tolak</span>
                        @endif
                        <img src="{{ Storage::url($b->coverBuku) }}" class="card-img-top" alt="{{ $b->judul }}"
                            height="200">
                        <div class="card-body">
                            <h5 class="card-title">{{ $b->judul }} ({{ $b->tahunTerbit }})</h5>
                            <div>
                                @if (auth()->user()->role == 'superadmin')
                                    @if ($b->status == 'accept')
                                        <a type="button" class="btn btn-warning btn-sm"
                                            href ="{{ route('SuperAdmin.Buku.Edit', $b->id) }}">
                                            Edit</a>
                                    @endif
                                @endif
                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#verticalycentered{{ $b->id }}">
                                    <i class="bi bi-eye"></i> Detail
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </section>

    @foreach ($buku as $show)
        <div class="modal fade" id="verticalycentered{{ $show->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <form action="{{ url('Admin/buku/review/' . $show->id) }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">Detail Ajuan</h5>
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
                                            <br>
                                            <a href="{{ route('Buku.Download', ['id' => $show->id, 'type' => 'keaslian']) }}"
                                                target="_blank"> Download Surat Keaslian</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">Draft Buku</td>
                                        <td>:</td>
                                        <td><a href="{{ Storage::url($show->draftBuku) }}" target="_blank">Lihat
                                                PDF</a>
                                            <br>
                                            <a href="{{ route('Buku.Download', ['id' => $show->id, 'type' => 'draft']) }}"
                                                target="_blank"> Download
                                                Draft</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">Cover Buku</td>
                                        <td>:</td>
                                        <td>
                                            <img src="{{ Storage::url($show->coverBuku) }}" class="img-fluid rounded-start"
                                                style="width: 50px; height: 50px;">
                                            <br>
                                            <a href="{{ route('Buku.Download', ['id' => $show->id, 'type' => 'cover']) }}"
                                                target="_blank"> Download
                                                Cover</a>
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
                                        <td class="text-right">NoProduk</td>
                                        <td>:</td>
                                        <td>
                                            @if ($show->noProduk == null)
                                                <p>belum tersedia</p>
                                            @else
                                                {{ $show->noProduk }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">ISBN</td>
                                        <td>:</td>
                                        <td>
                                            @if ($show->isbn == null)
                                                <p>belum tersedia</p>
                                            @else
                                                {{ $show->isbn }}
                                            @endif
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
                                    @if (!empty($show->isbn) && !empty($show->noProduk) && $show->publish == 'is_publish')
                                        <tr>
                                            <td class="text-right">Status Publish</td>
                                            <td>:</td>
                                            <td>
                                                <div class="badge bg-success">buku sudah di publish</div>
                                            </td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td class="text-right">Komentar</td>
                                        <td>:</td>
                                        <td>
                                            @if ($show->adminComment == null)
                                                <textarea name="catatan" class="form-control"></textarea>
                                            @else
                                                {{ $show->adminComment }}
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            @if ($show->status == 'pending')
                                <button class="btn btn-primary" type="submit" name="status"
                                    value="accept">Accepted</button>
                                <button class="btn btn-warning" type="submit" name="status" value="revisi">Revisi</button>
                                <button class="btn btn-danger" type="submit" name="status" value="tolak">Tolak</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@push('js')
    <script>
        $(function() {
            $('[placeholder="pencarian"]').on("keyup", function() {
                let value = $(this).val();
                let hideParentContent = $("#content .items");

                if (value != "") {
                    hideParentContent.each(function(index, el) {
                        $(el).addClass("d-none")

                        if (el.innerText
                            .trim()
                            .toUpperCase()
                            .includes($('input[placeholder="pencarian"]').val().toUpperCase())) {
                            $(el).removeClass("d-none");
                        } else {
                            $(el).addClass("d-none");
                        }
                    })
                } else {
                    hideParentContent.each(function(index, el) {
                        $(el).removeClass("d-none");
                    })
                }
            })
        })
    </script>
@endpush
