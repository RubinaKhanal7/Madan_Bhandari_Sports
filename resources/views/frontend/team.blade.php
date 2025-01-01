@extends('frontend.layouts.master')

@section('content')

<section class="herosectionforallpage my-4">
    <div class="container-fluid">
        <img src="{{ asset('image/team.jpeg') }}" alt="">
        <div class="d-flex flex-column innercontent">
            <span class="maintitle">Our Teams</span>
            <span class="navigatetitle py-2 px-3 mb-1">
                <a href="" style="color: white !important; text-decoration: none;">Home</a> > <span>Teams</span>
            </span>
        </div>
    </div>
</section>




<section class="multi_post">
    <div class="container">
        @if($teams->isEmpty())
            <p class="alert alert-warning">No team members found for {{ $page_title }}</p>
        @else
            @foreach($sortedTeams as $role => $teamMembers)
            <h1 class="page_title">{{ $role }}</h1>
                <div class="multi_poster row justify-content-center row-gap-5 gap-5">
                    @foreach($teamMembers as $team)
                        <div class="teamcard col-lg-3">
                            <div class="multi_post_image">
                                @if($team->image)
                                    <img src="{{ asset('uploads/team/' . $team->image) }}" class="card-img-top" alt="{{ $team->name }}">
                                @else
                                    <img src="https://via.placeholder.com/500" class="card-img-top" alt="Team Member Image">
                                @endif
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $team->name }}</h5>
                                <p class="card-text">
                                    <b>{{ $team->position }}</b><br>
                                    {{ $team->phone_no }}<br>
                                    {{ $team->email }}<br>
                                    {!! $team->description !!}

                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        @endif
    </div>
</section>
@endsection
