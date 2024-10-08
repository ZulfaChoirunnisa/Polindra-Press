@extends('layouts.index')
@section('main-content')
    <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Users</li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <img src="{{ asset('storage/' . $admin->foto) }}" alt="Profile" class="rounded-circle">
                        <h2>{{ $admin->name }}</h2>
                        <h3>Petugas Polindra Press</h3>
                        <div class="social-links mt-2">
                            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab"
                                    data-bs-target="#profile-overview">Lihat Profile</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                    Profile</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab"
                                    data-bs-target="#profile-change-password">Ubah Password</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">
                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">About</h5>
                                <p class="small fst-italic">Berikut adalah Profile anda</p>
                                <h5 class="card-title">Detail Profile</h5>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Nama</div>
                                    <div class="col-lg-9 col-md-8">
                                        @if (!empty($admin->name))
                                            {{ $admin->name }}
                                        @else
                                            <p>Data belum diisi</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Pekerjaan</div>
                                    <div class="col-lg-9 col-md-8">
                                        @if (!empty($admin->job))
                                            {{ $admin->job }}
                                        @else
                                            <p>Data belum diisi</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Alamat</div>
                                    <div class="col-lg-9 col-md-8">
                                        @if (!empty($admin->alamat))
                                            {{ $admin->alamat }}
                                        @else
                                            <p>Data belum diisi</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Nomer Telepon</div>
                                    <div class="col-lg-9 col-md-8">
                                        @if (!empty($admin->notlp))
                                            {{ $admin->notlp }}
                                        @else
                                            <p>Data belum diisi</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8">
                                        @if (!empty($admin->user->email))
                                            {{ $admin->user->email }}
                                        @else
                                            <p>Data belum diisi</p>
                                        @endif
                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                <!-- Profile Edit Form -->
                                <form action="{{ route('Admin.profileadmin.update') }}" enctype="multipart/form-data"
                                    method="POST" mul>
                                    @csrf
                                    @method('PUT')
                                    <div class="row mb-3">
                                        <label for="simpanProfile" class="col-md-4 col-lg-3 col-form-label">Foto
                                            Profile</label>
                                        <div class="col-md-8 col-lg-9">

                                            <div class="pt-2">
                                                <input type="file" name="foto" id="foto">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="name" class="col-md-4 col-lg-3 col-form-label">Nama</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="name" type="text" class="form-control" id="name"
                                                value="{{ $admin->name }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="job" class="col-md-4 col-lg-3 col-form-label">Pekerjaan</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="job" type="text" class="form-control" id="job"
                                                value="{{ $admin->job }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="alamat" class="col-md-4 col-lg-3 col-form-label">Alamat</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="alamat" type="text" class="form-control" id="alamat"
                                                value="{{ $admin->alamat }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="notlp" class="col-md-4 col-lg-3 col-form-label">Nomer Telepon</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="notlp" type="text" class="form-control" id="notlp"
                                                value="{{ $admin->notlp }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="notlp" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="notlp" type="text" class="form-control" id="notlp"
                                                value="{{ $admin->user->email }}">
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">simpan</button>
                                    </div>
                                </form><!-- End Profile Edit Form -->
                            </div>
                            <div class="tab-pane fade pt-3" id="profile-change-password">
                                <!-- Change Password Form -->
                                <form action="{{ route('Admin.profileadmin.reset') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mb-3">
                                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Password
                                            Sebelumnya</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="current_password" type="password" class="form-control"
                                                id="currentPassword">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Password
                                            Baru</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="new_password" type="password" class="form-control"
                                                id="newPassword">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Konfirmasi Password
                                            Baru</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="password_confirmation" type="password" class="form-control"
                                                id="renewPassword">
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Ganti Password</button>
                                    </div>
                                </form><!-- End Change Password Form -->

                            </div>

                            </d><!-- End Bordered Tabs -->

                        </div>
                    </div>

                </div>
            </div>
    </section>

    </main><!-- End #main -->
@endsection
