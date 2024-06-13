<!DOCTYPE html>
<html lang="en">

@include('layouts.landingpage.head')

<body>

  <!-- ======= Header ======= -->
  @include('layouts.landingpage.header')

  @include('layouts.landingpage.hero')

  <main id="main">
    <!-- ======= About Section ======= -->
    @include('layouts.landingpage.about')

    <!-- ======= Services Section ======= -->
    @include('layouts.landingpage.buku')


  </main><!-- End #main -->

 @include('layouts.landingpage.footer')

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  @include('layouts.landingpage.js')

</body>

</html>
