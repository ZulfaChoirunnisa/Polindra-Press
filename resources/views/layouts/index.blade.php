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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
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

            $("body").on("click", ".btn-delete", function(e) {
                e.preventDefault();

                let form = $(this).closest("form");

                Swal.fire({
                    title: "Apa kamu yakin?",
                    text: "Anda tidak akan dapat mengembalikan data ini!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Hapus!",
                    customClass: {
                        confirmButton: "btn btn-danger me-3",
                        cancelButton: "btn btn-label-secondary",
                    },
                    buttonsStyling: false,
                }).then(function(result) {
                    if (result.value) {
                        form.submit();
                    }
                });
            });
        });
    </script>
    <script>
        (() => {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>

</body>

</html>
