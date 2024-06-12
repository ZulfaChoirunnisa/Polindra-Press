<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        @if (Auth::user()->role == 'admin')
            <li class="nav-item">
                <a class="nav-link {{ request()->is('home') ? '' : 'collapsed' }}" href="{{ route('home') }}">
                    <i class="ri-dashboard-line"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('Admin/buku') ? '' : 'collapsed' }}"
                    href="{{ route('Admin.Buku.Index') }}">
                    <i class="ri-mail-send-line"></i>
                    <span>Pengajuan</span>
                </a>
            </li><!-- End Dashboard Nav -->
            <li class="nav-item">
                <a class="nav-link {{ Request::segment(3) == 'download' ? 'collapsed' : '' }}"
                    href="{{ route('Admin.Buku.Download') }}">
                    <i class="ri-download-2-fill"></i>
                    <span>Download</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('Admin/buku') ? '' : 'collapsed' }}"
                    href="{{ route('Admin.Buku.Profileadmin') }}">
                    <i class="bi bi-person-fill"></i>
                    <span>Profile</span>
                </a>
            </li>

            <!-- End Tables Nav -->
        @elseif(Auth::user()->pengaju)
            <li class="nav-item">
                <a class="nav-link {{ request()->is('home') ? '' : 'collapsed' }}" href="{{ route('home') }}">
                    <i class="ri-dashboard-line"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('pengaju/buku') ? '' : 'collapsed' }}"
                    href="{{ route('Pengaju.Buku.Create') }}">
                    <i class="bi bi-clipboard2-data"></i>
                    <span>Form Pengajuan</span>
                </a>
            </li><!-- End Dashboard Nav -->
            <li class="nav-item ">
                <a class="nav-link {{ request()->is('pengaju/buku') ? '' : 'collapsed' }}"
                    href="{{ route('Pengaju.Buku.hasilreview') }}">
                    <i class="bi bi-clipboard2-check"></i>
                    <span>Hasil Review</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('pengaju/buku') ? '' : 'collapsed' }}"
                    href="{{ route('Pengaju.Buku.Profile') }}">
                    <i class="bi bi-person-fill"></i>
                    <span>Profile</span>
                </a>
            </li>
            <!-- End Dashboard Nav -->
        @endif

    </ul>

</aside><!-- End Sidebar-->
