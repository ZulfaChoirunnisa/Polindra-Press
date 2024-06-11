
<section id="buku" class="services">

<div class="container" data-aos="fade-up">

  <header class="section-header">
    <h2>Buku Terbitan</h2>
    <p>Data Buku Yang Pernah diterbitkan</p>
  </header>

  <div class="row gy-4">
  @foreach (buku() as $buku )
  <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
      <div class="service-box blue">
        <i class="ri-discuss-line icon"></i>
        <img src="{{ asset('storage/app/public/uploads/cover' . $buku->coverbuku) }}" alt="{{ $buku->judul }}" class="img-fluid">
        <h3>{{ $buku->judul }}</h3>
        <p>{{ $buku->penulis }}</p>
        <a href="#" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
      </div>
    </div>
  @endforeach
  
  </div>

</div>

</section>
