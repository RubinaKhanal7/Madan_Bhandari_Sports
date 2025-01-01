<section id="about" class="about section">

    <!-- Section Title -->
    {{-- <div class="container section-title" data-aos="fade-up">
      <h2>About</h2>

    </div> --}}

    <div class="container" data-aos="fade-up" data-aos-delay="100">

      <div class="row gy-4 justify-content-between">
        <div class="col-lg-4 profile-img align-self-start">
          <img src="{{ asset('uploads/about/'. $about->image) }}" class="img-fluid" alt="">
        </div>
        <div class="col-lg-7 content">
          <h3>{{ $about->title }}</h3>
          <p>
            {{ Str::substr($about->description, 0, 750) }}...            
          </p>
          {{-- <ul>
            <li><i class="bi bi-check2-all"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></li>
            <li><i class="bi bi-check2-all"></i> <span>Duis aute irure dolor in reprehenderit in voluptate velit.</span></li>
            <li><i class="bi bi-check2-all"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</span></li>
          </ul> --}}
          <a class="text-decoration-none" href="{{ route('About') }}">Read More <i class="bi bi-arrow-right"></i></a>
        </div>
      </div>

    </div>

  </section><!-- /About Section -->