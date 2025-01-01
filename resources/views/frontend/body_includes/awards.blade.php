   <!-- Awards and Achievements Section -->
   <section id="services" class="services section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Awards & Achievements</h2>
      <p>Honored with multiple awards for my passion and excellence in music composition and performance.</p>
    </div>
    <!-- End Section Title -->

    <div class="container">

      <div class="row gy-4">


        @foreach ($services as $service)
          
      
        <div class="col-lg-4 col-md-6 service-item d-flex" data-aos="fade-up" data-aos-delay="{{ $loop->iteration }}00">
          <div class="icon flex-shrink-0">
            <img src="{{asset('uploads/service/'. $service->image)}}" alt="Image" style="width: 200px; height: 300px; object-fit: cover; object-position: center;">
            <!--    <i class="bi bi-briefcase"></i> -->
          </div>
          <div>
            <h4 class="title">{{ $service->title }}</h4>
            <p class="description"> {{ Str::limit(strip_tags($service->description), 200) }}
            </p>
            <a href="{{ route('SingleService', $service->slug) }}" class="readmore stretched-link"><span>Learn More</span><i class="bi bi-arrow-right"></i></a>
          </div>
        </div>

        @endforeach

     

      </div>

    </div>

  </section>
  <!-- /Awards and Achievements Section -->