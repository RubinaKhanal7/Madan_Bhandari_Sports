{{-- For Breaking News --}}

<section class="quick_news">

    <div class="container">



        <div class="news_slider">
            
            <button class="qn_button">
                ताजा अपडेट
            </button>
            {{-- <span class="sliding_image"> --}}

                <div class="news_track">
                    @foreach($notices as $notice)
                    <div class="news_slide">
                        <a href="">

                            <p class=""><i class="fa-solid fa-file-pdf"></i> {{ $notice->title }}</p>
                        </a>
                    </div>
                    @endforeach
                </div>
                
        </div>

    </div>

</section>
