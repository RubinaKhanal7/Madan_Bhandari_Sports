@extends('frontend.layouts.master')

@section('content')
    {{-- <section class="banner">
        <div class="container-fluid">
            <div class="row g-4 align-items-center">
                <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">

                        @foreach ($coverImages as $key => $coverImage)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}" data-bs-interval="8000">
                                <img src="{{ asset('uploads/coverimage/' . $coverImage->image) }}"
                                    class="d-block banners-imgs" width="100%" height="550px" alt="Cover Image" />
                                <div class="carousel-caption d-md-block">
                                    <h1 class="herosectiontitle">
                                        {{ $coverImage->title }}
                                    </h1>
                                    <a href="{{ route('About') }}"><button class="btn">READ MORE</button></a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </section> --}}


{{-- 
    <section class="about-us container-fluid">
        <div class="container">
            <div class="content">
                <div class="right-box col-12 text-center">
                    <h2 class="section_title">{{ $about->title ?? 'Default Title' }}</h2>
                    <p class="text-center">{{ $about->description ?? 'Default Description' }}

                    </p>
                   
                    <a href="{{ route('About') }}" class="btn">Read More<i class="fa-solid fa-arrow-right mx-2"></i></a>

                
                </div>
            </div>
        </div>
    </section>



    <section class="py-4">
        <div class="container ">
            <h2 class=" section_title dup_section_title">Our Objectives</h2>
            <div class="row">

                <div class="col-md-5 col-lg-5">
                    <img src="{{ asset('image/objective.gif') }}" alt="objective image" class="img-fluid overlay-img">
                </div>

                <div class="col-md-7 col-lg-7 objectivecontent">

                    @foreach ($services as $service)
                        <div class="objectivecontent-cnt">

                            <h5 class="obj-title"> <i class="fa-solid fa-hand-point-right px-1"></i> {{ $service->title }}
                            </h5>
                        </div>
                    @endforeach
                    <a href="{{ route('About') }}" class="btn">Read More<i class="fa-solid fa-arrow-right mx-2"></i></a>


                </div>

            </div>


    </section>


    <section class="team-members py-2">
        <div class="container">
            <h2 class="text-center section_title">Executive Team</h2>

            @if ($executiveTeam->isNotEmpty())
                <section class="multi_post">

                    <div class="multi_poster row justify-content-center gap-row-5 gap-5 forpadding">
                        @foreach ($executiveTeam as $member)
                            <div class="teamcard col-md-3">
                                <a href="{{ route('Team', ['type' => 'executive']) }}">
                                    <div class="multi_post_image">
                                        @if ($member->image)
                                            <img src="{{ asset('uploads/team/' . $member->image) }}" class="card-img-top"
                                                alt="{{ $member->name }}">
                                        @else
                                            <img src="https://via.placeholder.com/500" class="card-img-top"
                                                alt="Team Member Image">
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $member->name }}</h5>
                                        <p class="card-text"><b>{{ $member->position }}</b>

                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>

                </section>
            @else
                <p class="alert alert-warning">No Executive Team members found.</p>
            @endif


            @if ($advisoryTeam->isNotEmpty())
                <h2 class="text-center section_title pb-3 my-2">Advisory Team</h2>
                <section class="multi_post">
                    <div class="container">
                        <div class="multi_poster row justify-content-center row-gap-5 gap-5 forpadding">
                            @foreach ($advisoryTeam as $member)
                                <div class="teamcard col-md-3">
                                    <a href="{{ route('Team', ['type' => 'advisory']) }}">
                                        <div class="multi_post_image">
                                            @if ($member->image)
                                                <img src="{{ asset('uploads/team/' . $member->image) }}"
                                                    class="card-img-top" alt="{{ $member->name }}">
                                            @else
                                                <img src="https://via.placeholder.com/500" class="card-img-top"
                                                    alt="Team Member Image">
                                            @endif
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $member->name }}</h5>
                                            <p class="card-text"><b>{{ $member->position }}</b>

                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            @else
                <p class="alert alert-warning">No Advisory Team members found.</p>
            @endif

            @if ($otherTeam->isNotEmpty())
                <h2 class="text-center section_title pb-3">Other Members</h2>
                <section class="multi_post">
                    <div class="container">
                        <div class="multi_poster row justify-content-center row-gap-5 gap-5 forpadding">
                            @foreach ($otherTeam as $member)
                                <div class="teamcard col-md-3">
                                    <a href="{{ route('Team', ['type' => 'others']) }}">
                                        <div class="multi_post_image">
                                            @if ($member->image)
                                                <img src="{{ asset('uploads/team/' . $member->image) }}"
                                                    class="card-img-top" alt="{{ $member->name }}">
                                            @else
                                                <img src="https://via.placeholder.com/500" class="card-img-top"
                                                    alt="Team Member Image">
                                            @endif
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $member->name }}</h5>
                                            <p class="card-text">{{ $member->position }}</p>

                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            @else
            @endif
        </div>
    </section>

    <style>
        .teamcard {
            background: white;
            box-shadow: 0 4px 21px -12px rgba(0, 0, 0, .66);
            transition: box-shadow 0.2s ease, transform 0.2s ease;
            padding: 20px 20px;

        }

        .forpadding .card-body {
            padding-top: 12px;

        }
    </style>


    
    @if ($newsEvents->isNotEmpty())
        <section class="multi_post">
            <div class="container">
                <h2 class="text-center section_title pb-3">News And Events</h2>
                <div class="multi_poster row justify-content-center row-gap-5 gap-5">
                    @foreach ($newsEvents as $newsEvent)
                        <div class="card col-lg-3">
                            <a href="{{ route('SingleNewsandEvents', ['slug' => $newsEvent->slug]) }}">
                                <div class="multi_post_image">
                                    @if ($newsEvent->image)
                                        <img src="{{ asset('uploads/newsandevents/' . $newsEvent->image) }}"
                                            class="card-img-top" alt="News and Event Image">
                                    @else
                                        <img src="https://via.placeholder.com/500" class="card-img-top"
                                            alt="News and Event Image">
                                    @endif
                                </div>

                                <div class="card-body">
                                    <h4 class="card-title">{{ Str::limit($newsEvent->title, 150) }}</h4>

                                    <p class="card-text pb-4">
                                        {{ Str::limit(strip_tags($newsEvent->content), 100) }}
                                    </p>
                                    <a href="{{ route('SingleNewsandEvents', ['slug' => $newsEvent->slug]) }}">
                                        <button class="btn text-white">{{ trans('ReadMore') }} &nbsp;&nbsp;<i
                                                class="fa-solid fa-arrow-right"></i></button>
                                    </a>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif



    @if ($images->isNotEmpty())
        <section class="photo-gallery py-2">
            <div class="container">
                <h2 class="text-center section_title pb-3">Photo Gallery</h2>
                <div class="row g-4">
                    @foreach ($images as $image)
                        <div class="col-lg-4 col-md-4 col-sm-6 mt-3 mb-3">
                            <div class="accordion">

                                <ul>
                                    @if (!empty($image->img))
                                        @foreach ($image->img as $imgUrl)
                                            <li tabindex="{{ $loop->iteration }}"
                                                style="background-image: url('{{ asset($imgUrl) }}');">
                                                <a href="{{ route('singleImage', ['slug' => $image->slug]) }}"
                                                    class="d-block"
                                                    style="width: 100%; height: 100%; position: absolute; top: 0; left: 0;"></a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                                <div class="accordion-content">
                                    <h3 class="text-center pt-3">

                                        {{ $image->title }}

                                    </h3>
                                    <p class="text-center pt-2">{{ $image->description }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif


    @if ($videos->isNotEmpty())
        <section class="video-gallery py-3">
            <div class="container">
                <h2 class="text-center section_title pb-3">Video Gallery</h2>
                <div class="row g-4">
                    @foreach ($videos as $video)
                        <div class="col-md-4">
                            <div class="card video_card mt-2 mb-2" width="100%">
                                    {!! $video->url !!}
                                <div class="card-body text-center">
                                    <span class="vid_desc">
                                        <p class="card-text">{{ $video->title }}</p>
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="multi_post">
        <div class="container">
            <h2 class="text-center section_title pb-3">Blogs</h2>
            <div class="multi_poster row justify-content-center row-gap-5 gap-5">
                @foreach ($blogs as $blog)
                    <div class="card col-lg-3">
                        <a href="{{ route('SingleBlogpostcategory', ['slug' => $blog->slug]) }}">
                            <div class="multi_post_image">
                                <img src="{{ asset('uploads/blogpostcategory/' . $blog->image) }}" alt="">

                            </div>

                            <div class="card-body">
                                <h4 class="text-center">{{ Str::limit($blog->title, 200) }}</h4>


                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="container">
        <h1 class="text-center section_title pb-3">Contact</h1>
        <div class="d-flex flex-column justify-content-center my-5 row customconnectwithus">
            <span class="d-flex flex-column justify-content-center align-items-center containertitle">
            </span>
            <div class="d-flex flex-column justify-content-center row">
                <div class="customconnectwithus-innersection d-flex justify-content-between">
                    <div class="customconnectwithus-innersection-left col-md-5">
                        <form id="contactForm" class="form-horizontal" method="POST"
                            action="{{ route('Contact.store') }}">
                            @csrf
                            <div class="customconnectwithus-innersection-left_inputcontainer d-flex flex-column">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" placeholder="NAME" name="name" value="{{ old('name') }}"
                                    required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="customconnectwithus-innersection-left_inputcontainer d-flex flex-column">
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" placeholder="Email" name="email" value="{{ old('phone_no') }}"
                                    required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="customconnectwithus-innersection-left_inputcontainer d-flex flex-column">
                                <input type="tel" class="form-control @error('phone_no') is-invalid @enderror"
                                    id="phone_no" placeholder="Phone No." name="phone_no"
                                    value="{{ old('phone_no') }}" required>
                                @error('phone_no')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="customconnectwithus-innersection-left_inputcontainer d-flex flex-column">
                                <textarea class="form-control message-box @error('message') is-invalid @enderror" rows="4"
                                    placeholder="MESSAGE" name="message" required>{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                            <div class="customconnectwithus-innersection-left_inputcontainer d-flex flex-column my-1">
                                <button type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="customconnectwithus-innersection-right-map col-md-6">
                        <div class="py-2">
                            <iframe src="{{ $sitesetting->google_maps_link }}" width="100%" height="300"
                                style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    @include('frontend.body_includes.herosection')
    @include('frontend.body_includes.introduction')
    @include('frontend.body_includes.awards')
    @include('frontend.body_includes.gallery')
    @include('frontend.body_includes.videogallery')
    @include('frontend.body_includes.events')

    {{-- @include('frontend.body_includes.blogs') --}}
    @include('frontend.body_includes.contact')




    <!-- Existing scripts -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        $(document).ready(function() {
            $('#contactForm').on('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission

                var form = $(this);
                var formData = new FormData(this);
                var recaptchaResponse = grecaptcha.getResponse();

                if (recaptchaResponse.length === 0) {
                    alert("Please tick the reCAPTCHA box before submitting.");
                    return;
                }

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Assuming the server returns JSON with 'success' and 'message'
                        if (response.success) {
                            alert("Message sent successfully!");
                        } else {
                            alert("Are you Sure?");
                        }
                    },
                    error: function(xhr, status, error) {
                        alert("An unexpected error occurred. Please try again.");
                    }
                });
            });
        });
    </script>
@endsection
