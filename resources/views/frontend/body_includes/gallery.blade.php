   <!-- Pricing Section -->
   <section id="gallery" class="pricing section">

       <!-- Section Title -->
       <div class="container section-title" data-aos="fade-up">
           <h2>Gallery</h2>
           <p>A collection of moments that showcase my journey in music, from performances to creative milestones.</p>
       </div><!-- End Section Title -->
       <div class="container">
           <div class="gallery-image row">


            @foreach ($images as $image)
          
            <div class="col-md-4">
                <div class="img-box">
                <a class="text-decoration-none" style="color: inherit" href="{{ route('singleImage', $image->slug) }}">
                    @if(is_array($image->img) && count($image->img) > 0)
                        <!-- Display only the first image -->
                        <img src="{{ asset($image->img[0]) }}" alt="" />
                    @endif
                
                    <div class="transparent-box">
                        <div class="caption">
                            <p>{{ $image->title }}</p>
                            <p class="opacity-low">{{ Str::limit($image->img_desc, 100) }}</p>
                        </div>
                    </div>
                </a>
                </div>
            </div>
        
        @endforeach
        

           </div>





       </div>



   </section>


   <style>
       .gallery-image {
           padding: 20px;
           display: flex;
           flex-wrap: wrap;
           justify-content: center;
       }

       .gallery-image img {
           height: 250px;
           width: 100%;
           transform: scale(1.0);
           transition: transform 0.4s ease;
       }

       .img-box {
           box-sizing: content-box;
           margin: 10px;
           height: 250px;
           width: 100%;
           overflow: hidden;
           display: inline-block;
           color: white;
           position: relative;
           background-color: white;
       }

       .caption {
           position: absolute;
           bottom: 5px;
           left: 20px;
           opacity: 0.0;
           transition: transform 0.3s ease, opacity 0.3s ease;
       }

       .transparent-box {
           height: 250px;
           width: 100%;
           background-color: rgba(0, 0, 0, 0);
           position: absolute;
           top: 0;
           left: 0;
           transition: background-color 0.3s ease;
       }

       .img-box:hover img {
           transform: scale(1.1);
       }

       .img-box:hover .transparent-box {
           background-color: rgba(0, 0, 0, 0.5);
       }

       .img-box:hover .caption {
           transform: translateY(-20px);
           opacity: 1.0;
       }

       .img-box:hover {
           cursor: pointer;
       }

       .caption>p:nth-child(2) {
           font-size: 0.8em;
       }

       .opacity-low {
           opacity: 0.5;
       }
   </style>
