<style>
/* General Styles */
/* body {
    font-family: Arial, sans-serif;
    background-color: #f4f6f9;
    color: #333;
} */

/* Content Header */
h1.m-0 {
    font-size: 2rem;
    font-weight: bold;
    color: #333;
    margin-bottom: 1rem;
}

/* Back Button */
.btn-primary {
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    padding: 0.5rem 1rem;
    cursor: pointer;
    text-align: center;
    font-size: 0.875rem;
}

.btn-primary:hover {
    background-color: #0056b3;
}

/* Alert Messages */
.alert {
    padding: 1rem;
    margin-bottom: 1rem;
    border-radius: 4px;
}

.alert-success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

/* Sortable List */
#sortable {
    list-style-type: none;
    padding: 0;
    margin: 0;
}

#sortable li {
    margin: 0.5rem 0;
    padding: 1rem;
    border: 1px solid #ddd;
    border-radius: 4px;
    background-color: #fff;
    cursor: move;
}

#sortable li .team_s{
    margin-right: 30px;
}

#sortable li:hover {
    background-color: #f8f9fa;
}

/* Card Footer */
.card-footer {
    padding: 1rem;
    background-color: #fff;
    border-top: 1px solid #ddd;
}

.card-footer .btn-primary {
    background-color: #007bff;
    color: #fff;
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 4px;
    font-size: 1rem;
}

.card-footer .btn-primary:hover {
    background-color: #0056b3;
}

.breadcrumb {
    background-color: transparent;
    padding: 0;
    margin: 0;
    list-style: none;
}

.breadcrumb-item {
    display: inline;
    color: #007bff;
    text-decoration: none;
}

.breadcrumb-item + .breadcrumb-item::before {
    content: ">";
    padding: 0 0.5rem;
    color: #6c757d;
}

.breadcrumb-item:hover {
    text-decoration: underline;
}


</style>
@extends('backend.layouts.master')


@section('content')
    <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->

    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">{{ $page_title }}</h1>
            <a href="{{ url('admin') }}"><button class="btn-primary btn-sm"><i class="fa fa-arrow-left"></i>
                    Back</button></a>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->


    @if (session('message'))
    <div class="alert alert-success">
        {!! session('message') !!}
    </div>
@endif
{{-- 
@if (session('error'))
    <div class="alert alert-danger">
        {!! session('error') !!}
    </div>
@endif --}}
    <form action="{{ route('admin.team.updateorder') }}" method="POST">
        @csrf
     
    <ul id="sortable">
        @foreach($teams as $team)
       
        

           <li data-id="{{ $team->id }}">
            <span class="team_s">{{ $loop->iteration }}.</span> 
            <input name="teamOrders[]" type="hidden" value="{{ $team->id }}"><span class="team_s"><b>{{ $team->name }}</b></span> <span class="team_s">{{ $team->position }}</span> <span class="team_s"> {{ $team->role }}</span>
            </li>
        </li>
        @endforeach
    </ul>

    <div class="card-footer">
        <button type="submit" class="btn-primary">Submit</button>
    </div>
    </form>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/sortablejs/Sortable.min.js"></script>
    <script>
        new Sortable(document.getElementById('sortable'), {
            onEnd: function (event) {
                var teamOrders = Array.from(event.item.parentElement.children).map(function (el, index) {
                    return { order: index, teamId: el.getAttribute('data-id') };
                });
    
                axios.post('/team/reorder', { teamOrders: teamOrders })
                    .then(function (response) {
                        // Success message or other handling
                    })
                    .catch(function (error) {
                        // Error handling
                    });
            }
            // ,
            // onUpdate: function (event) {
            //     var teamId = event.item.getAttribute('data-id');
            //     var teamName = event.item.textContent.trim();
    
            //     axios.post('/teams/updateOrder', { teamId: teamId, teamName: teamName })
            //         .then(function (response) {
            //         })
            //         .catch(function (error) {
            //         });
            // }
        });
    </script>
    
  
  
      
    </form>




@stop
