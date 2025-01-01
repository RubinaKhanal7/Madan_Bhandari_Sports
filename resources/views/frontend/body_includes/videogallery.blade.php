 
    <!-- Portfolio Section -->
    <section id="Video" class="portfolio section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
          <h2>Video Gallery</h2>
          <p>Watch highlights of my musical performances and compositions captured on video.</p>
        </div><!-- End Section Title -->
  
        <div class="container">
          <div class="row">

            @foreach ($videos as $video)
              
         
            <div class="col-lg-4 col-md-4 col-sm-12">
              <iframe width="100%" height="315" src="{{ $video->url }}" title="{{ $video->title }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
  
            </div>
            @endforeach
          
        
          </div>
        
          </div>
  
        </div>
  
      </section><!-- /Portfolio Section -->