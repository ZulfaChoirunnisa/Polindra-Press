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

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  @include('layouts.componen.js')

</body>

</html>