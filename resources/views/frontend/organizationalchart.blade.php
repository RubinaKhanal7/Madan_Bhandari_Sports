@extends('portal.layouts.master')

@section('content')

<section class="single_page">
    <div class="container">
        <h1 class="cat_title">{{ __('Organizational Chart') }}</h1>
        <div class="row mt-3">
       
                <img class="big_image img-responsive" src="{{ asset('uploads/orgchart/' . $orgchart->image) }}">
            
            </div>
        </div>
   


     
    </div>
</section>




@endsection
