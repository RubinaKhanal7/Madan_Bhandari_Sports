@extends('portal.layouts.master')

@section('content')

<section class="single_page">
    <div class="container">


        <h1 class="cat_title">{{ __($image->img_desc) }}</h1>



        <div class="row mt-3">
            @foreach ($image->img as $imgUrl)
            <div class="col-md-3">
                <img src="{{ asset($imgUrl) }}" class="gallery_image">
            </div>
            @endforeach
    

        </div>



    </div>
</section>




@endsection
