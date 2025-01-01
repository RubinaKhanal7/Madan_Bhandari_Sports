@extends('frontend.layouts.master')

@section('content')




<div class="page-title dark-background">
    <div class="container position-relative">
      <h1>{{ $blogpostcategory->title }}</h1>
      
    </div>
  </div><!-- End Page Title -->

    <section>
        <div class="container">
           
            <div class="row">
                <!-- Main Content Column -->
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <!-- Blog Post Image -->
                    <img class="sample_page_image"
                         src="{{ asset('uploads/blogpostcategory/' . $blogpostcategory->image) }}" 
                         alt="Blog Post Image">

                    <!-- Blog Post Content -->
                    <div class="sample_page_content mt-4">
                        {!! $blogpostcategory->content !!}
                    </div>
                </div>

                <!-- Sidebar Column -->
                <div class="col-lg-4 col-md-4 col-sm-12 order-3 order-md-2 sample_page_list mt-2 mb-2 p-4">
                    <h3 class="">Blogs</h3><br>
                    <ul>
                        @foreach ($listblogs as $blog)
                            <li>
                                <a
                                    href="{{ route('SingleBlogpostcategory', ['slug' => $blog->slug]) }}">{{ $blog->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection

