{{-- For Cover News and Head News --}}

<section class="cover">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        @foreach ($coverimages as $key => $coverimage)
                            <button type="button" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide-to="{{ $key }}" class=""
                                aria-label="Slide {{ $key + 1 }}"></button>
                        @endforeach
                    </div>

                    <div class="carousel-inner">

                        @foreach ($coverimages as $key => $coverimage)
                            <div class="carousel-item">

                                <a href="">
                                    <img src="{{ asset('uploads/coverimage/' . $coverimage->image) }}"
                                        class="d-block w-100" alt="...">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>{{ $coverimage->title }}</h5>

                                    </div>
                                </a>

                            </div>
                        @endforeach

                    </div>


                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

            </div>


            {{-- <div class="col-md-3">
                @foreach ($teams as $team)
                    <div class="right_intro card card_one">


                        <div class="card-head">
                            <h5 class="card-title">{{ __($team->role) }}</h5>
                        </div>
                        <div class="row ">
                            <div class="col-md-5  col-5 col-sm-5">

                                <img src="{{ asset('uploads/team/' . $team->image) }}" alt="Team Image">
                            </div>
                            <div class="col-md-7  col-7 col-sm-7">
                                <p class="pp_desc"><span class="bold_name">{{ __($team->name) }}</span><br>
                                    <span class="pposition">{{ __($team->position) }}<br>
                                        {{ __($team->contact_number) }}<br></span>

                                    <!-- वरिष्ठ जलाधार व्यवस्थापन अधिकृत<br> -->

                                    <span class="eng">{{ $team->email }}</span>
                                    </span>
                            </div>
                        </div>

                    </div>
                @endforeach

              

            </div> --}}
        </div>
    </div>



</section>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var carouselIndicators = document.querySelectorAll(
            "#carouselExampleIndicators .carousel-indicators button");
        var carouselItems = document.querySelectorAll(
            "#carouselExampleIndicators .carousel-inner .carousel-item");

        carouselIndicators[0].classList.add("active");
        carouselItems[0].classList.add("active");
    });
</script>
