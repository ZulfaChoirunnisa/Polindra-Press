<?php
$bukus = App\Models\Buku::where('status', 'pending')->orderBy('id', 'desc')->limit(5)->get();
?>

<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center">
            <img src="{{ url('assets/admin/img/POLINDRA.png') }}" alt="">
            <span class="d-none d-lg-block">PolindraPress</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
        <form class="search-form d-flex align-items-center" method="POST" action="#">
            <input type="text" name="query" placeholder="Search" title="Enter search keyword">
            <button type="submit" title="Search"><i class="bi bi-search"></i></button>
        </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li><!-- End Search Icon-->

            @if (in_array(auth()->user()->role, ['superadmin', 'admin']))
                <li class="nav-item dropdown">
                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-bell"></i>
                        <span class="badge bg-primary badge-number">{{ $bukus->count() }}</span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications" style="">
                        <li class="dropdown-header">
                            You have {{ $bukus->count() }} new notifications
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        @foreach ($bukus as $buku)
                            <li class="notification-item">
                                <i class="bi bi-exclamation-circle text-warning"></i>
                                <div>
                                    <h4>{{ $buku->judul }}</h4>
                                    <p>{{ $buku->created_at->diffForHumans() }}</p>
                                </div>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>
                        @endforeach

                    </ul><!-- End Notification Dropdown Items -->

                </li>
            @endif

            <li class="nav-item dropdown pe-3">

                @php
                    if (auth()->user()->role == 'admin') {
                        $name = Auth::user()->admin->name;
                    } elseif (auth()->user()->role == 'pengaju') {
                        $name = Auth::user()->pengaju->name;
                    } else {
                        $name = Auth::user()->sa->name;
                    }
                @endphp
                @php
                    if (auth()->user()->role == 'admin') {
                        $route = route('Admin.Buku.Profileadmin');
                    } elseif (auth()->user()->role == 'pengaju') {
                        $route = route('Pengaju.Buku.Profile');
                    } else {
                        $route = route('Admin.Buku.Profileadmin');
                    }
                @endphp

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    @php
                        $user = auth()->user();
                        $job = $user->role;
                        $foto = null;

                        switch ($job) {
                            case 'admin':
                                $foto = $user->admin->foto;
                                break;
                            case 'pengaju':
                                $foto = $user->pengaju->foto;
                                break;

                            default:
                                $foto = $user->sa->foto;
                                break;
                        }

                        $initial = $name[0];
                    @endphp

                    @if ($foto)
                        <img src="{{ asset('storage/' . $foto) }}" class="img-profile rounded-circle">
                    @else
                        <img src="{{ asset('images/preview.png') }}" class="rounded-circle" style="max-width: 100%;" />
                    @endif
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{ $name }}</span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    @if ($profileData)
                        <li class="dropdown-header">
                            <h6>{{ $profileData->name }}</h6>
                            <span>{{ $profileData->job }}</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                    @endif

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="Pengaju.Buku.Profile">
                            <i class="bi bi-person"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                            <i class="bi bi-gear"></i>
                            <span>Account Settings</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                            <i class="bi bi-question-circle"></i>
                            <span>Need Help?</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Sign Out</span>
                        </a>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->
