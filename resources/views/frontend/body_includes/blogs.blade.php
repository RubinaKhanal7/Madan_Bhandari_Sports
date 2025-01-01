   <!-- Pricing Section -->
   <section id="pricing" class="pricing section">

       <!-- Section Title -->
       <div class="container section-title" data-aos="fade-up">
           <h2>Blogs</h2>
           <p>Stay tuned for new blog posts that dive deep into my journey, inspirations, and everything in between.</p>
       </div><!-- End Section Title -->
       <div class="container">
           <div class="row gy-4">


               @foreach ($blogs as $blog)
                   <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="{{ $loop->iteration }}00">
                       <a class="text-decoration-none" style="color: inherit"
                           href="{{ route('SingleBlogpostcategory', $blog->slug) }}">
                           <div class='normal'>
                               <!-- <p class='demo-title'>Normal</p> -->
                               <div class='module'>
                                   <div class='thumbnail'>
                                       <img src="{{ asset('uploads/blogpostcategory/' . $blog->image) }}">
                                       {{-- <div class='date'>
                <div>27</div>
                <div>Mar</div>
              </div> --}}
                                       <div class='date'>
                                           <div>{{ $blog->created_at->format('d') }}</div>
                                           <div>{{ $blog->created_at->format('M') }}</div>
                                       </div>
                                   </div>
                                   <div class='content'>
                                       {{-- <div class="category">News</div> --}}
                                       <h1 class='title'>{{ $blog->title }}</h1>
                                       <h2 class='sub-title'>{{ strtok(strip_tags($blog->content), '.') }}.</h2>
                                       <div class="description">{{ Str::limit(strip_tags($blog->content), 400) }}</div>
                                       <!-- <div class="meta">
                <span class="timestamp">
                  <i class='fa fa-clock-o'></i> 6 mins ago
                </span>
                <span class="comments">
                  <i class='fa fa-comments'></i>
                  <a href="#"> 39 comments</a>
                </span>
              </div> -->
                                   </div>
                               </div>
                           </div>
                       </a>
                   </div>
               @endforeach



           </div>
       </div>

       <!-- <div class="container">

      <div class="row gy-4">

        <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="100">
          
          
          <div class="pricing-item">
            <h3>Free Plan</h3>
            <p class="description">Ullam mollitia quasi nobis soluta in voluptatum et sint palora dex strater</p>
            <h4><sup>$</sup>0<span> / month</span></h4>
            <a href="#" class="cta-btn">Start a free trial</a>
            <p class="text-center small">No credit card required</p>
            <ul>
              <li><i class="bi bi-check"></i> <span>Quam adipiscing vitae proin</span></li>
              <li><i class="bi bi-check"></i> <span>Nec feugiat nisl pretium</span></li>
              <li><i class="bi bi-check"></i> <span>Nulla at volutpat diam uteera</span></li>
              <li class="na"><i class="bi bi-x"></i> <span>Pharetra massa massa ultricies</span></li>
              <li class="na"><i class="bi bi-x"></i> <span>Massa ultricies mi quis hendrerit</span></li>
              <li class="na"><i class="bi bi-x"></i> <span>Voluptate id voluptas qui sed aperiam rerum</span></li>
              <li class="na"><i class="bi bi-x"></i> <span>Iure nihil dolores recusandae odit voluptatibus</span></li>
            </ul>
          </div>
        </div>

        <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="200">
          <div class="pricing-item featured">
            <p class="popular">Popular</p>
            <h3>Business Plan</h3>
            <p class="description">Ullam mollitia quasi nobis soluta in voluptatum et sint palora dex strater</p>
            <h4><sup>$</sup>29<span> / month</span></h4>
            <a href="#" class="cta-btn">Start a free trial</a>
            <p class="text-center small">No credit card required</p>
            <ul>
              <li><i class="bi bi-check"></i> <span>Quam adipiscing vitae proin</span></li>
              <li><i class="bi bi-check"></i> <span>Nec feugiat nisl pretium</span></li>
              <li><i class="bi bi-check"></i> <span>Nulla at volutpat diam uteera</span></li>
              <li><i class="bi bi-check"></i> <span>Pharetra massa massa ultricies</span></li>
              <li><i class="bi bi-check"></i> <span>Massa ultricies mi quis hendrerit</span></li>
              <li><i class="bi bi-check"></i> <span>Voluptate id voluptas qui sed aperiam rerum</span></li>
              <li class="na"><i class="bi bi-x"></i> <span>Iure nihil dolores recusandae odit voluptatibus</span></li>
            </ul>
          </div>
        </div>

        <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="300">
          <div class="pricing-item">
            <h3>Developer Plan</h3>
            <p class="description">Ullam mollitia quasi nobis soluta in voluptatum et sint palora dex strater</p>
            <h4><sup>$</sup>49<span> / month</span></h4>
            <a href="#" class="cta-btn">Start a free trial</a>
            <p class="text-center small">No credit card required</p>
            <ul>
              <li><i class="bi bi-check"></i> <span>Quam adipiscing vitae proin</span></li>
              <li><i class="bi bi-check"></i> <span>Nec feugiat nisl pretium</span></li>
              <li><i class="bi bi-check"></i> <span>Nulla at volutpat diam uteera</span></li>
              <li><i class="bi bi-check"></i> <span>Pharetra massa massa ultricies</span></li>
              <li><i class="bi bi-check"></i> <span>Massa ultricies mi quis hendrerit</span></li>
              <li><i class="bi bi-check"></i> <span>Voluptate id voluptas qui sed aperiam rerum</span></li>
              <li><i class="bi bi-check"></i> <span>Iure nihil dolores recusandae odit voluptatibus</span></li>
            </ul>
          </div>
        </div>

      </div>

    </div> -->

   </section><!-- /Pricing Section -->
