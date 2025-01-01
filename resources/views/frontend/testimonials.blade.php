@extends('frontend.layouts.master')

@section('content')



<!-- herosection for about contact and dem -->
<section class="herosectionforallpage my-4">
    <div class="container">
    <img src="./image/candidate2.jpg" alt="">
    <div class="d-flex flex-column innercontent">
     <span class="maintitle">Testimonial</span>
     <span class="navigatetitle py-2 px-3 mb-1">
      <a href="" style="color: white !important; text-decoration: none;">Home</a> > <span>Testimonial</span>
  </span>
    </div>
  </div>
  </section>
  <div class="">
    <h1 class="page_title">{{ trans('messages.Testimonial') }}</h1>
</div>
    <section class="testimonial_page">
        <div class="container">
            <div class="row ">
                @foreach ($testimonials as $testimonial)
                    <div class="col-md-6 row test_row">
                        <div class="">
                            @if ($testimonial->image)
                            <img src="{{ asset('uploads/testimonial/' . $testimonial->image) }}" class="test_image" alt="">

                            @else
                                <img src="{{ asset('image/girl.jpg') }}" class="test_image" alt="">
                            @endif
                            </div>
                            <p> @if (app()->getLocale() == 'ne')
                                {{ $testimonial->description_ne }}
                            @else
                                {{ $testimonial->description }}
                            @endif</p>
                            <h3> @if (app()->getLocale() == 'ne')
                                {{ $testimonial->name_ne }}
                            @else
                                {{ $testimonial->name }}
                            @endif</h3>
                            <h5> @if (app()->getLocale() == 'ne')
                                {{ $testimonial->company->title_ne }}
                            @else
                                {{ $testimonial->company->title }}
                            @endif</h5>
                            <h6>
                                @if (app()->getLocale() == 'ne')
                                    {{ $testimonial->work_category->title_ne }}
                                @else
                                    {{ $testimonial->work_category->title }}
                                @endif
                            </h6>
                            <hr>
                          
                        </div>
                       
                    </div>
                @endforeach
            </div>
       </div>
    </section>
@endsection
