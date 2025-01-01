@extends('frontend.layouts.master')

@section('content')



<div class="page-title dark-background">
    <div class="container position-relative">
      <h1>Video Gallery</h1>
      <p>Watch highlights of my musical performances and compositions captured on video.</p>
      <nav class="breadcrumbs">
        <ol>
          <li><a href="">Home</a></li>
          <li class="current">Video Gallery</li>
        </ol>
      </nav>
    </div>
  </div><!-- End Page Title -->

     <section class="video-gallery py-3">
        <div class="container">
            {{-- <h2 class="text-center section_title pb-3">Video Gallery</h2> --}}
            <div class="row g-4">
                @foreach ($videos as $video)
                <div class="col-md-4">
                    <div class="card video_card mt-2 mb-2">
                       <iframe width="355" height="315" src="{{ $video->url }}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
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
@endsection
