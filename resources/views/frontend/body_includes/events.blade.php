<!-- Portfolio Section -->
<section id="portfolio" class="portfolio section">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
      <h2>News & Events</h2>
      <p>Stay updated with the latest news, upcoming performances, and events in my musical journey.</p>
  </div><!-- End Section Title -->

  <div class="container">

    <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

        <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
            <li data-filter="*" class="filter-active">All</li>
            @foreach($types as $type)
                <li data-filter=".filter-{{ Str::slug($type) }}">{{ $type }}</li>
            @endforeach
        </ul><!-- End Portfolio Filters -->
    
        <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
            <!-- Dynamically Show News based on Type -->
            @foreach($allNews as $news)
                <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-{{ Str::slug($news->type) }}">
                    <div class="portfolio-content h-100">
                        <img src="{{ asset('uploads/newsandevents/'.$news->image) }}" class="img-fluid" alt="{{ $news->title }}">
                        <div class="portfolio-info">
                            <h4>{{ $news->title }}</h4>
                            <p>{{ Str::limit(strip_tags($news->content), 150) }}</p>
                            <a href="{{ asset('uploads/newsandevents/'.$news->image) }}" title="{{ $news->title }}" data-gallery="portfolio-gallery" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                            <a href="{{ route('SingleNewsandEvents' , $news->slug) }}" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div><!-- End Portfolio Container -->
    
    </div>
    

  </div>

</section><!-- /Portfolio Section -->
