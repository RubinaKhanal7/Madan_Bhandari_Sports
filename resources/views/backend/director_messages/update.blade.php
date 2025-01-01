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
            <a href="{{ url('admin') }}"><button class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i>
                    Back</button></a>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
        </div>
    </div>

    <form id="quickForm" method="POST" action="{{ route('admin.director_messages.update', $message->id) }}"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label><span style="color:red; font-size:large"> *</span>
                <input style="width:auto;" type="text" name="name" class="form-control" id="name"
                    placeholder="Name" value="{{ old('name', $message->name) }}" required>
            </div>

            <div class="form-group">
                <label for="position">Position</label><span style="color:red; font-size:large"> *</span>
                <input style="width:auto;" type="text" name="position" class="form-control" id="position"
                    placeholder="Position" value="{{ old('position', $message->position) }}" required>
            </div>

            <div class="form-group">
                <label for="companyName">Company Name</label><span style="color:red; font-size:large"> *</span>
                <input style="width:auto;" type="text" name="companyName" class="form-control" id="companyName"
                    placeholder="Company Name" value="{{ old('companyName', $message->companyName) }}" required>
            </div>

            <div>
                <label for="message">Message</label>
                <textarea name="message" id="message" class="form-control" rows="3">{{ old('message', $message->message) }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" class="form-control" id="image" onchange="previewImage(event)">
                <img id="preview1" src="{{ asset('uploads/director_messages/' . $message->image) }}"
                    style="max-width: 300px; max-height:300px" />
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>

    <script>
        $('#message').summernote({
            placeholder: 'Enter message here...',
            tabsize: 2,
            height: 100
        });

        const previewImage = e => {
            const reader = new FileReader();
            reader.readAsDataURL(e.target.files[0]);
            reader.onload = () => {
                const preview = document.getElementById('preview1');
                preview.src = reader.result;
            };
        };
    </script>
@endsection
