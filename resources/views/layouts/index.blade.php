<!DOCTYPE html>
<html lang="en">

@include('layouts.componen.head')

<body>

    <!-- ======= Header ======= -->
    @include('layouts.componen.header')

    <!-- ======= Sidebar ======= -->
    @include('layouts.componen.sidebar')

    <main id="main" class="main">

        @yield('main-content')

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    @include('layouts.componen.footer')

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    @include('layouts.componen.js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    @if (session('success'))
        <script type="text/javascript">
            Swal.fire({
                title: "Berhasil",
                text: "{{ session('success') }}",
                icon: "success"
            });
        </script>
    @endif
    @if (session('error'))
        <script type="text/javascript">
            Swal.fire({
                title: "{{ session('error') }}",
                icon: "error"
            });
        </script>
    @endif
    <script>
        $(document).ready(function() {
            $('#logoutButton').click(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Anda yakin ingin logout?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ url('/logout') }}";
                    }
                });
            });
        });
    </script>

</body>

</html>
