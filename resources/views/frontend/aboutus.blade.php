@extends('frontend.layouts.master')

@section('content')

<style>
 .table-bordered {
    border: none !important;  /* Remove the border around the table */
}

.table-bordered th,.table-bordered tr, .table-bordered td {
    border: none !important;  /* Remove the borders inside the table */
}

</style>

<div class="page-title dark-background">
  <div class="container position-relative">
    <h1>{{ $about->title }}</h1>
    <p>A Musician, Composer, and Singer</p>
    <nav class="breadcrumbs">
      <ol>
        <li><a href="">Home</a></li>
        <li class="current">Introduction</li>
      </ol>
    </nav>
  </div>
</div><!-- End Page Title -->

<!-- herosection -->
<section class="aboutherosection">
    <div class="container">
        <div class="row align-items-center mx-5">


          <div class="col-md-12 order-md-1 order-1">
            <div class="section-title">
              <h2 class="text-center">{{ $about->subtitle }}</h2>
            </div>
          </div>
         

            <div class="col-md-12 order-md-2 order-2" style="text-align: justify; line-height: 1.6;">
              
              
                    {!! $about && $about->content ? $about->content : 'Content not available' !!}
              
            </div>
            <div class="col-md-12 order-md-3 order-3">
              <img src="{{ $about && $about->image ? asset('uploads/about/' . $about->image) : asset('images/default.jpg') }}" alt="" style="max-width: 100%; height: auto;">
            </div>
           
        </div>
    </div>
</section>

        
 
{{-- 

<section style="background-image: url('image/cover.gif') 0.5; background: cover; background-blend-mode: darken">
  <div class="container">
    <h2 class="text-center section_title">Our Objectives</h2>
    <div class="row">
      @foreach ($services as $service)
        <div class="col-md-6 col-lg-6 mb-4 d-flex objectivecontent">
          <div class="objectivecontent-cnt d-flex flex-column justify-content-center">
            <p class="obj-title" style="font-size: 20px;"> <i class="fa-solid fa-hand-point-right px-1"></i> {{ $service->title }}</p>
          </div>
        </div>
      @endforeach
    </div>
  
  </div>
</section> --}}






@endsection
