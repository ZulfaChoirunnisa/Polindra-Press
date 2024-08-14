@extends('layouts.index')
@section('main-content')
    <div class="pagetitle">
        <h1>Data Admin</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Data Admin</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card overflow-auto">
                    <div class="card-header d-flex align-items-start justify-content-between">
                        <span>
                            <h5 class="card-title m-0 p-0">Data tables</h5>
                            <p>Berikut adalah tabel data pengguna admin.</p>
                        </span>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAdmin">
                            <i class="bi bi-plus"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengaju as $p)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $p->name }}</td>
                                        <td>{{ $p->user->username }}</td>
                                        <td>{{ $p->user->email }}</td>
                                        <td>
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#verticalycentered{{ $p->id }}">
                                                <i class="bx bxs-edit-alt text-white"></i>
                                            </button>
                                            <form action="{{ route('SuperAdmin.Account.Pengaju.Delete', $p->user->id) }}"
                                                method="post" class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-danger btn-delete">
                                                    <i class="bx bxs-trash-alt"></i>
                                                </button>
                                            </form>
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

    <div class="modal fade" id="addAdmin" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Admin Baru</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('SuperAdmin.Account.Pengaju.Store') }}" enctype="multipart/form-data" method="POST"
                    novalidate class="needs-validation">
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-lg-3 col-form-label">Nama</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="name" type="text" class="form-control" id="name" required
                                    value="{{ old('name') }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="email" type="email" class="form-control" id="email" required
                                    value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="username" class="col-md-4 col-lg-3 col-form-label">Username</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="username" type="text" class="form-control" id="username" required
                                    value="{{ old('username') }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-lg-3 col-form-label">Kata Sandi</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="password" type="text" class="form-control" id="password" required
                                    value="{{ old('password') }}">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="text-center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @foreach ($pengaju as $p)
        <div class="modal fade" id="verticalycentered{{ $p->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Admin</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('SuperAdmin.Account.Pengaju.Update', $p->user->id) }}"
                        enctype="multipart/form-data" method="POST" novalidate class="needs-validation">
                        @csrf
                        @method('put')
                        <div class="modal-body">
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-lg-3 col-form-label">Nama</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="name" type="text" class="form-control" id="name" required
                                        value="{{ old('name', $p->name) }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="email" type="email" class="form-control" id="email" required
                                        value="{{ old('email', $p->user->email) }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="username" class="col-md-4 col-lg-3 col-form-label">Username</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="username" type="text" class="form-control" id="username" required
                                        value="{{ old('username', $p->user->username) }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-lg-3 col-form-label">Kata Sandi</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="password" type="text" class="form-control" id="password"
                                        value="{{ old('password') }}">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="text-center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
