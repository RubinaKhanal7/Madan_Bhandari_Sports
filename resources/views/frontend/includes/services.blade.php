@extends('frontend.layouts.master')

@section('content')
<!-- herosection -->
{{-- <section class="servicepagehero py-4">
    <div class="container">
        <div class="row d-flex flex-column justify-content-center align-items-center">
            <h2 class="col-6">Empowering potential, fueling success. Strength in unity, success assured.</h2>
            <img src="./image/candidate.jpg" alt="Candidate">
            <div class="row py-4">
                <h2 class="col-7">Empowering talents abroad, connecting global expertise for impactful and sustainable growth across borders.</h2>
             
            </div>
        </div>
    </div>
</section> --}}

<!-- multiple post of service -->
<section class="multi_post">
    <div class="container">
        <div class="row justify-content-center gap-5">
            @foreach ($services as $service)
                <div class="col-lg-3">
                    <div class="card service_card mt-2 mb-2">
                    <a href="{{ route('SingleService', ['slug' => $service->slug]) }}" class="d-block text-decoration-none">
                        <div class="multi_post_image">
                            @if ($service->image)
                                <img src="{{ asset('uploads/service/' . $service->image) }}" class="img-fluid" alt="Post Image">
                            @else
                                <img src="https://plus.unsplash.com/premium_photo-1705091309202-5838aeedd653?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHwyfHx8ZW58MHx8fHx8" class="img-fluid" alt="Post Image">
                            @endif
                        </div>
                   

                        <div class="multi_post_content py-3">
                            <h5 class="title">{{ $service->title }}</h5>
                            <p class="description">{!! $service->description !!}</p>
                        </div>
                    </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
