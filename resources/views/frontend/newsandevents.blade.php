@extends('frontend.layouts.master')

@section('content')


<div class="page-title dark-background">
    <div class="container position-relative">
      <h1>News & Events</h1>
      <p>Stay updated with the latest news, upcoming performances, and events in my musical journey.</p>
      <nav class="breadcrumbs">
        <ol>
          <li><a href="">Home</a></li>
          <li class="current">News & Events</li>
        </ol>
      </nav>
    </div>
  </div><!-- End Page Title -->
{{-- 
<div class="">
    <h1 class="page_title">News & Events</h1>
</div> --}}





<section class="pricing section">


    <div class="container">
        <div class="row gy-4">


            @foreach ($newsEvents as $newsEvent)
                <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="{{ $loop->iteration }}00">
                    <a class="text-decoration-none" style="color: inherit"
                        href="{{ route('SingleNewsandEvents', ['slug' => $newsEvent->slug]) }}">
                        <div class='normal'>
                          {{-- <p class='demo-title'>{{ $newsEvent->type }}</p> --}}
                            <div class='module'>
                                <div class='thumbnail'>

                                    @if ($newsEvent->image)
                                    <img src="{{ asset('uploads/newsandevents/' . $newsEvent->image) }}"
                                         alt="News and Event Image">
                                @else
                                    <img src="https://via.placeholder.com/500"
                                         alt="News and Event Image">
                                @endif
                                    
                                    <div class='date'>
                                        <div>{{ $newsEvent->created_at->format('d') }}</div>
                                        <div>{{ $newsEvent->created_at->format('M') }}</div>
                                    </div>
                                </div>
                                <div class='content'>
                                    <div class="category">{{ $newsEvent->type }}</div>
                                    <h1 class='title'>{{ $newsEvent->title }}</h1>
                                    <h2 class='sub-title'>{{ strtok(strip_tags($newsEvent->content), '.') }}.</h2>
                                    <div class="description">{{ Str::limit(strip_tags($newsEvent->content), 400) }}</div>
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

<style>
    #social-buttons {
}

#social-buttons a {
    display:inline-block;
    margin:0.125em;
    font-size:1.5em;
    list-style:none;
}

#social-buttons a:hover {
    -webkit-transform:scale(1.1);
    -moz-transform:scale(1.1);
    -ms-transform:scale(1.1);
    -o-transform:scale(1.1);
    transform:scale(1.1);
}

.fa-facebook, .fa-facebook-square {
    color:#3c599f;
}

.fa-twitter, .fa-square-twitter {
    color:#00aced;
}

.fa-x-twitter, .fa-square-x-twitter {
    color:#000;
}

.fa-linkedin {
    color:#0085ae;
}

.fa-telegram {
    color:#0088cc;
}

.fa-whatsapp, .fa-square-whatsapp {
    color:#4fce5d;
}

.fa-reddit {
    color:#ff4500;
}

.fa-hacker-news {
    color:#f37022;
}

.fa-vk {
    color:#375474;
}

.fa-pinterest {
    color:#cb2027;
}

.fa-get-pocket {
    color:#ee4056;
}

.fa-evernote {
    color:#1fb655;
}

.fa-skype {
    color:#01aef2;
}

.fa-xing, .fa-square-xing {
    color:#00555c;
}

.fa-share {
    color:#1977d4;
}

.fa-envelope {
    color:#ea4445;
}

</style>
@endsection
