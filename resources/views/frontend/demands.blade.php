@extends('frontend.layouts.master')

@section('content')

<!-- herosection -->

    <section class="herosectionforallpage my-4">
    <div class="container">
    <img src="./image/candidate2.jpg" alt="">
    <div class="d-flex flex-column innercontent">
     <span class="maintitle">DEMAND</span>
     <span class="navigatetitle py-2 px-3 mb-1">
      <a href="" style="color: white !important; text-decoration: none;">Home</a> > <span>Demand</span>
  </span>
    </div>
  </div>
  </section>


   <!-- ourdemandcontent -->

    <section class="multi_post">
    <h1 class="page_title ">{{ trans('messages.OurDemands') }}</h1>
        <div class="container pt-4">
            <div class="multi_poster row justify-content-center gap-5">
                @foreach ($demands as $demand)
                    <div class="card col-lg-4">
                        <a href="{{ route('SingleDemand', ['id' => $demand->id]) }}">
                            <div class="multi_post_image">
                                @if ($demand->image)
                                    <img src="{{ asset('uploads/demands/' . $demand->image) }}" class="card-img-top" alt="Demand Image">
                                @else
                                    <img src="https://plus.unsplash.com/premium_photo-1705091309202-5838aeedd653?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHwyfHx8ZW58MHx8fHx8"
                                         class="card-img-top" alt="Post Image">
                                @endif
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">@if (app()->getLocale() == 'ne')
                                    {{ $demand->country->name_ne}}
                                @else
                                    {{ $demand->country->name }}
                                @endif</h5>
                                <p class="card-text">
                                    {{ $demand->from_date }} - {{ $demand->to_date }} <br />
                                    {{ trans('messages.Vacancy') }}:
                                    <span>
                                        @if (app()->getLocale() == 'ne')
                                            {{ $demand->vacancy_ne }}
                                        @else
                                            {{ $demand->vacancy }}
                                        @endif
                                    </span>
                                    @if (app()->getLocale() == 'ne')
                                       <p> {!! $demand->content_ne !!} </p>
                                    @else
                                        <p> {!! $demand->content !!} </p>
                                    @endif
                                </p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
