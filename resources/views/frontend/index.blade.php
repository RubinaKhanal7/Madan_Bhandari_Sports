@extends('frontend.layouts.master')

@section('content')
    @include('frontend.includes.coverimage')

    <section class="about-section">
        <div class="container">
            <div class="row">
                <div class="content-column col-lg-6 col-md-12 col-sm-12 order-2">
                    <div class="inner-column">
                        <div class="sec-title">
                            {{-- <span class="title">{{ __('About Life') }}</span> --}}
                            <h2 class="cat_title">{{ __($about->title) }}</h2>
                        </div>
                        <div class="text">

                            {!! Str::substr($about->content, 0, 550) !!}...
                        </div>
                        <div class="btn-box">
                            <a href="{{ route('About') }}" class="theme-btn btn-style-one">{{ __('Read More') }}<i
                                    class="fas fa-long-arrow-alt-right"></i></a>
                        </div>
                    </div>
                </div>


                <div class="image-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-column wow fadeInLeft">

                        <figure class="image-1"><a href="#" class="lightbox-image" data-fancybox="images">
                                <img title="Narayan Kaji Shrestha" src="{{ asset('uploads/about/' . $about->image) }}"
                                    alt=""></a>
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="all_tabs">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                  
                    <div class="active-tabs">
                        @foreach ($context as $key => $value)
                            <input type="radio" name="active_tabs" id="btn-{{ $key + 1 }}"
                                class="btn-{{ $key + 1 }}" {{ $loop->first ? 'checked' : '' }}>

                            <label for="btn-{{ $key + 1 }}" class="btn"><i class="fa-solid fa-file-pdf"></i>
                                {{ $value->title }}</label>
                        @endforeach

                        <div class="tabs-container">


                            @foreach ($context as $key => $value)
                                <div class="tab-{{ $key + 1 }}">
                                    @if (count($value->get_informations) > 0)
                                        @foreach ($value->get_informations as $information)
                                            <div class="row mt-3 mb-3">
                                                <div class="col-md-3 col-3">
                                                    @if (isset($information->image))
                                                        <img class="square_image" src="{{ asset($information->image) }}"
                                                            alt="Documents Image">
                                                    @else
                                                        <img class="square_image" src="{{ url('img/logo.png') }}"
                                                            alt="{{ $information->title }}">
                                                    @endif
                                                </div>
                                                <div class="col-md-6 col-8">


                                                    <p class="post_desc">
                                                        {{ $information->title }}
                                                    </p>

                                                </div>
                                                <div class="col-md-3 col-1">
                                                    <p class="font_icons">
                                                        <a class="nodecoration" target="_blank"
                                                            href="{{ asset($information->file) }}"
                                                            download>
                                                            <span class="font_down">

                                                                <i class="fas fa-download"></i>

                                                            </span>
                                                        </a>
                                                        <br><br>
                                                        <a class="nodecoration" href="{{ asset($information->file) }}"
                                                            target="_blank">
                                                        <span class="font_eye">
                                                           
                                                                <i class="fas fa-eye"></i>
                                                           
                                                        </span>
                                                    </a>
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <p class="post_desc">No files to display</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>


                <div class="col-md-4">
                    <iframe src="{{ $sitesetting->face_page }}" width="100%" height="600"
                        style="border:none; margin-left:5px;" scrolling="no" frameborder="0" allowfullscreen="true"
                        allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                </div>
            </div>
        </div>
    </section>







    {{-- For Gallery --}}

    <section class="photo-feature">
        <div class="container">


            <h1 class="cat_title">{{ __('Photo Gallery') }}</h1>



            <div class="row">

                @foreach ($images as $image)
                    <div class="col-md-6 mb-3">
                        <a href="">
                            <div class="accordion">
                                <ul>

                                    @foreach ($image->img as $imgUrl)
                                        <li tabindex="{{ $loop->iteration }}"
                                            style=" background-image: url('{{ asset($imgUrl) }}');">
                                        </li>
                                    @endforeach

                                </ul>

                            </div>
                        </a>
                    </div>
                @endforeach
            </div>



        </div>
    </section>



    {{-- For Instagram Embed --}}
    <section class="insta-embed">
        <div class="container">
            <div class="row">
                @foreach ($instas as $insta)
                    <div class="col-md-3">
                        <blockquote class="instagram-media" data-instgrm-captioned
                            data-instgrm-permalink="{{ $insta->url }}" data-instgrm-version="14"></blockquote>
                        <script async src="//www.instagram.com/embed.js"></script>
                    </div>
                @endforeach
            </div>
    </section>


    {{-- For Video section --}}


    <section class="videos_sec">
        <div class="container">


            <h1 class="cat_title">{{ __('Video Gallery') }}</h2>

                <div class="row">
                    @foreach ($videos as $vid)
                        <div class="col-md-4">
                            <div class="card video_card mt-2 mb-2">
                            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $vid->vid_url }}"
                                frameborder="0" allowfullscreen=""></iframe>
                                <div class="card-body text-center">
                   
                                    <span class="vid_desc">{{ $vid->vid_desc }}</span><br>
                                   
                                
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
    </section>



    {{-- For Contact Page --}}

{{-- 
    <section class="contact_form">
        <div class="container">
            <h1 class="cat_title">
                {{ __('Contact') }}
            </h1>
            <div class="row">
                <div class="col-md-6 cform_left">
                    <iframe src="{{ $sitesetting->google_map }}" style="border:0;"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

                <div class="col-md-6 cform_right">
                    <form id="quick_contact" class="form-horizontal" method="POST" role="form" action="">
                        @csrf
                        <div class="form-group">

                            <input type="text" class="form-control" id="name" placeholder="NAME" name="name"
                                value="" required>

                        </div>

                        <div class="form-group">

                            <input type="email" class="form-control" id="email" placeholder="EMAIL"
                                name="email" value="" required>

                        </div>

                        <div class="form-group">


                            <input type="phone" name="phone" class="form-control" id="phone"
                                placeholder="Phone No." required>


                        </div>

                        <textarea class="form-control" rows="10" placeholder="MESSAGE" name="message" required></textarea>

                        <div class="card-footer">
                            <button type="submit" class="btn-style-one">Submit</button>
                        </div>




                    </form>
                    <script>
                        function onSubmit(token) {
                            document.getElementById("quick_contact").submit();
                        }
                    </script>
                </div>
            </div>
        </div>
    </section> --}}

    @include('portal.includes.land_contact')

@endsection
