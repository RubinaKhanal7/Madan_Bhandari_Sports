<section id="hero" class="hero section dark-background">

    {{-- @foreach ($coverImages as $cover)
      <img src="{{asset('uploads/coverimage/' . $cover->image)}}" alt="" data-aos="fade-in">
    @endforeach --}} 

    <div class="row swipercontent">
    <div class="col-lg-12 col-md-12">
      <div class="portfolio-details-slider swiper init-swiper">

        <script type="application/json" class="swiper-config">
          {
            "loop": true,
            "speed": 600,
            "autoplay": {
              "delay": 5000
            },
            "slidesPerView": "auto",
            "pagination": {
              "el": ".swiper-pagination",
              "type": "bullets",
              "clickable": true
            }
          }
        </script>

        <div class="swiper-wrapper align-items-center">

        @foreach ($coverImages as $cover)
          <div class="swiper-slide">
            <img src="{{asset('uploads/coverimage/' . $cover->image)}}" alt="">
          </div>
        @endforeach
      

        </div>
        <div class="swiper-pagination"></div>
      </div>
    </div>

  </div>


    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <h2>{{ $sitesetting->slogan }}<br></h2>
      <p>I'm <span class="typed" data-typed-items="Enterprenuer, Music Composer">Music Composer</span></p>
      <div class="social-links">
        <a href="{{ $sitesetting->twitter_link }}"><i class="bi bi-twitter-x"></i></a>
        <a href="{{ $sitesetting->facebook_link }}"><i class="bi bi-facebook"></i></a>
        <a href="{{ $sitesetting->instagram_link }}"><i class="bi bi-instagram"></i></a>
        <a href="{{ $sitesetting->linkedin_link }}"><i class="bi bi-linkedin"></i></a>
        <a href="{{ $sitesetting->tiktok_link }}"><i class="bi bi-tiktok"></i></a>
        <a href="{{ $sitesetting->youtube_link }}"><i class="bi bi-youtube"></i></a>
      </div>
    </div>

  </section><!-- /Hero Section -->