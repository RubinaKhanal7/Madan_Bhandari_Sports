@extends('portal.layouts.master')

@section('content')
    <section class="single_page">
        <div class="container">


            <h1 class="cat_title">{{ __($context->title) }}</h1>



            <div class="row mt-3">

                @foreach ($informations as $information)
                
                    <div class="col-md-4">
                        <div class="card video_card mt-2 mb-2">
                            <iframe src="{{ asset($information->file) }}" width="100%" height="300px">
                            </iframe>

                            <div class="card-body">

                                <span class="vid_desc">{{ $information->title }}</span><br>
                                <p class="font_icons">
                                    <a class="nodecoration" target="_blank"
                                                            href="{{ asset($information->file) }}"
                                                            download>
                                    <span class="font_down">
                                        <i class="fas fa-download"></i>
                                    </span>
                                    </a>
                                   &nbsp;
                                   &nbsp;
                                   &nbsp;
                                   <a class="nodecoration" href="{{ asset($information->file) }}"
                                    target="_blank">
                                    <span class="font_eye">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                   </a>
                                </p>

                            </div>
                        </div>
                    </div>
                @endforeach


            </div>



        </div>
    </section>
@endsection
