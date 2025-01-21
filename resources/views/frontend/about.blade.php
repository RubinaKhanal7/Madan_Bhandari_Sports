@extends('portal.layouts.master')

@section('content')

<section class="single_page">
    <div class="container">
        <h1 class="cat_title">{{ __('Introduction') }}</h1>
        <div class="row mt-3">
        <div class="col-md-6">
                <img class="big_image" src="{{ asset('uploads/about/' . $about->image) }}">
            </div>
            <div class="col-md-6">
              <p class="post_desc">
                {{ $about->content }}
              </p>
            </div>
            </div>
        </div>
   


     
    </div>
</section>

<section class="mvc_section">
    <div class="container">
     
            <div class="row">
                
                @foreach ($mvcs as $mvc)
                <div class="col-md-6 row mt-2 mb-2">
                    <div class="col-md-6">
                        <h3>{{ __($mvc->title) }}</h3>
    
    
                    </div>
                    <div class="col-md-6">
                        <img src="{{asset('uploads/mvc/' . $mvc->image)}}" alt="" class="square_image">
                    </div>
                </div>
                @endforeach
    
   
       
    </div>
</section>






@endsection
