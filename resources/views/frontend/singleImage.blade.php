@extends('frontend.layouts.master')

@section('content')



<div class="page-title dark-background">
    <div class="container position-relative">
      <h1>{{ $image->title }}</h1>
      
    </div>
  </div>


<section>
    <div class="container">
        <div class="row">
            <p class="text-center"> <span>
               
                {{ $image->img_desc }}
        
        </span></p>
            @foreach ($image->img as $imgUrl)
            <div class="col-md-4 mb-3">
                <a class="image-link" href="{{ asset($imgUrl) }}" style="color: var(--first)">
                    <img src="{{ asset($imgUrl) }}" class="gallery_image">
                </a>
            </div>
            @endforeach

           
        </div>
    </div>
</section>

<!-- Include Magnific Popup CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">

<!-- Include jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Include Magnific Popup JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

<script>
    $(document).ready(function(){
        $('.image-link').magnificPopup({
            type: 'image',
            gallery:{
                enabled:true
            }
        });
    });
</script>

@endsection
