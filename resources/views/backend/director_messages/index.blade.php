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
            <a href="{{ route('admin.director_messages.create') }}"><button class="btn btn-primary btn-sm"><i
                        class="fa fa-plus"></i>Add
                  </button></a>
            <a href="{{ url('admin') }}"><button class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i>
                    Back</button></a>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
        </div>
    </div>


    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>S.N.</th>
                <th>Name</th>
                <th>Position</th>
                <th>Company Name</th>
                <th>Image</th>
                <th>Message</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($directorMessages && count($directorMessages) > 0)
                @foreach ($directorMessages as $directorMessage)
                    <tr data-widget="expandable-table" aria-expanded="false">
                        <td width="5%">{{ $loop->iteration }}</td>
                        <td>{{ $directorMessage->name }}</td>
                        <td>{{ $directorMessage->position }}</td>
                        <td>{{ $directorMessage->companyName }}</td>
                        <td> <img id="preview{{ $loop->iteration }}"
                                src="{{ asset('uploads/director_messages/' . $directorMessage->image) }}"
                                style="width: 150px; height:150px" /></td>
                          <td>      {{ Str::limit(strip_tags($directorMessage->message), 200) }}</td>
                        <td>
                            <div style="display: flex; flex-direction:row;">
                                <a href="{{ route('admin.director_messages.edit', $directorMessage->id) }}"
                                    class="btn btn-warning btn-sm" style="margin-right: 5px;"><i class="fas fa-edit"></i>
                                    Edit</a>
                                <form action="{{ route('admin.director_messages.destroy', $directorMessage->id) }}"
                                    method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="7">No director messages found.</td>
                </tr>
            @endif
        </tbody>
    </table>
    <script>
        const previewImage = e => {
            const reader = new FileReader();
            reader.readAsDataURL(e.target.files[0]);
            reader.onload = () => {
                const preview = document.getElementById('preview');
                preview.src = reader.result;
            };
        };
    </script>

@endsection
