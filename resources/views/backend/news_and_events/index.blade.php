@extends('backend.layouts.master')

@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    @if (Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif

    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">{{ $page_title }}</h1>
            <a href="{{ route('admin.news.create') }}">
                <button class="btn btn-primary btn-sm">
                    <i class="fa fa-plus"></i> Create New News/Event
                </button>
            </a>
            <a href="{{ url('admin/news') }}">
                <!-- Replace 'admin' with the actual URL you want to redirect to -->
                <button class="btn btn-primary btn-sm">
                    <i class="fa fa-arrow-left"></i> Back
                </button>
            </a>
        </div>
    </div>

    @if($newsAndEvents->isEmpty())
        <div class="alert alert-warning">No news or events available.</div>
    @else
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Image</th>
                    
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($newsAndEvents as $index => $newsEvent)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $newsEvent->title }}</td>
                        <td>
                            @if($newsEvent->image)
                                <img src="{{ asset('uploads/newsandevents/' . $newsEvent->image) }}" alt="{{ $newsEvent->title }}" width="150">
                            @else
                                No Image
                            @endif
                        </td>
                       
                        <td> @if ($newsEvent->status == 1)
                            <span class="badge badge-success text-black">Active</span>
                        @else
                            <span class="badge badge-danger text-danger">Inactive</span>
                        @endif
                        </td>
                        <td>
                            <!-- Edit Button with Modal -->
                            <a href="{{ route('admin.news.edit', $newsEvent->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <!-- Delete Button with Modal -->
                            <form action="{{ route('admin.news.destroy', $newsEvent->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $newsAndEvents->links() }}
        </div>
    @endif
@endsection
