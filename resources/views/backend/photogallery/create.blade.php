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
            <a href="{{ url('admin') }}">
                <button class="btn btn-primary btn-sm">
                    <i class="fa fa-arrow-left"></i> Back
                </button>
            </a>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div>
    </div>

    <form id="quickForm" method="POST" action="{{ route('admin.photo-galleries.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="title">Image Title</label>
                <input type="text" name="title" class="form-control" placeholder="Title" required>
            </div>

            <div>
                <label for="content">Description</label><span style="color:red; font-size:large"> *</span>
                <textarea style="max-width: 100%; min-height: 60px;" type="text" class="form-control" id="img_desc" name="img_desc"
                    placeholder="Add Description"></textarea>
            </div>
            <div class="form-group">
                <label for="img">Image <span style="color:red;"> *</span></label>
                <input type="file" name="img[]" id="img" class="form-control" multiple onchange="previewImages(event)" required>
            </div>
            <div id="image_preview"></div>
            <label>Status</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="active" value="1" required>
                <label class="form-check-label" for="active">Active</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="inactive" value="0" required>
                <label class="form-check-label" for="inactive">Inactive</label>
            </div>
        </div>


        
        

        
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>

    <style>
        .preview_image {
            max-width: calc(100% / 4);
            height: auto;
            margin: 5px;
        }
    </style>

    <script>
        const previewImages = (event) => {
            const previewContainer = document.getElementById('image_preview');
            previewContainer.innerHTML = '';
            const files = event.target.files;

            for (const file of files) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.setAttribute('class', 'preview_image');
                    img.src = e.target.result;
                    previewContainer.appendChild(img);
                };
                reader.readAsDataURL(file);
            }
        };
    </script>
@stop
