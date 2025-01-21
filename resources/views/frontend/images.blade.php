@extends('portal.layouts.master')

@section('content')

<section class="single_page">
    <div class="container">


        <h1 class="cat_title">{{ __('Photo Gallery') }}</h1>



        <div class="row">

            @foreach ($images as $image)
                <div class="col-md-6 mb-3">
                    <a href="">
                        <div class="accordion">
                            <ul>

                                @foreach ($image->img as $imgUrl)
                                    <li tabindex="{{ $loop->iteration }}"
                                        style=" background-image: url('{{ asset($imgUrl) }}');">

                                    </li>
                                @endforeach

                            </ul>

                        </div>
                    </a>
                </div>
            @endforeach
        </div>



    </div>
</section>




@endsection
