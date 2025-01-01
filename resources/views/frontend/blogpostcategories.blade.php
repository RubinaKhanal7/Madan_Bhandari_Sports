@extends('frontend.layouts.master')

@section('content')

<!-- herosection -->

<div class="page-title dark-background">
    <div class="container position-relative">
      <h1>Articles</h1>
      <p>Stay tuned for new blog posts that dive deep into my journey, inspirations, and everything in between.</p>
      <nav class="breadcrumbs">
        <ol>
          <li><a href="">Home</a></li>
          <li class="current">Articles</li>
        </ol>
      </nav>
    </div>
  </div><!-- End Page Title -->

{{-- <div class="">
    <h1 class="page_title">Blogs</h1>
</div> --}}

<section>
    <div class="container">
        <div class="row gy-4">


            @foreach ($blogpostcategories as $blog)
                <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="{{ $loop->iteration }}00">
                    <a class="text-decoration-none" style="color: inherit"
                        href="{{ route('SingleBlogpostcategory', $blog->slug) }}">
                        <div class='normal'>
                            <!-- <p class='demo-title'>Normal</p> -->
                            <div class='module'>
                                <div class='thumbnail'>
                                    <img src="{{ asset('uploads/blogpostcategory/' . $blog->image) }}">
                                    {{-- <div class='date'>
             <div>27</div>
             <div>Mar</div>
           </div> --}}
                                    <div class='date'>
                                        <div>{{ $blog->created_at->format('d') }}</div>
                                        <div>{{ $blog->created_at->format('M') }}</div>
                                    </div>
                                </div>
                                <div class='content'>
                                    {{-- <div class="category">News</div> --}}
                                    <h1 class='title'>{{ $blog->title }}</h1>
                                    <h2 class='sub-title'>{{ strtok(strip_tags($blog->content), '.') }}.</h2>
                                    <div class="description">{{ Str::limit(strip_tags($blog->content), 400) }}</div>
                                    <!-- <div class="meta">
             <span class="timestamp">
               <i class='fa fa-clock-o'></i> 6 mins ago
             </span>
             <span class="comments">
               <i class='fa fa-comments'></i>
               <a href="#"> 39 comments</a>
             </span>
           </div> -->
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach



        </div>
    </div>
</section>

@endsection
