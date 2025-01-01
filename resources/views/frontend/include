@extends('frontend.layouts.master')

@section('content')
    {{-- <div class="background">
        <h1 class="page_title">{{ ucfirst($service->title) }}</h1>
    </div> --}}

    <section class="sample_page">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8 order-1 order-md-1">
                    {{-- <div class="card service_card mt-2 mb-2"> --}}
                    <img src="{{ asset('uploads/service/' . $service->image) }}" alt="Service Image" class="sample_page_image">
                </div>

                <div class="col-lg-8 col-md-8 col-sm-8 order-2 order-md-3 sample_page_content">
                    {!! $service->description !!}
                </div>
            

            <div class="col-lg-4 col-md-4 col-sm-12 order-3 order-md-2 sample_page_list mt-2 mb-2 p-4">
                <h3>{{ trans('Objectives') }}</h3><br>
                <ul>
                    @foreach ($listservices as $item)
                        <li>
                            <a href="{{ route('SingleService', ['slug' => $item->slug]) }}">
                             
                                    {{ ucfirst($item->title) }}
                               
                            </a>
                        </li>
                    @endforeach 
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection
