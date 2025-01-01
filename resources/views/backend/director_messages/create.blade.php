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

    <form id="quickForm" method="POST" action="{{ route('admin.director_messages.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label><span style="color:red; font-size:large"> *</span>
                <input style="width:auto;" type="text" name="name" class="form-control" id="name"
                    placeholder="Name" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="position">Position</label><span style="color:red; font-size:large"> *</span>
                <input style="width:auto;" type="text" name="position" class="form-control" id="position"
                    placeholder="Position" value="{{ old('position') }}" required>
            </div>

            <div class="form-group">
                <label for="companyName">Company Name</label><span style="color:red; font-size:large"> *</span>
                <input style="width:auto;" type="text" name="companyName" class="form-control" id="companyName"
                    placeholder="Company Name" value="{{ old('companyName') }}" required>
            </div>

            <div class="form-group">
                <label for="content">Message</label>
                <textarea name="message" id="message" class="form-control" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label for="image">Image</label><span style="color:red; font-size:large"> *</span>
                <input type="file" name="image" class="form-control" onchange="previewImage(event)" placeholder="Image"
                    required>
            </div>
            <img id="preview1" style="max-width: 200px; max-height:500px" />

            <script>
                $('#message').summernote({
                    placeholder: 'Enter message here...',
                    tabsize: 2,
                    height: 100
                });
            </script>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

    <script>
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
