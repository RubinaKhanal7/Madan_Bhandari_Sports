@extends('portal.layouts.master')

@section('content')

<section class="single_page">
    <div class="container">


        <h1 class="cat_title">{{ __('Video Gallery') }}</h1>



        <div class="row mt-3">
                         
            @foreach ($videos as $video)
            <div class="col-md-4">
                <div class="card video_card mt-2 mb-2">
                    <iframe src="https://www.youtube.com/embed/{{ $video->vid_url }}" title="{{ $video->vid_desc }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <div class="card-body text-center">
                   
                        <span class="vid_desc">{{ $video->vid_desc }}</span><br>
                       
                    
                    </div>
                </div>
            </div>
        @endforeach
    

        </div>



    </div>
</section>




@endsection
