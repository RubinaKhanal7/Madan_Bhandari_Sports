@extends('frontend.layouts.master')

@section('content')
    <div class="page-title dark-background">
        <div class="container position-relative">
            <h1>Awards & Achievements</h1>
            <p>Honored with multiple awards for my passion and excellence in music composition and performance.</p>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="">Home</a></li>
                    <li class="current">Awards & Achievements</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->
    <!-- multiple post of service -->


    <section class="services section">
        <div class="container">

            <div class="row gy-4">


                @foreach ($services as $service)
                    <div class="col-lg-4 col-md-6 service-item d-flex" data-aos="fade-up"
                        data-aos-delay="{{ $loop->iteration }}00">
                        <div class="icon flex-shrink-0">
                            <img src="{{ asset('uploads/service/' . $service->image) }}" alt="Image"
                                style="width: 200px; height: 300px; object-fit: cover; object-position: center;">
                            <!--    <i class="bi bi-briefcase"></i> -->
                        </div>
                        <div>
                            <h4 class="title">{{ $service->title }}</h4>
                            <p class="description"> {{ Str::limit(strip_tags($service->description), 200) }}
                            </p>
                            <a href="{{ route('SingleService', $service->slug) }}"
                                class="readmore stretched-link"><span>Learn More</span><i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                @endforeach



            </div>

        </div>
    </section>
    @endsection
