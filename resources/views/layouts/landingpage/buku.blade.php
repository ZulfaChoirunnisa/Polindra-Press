<section id="buku" class="services">
    <div class="container" data-aos="fade-up">
        <header class="section-header">
            <h2>Buku Terbitan</h2>
            <p>Data Buku Yang Pernah diterbitkan</p>
        </header>
        <div class="row gy-4">
            @forelse ($buku as $bukus)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-box blue">
                        <img src="{{ Storage::url($bukus->coverBuku) }}" alt="{{ $bukus->judul }}" class="img-fluid">
                        <h3>{{ $bukus->judul }}</h3>
                        <p>{{ $bukus->penulis->nama }}</p>
                        <a href="{{ url('detailBuku/' . $bukus->id) }}" class="read-more"><span>Read More</span> <i
                                class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            @empty
                <p>Buku Belum Tersedia</p>
            @endforelse
        </div>
    </div>
</section>
