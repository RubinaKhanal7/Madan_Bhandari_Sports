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
        <a href="{{ route('admin.photo-galleries.index') }}">
            <button class="btn btn-primary btn-sm">
                <i class="fa fa-arrow-left"></i> Back
            </button>
        </a>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
            <li class="breadcrumb-item active">Dashboard v1</li>
        </ol>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <form id="quickForm" method="POST" action="{{ route('admin.photo-galleries.update', $gallery->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">

                <div class="form-group">
                    <label for="exampleInputEmail1">Image Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Title" value="{{ $gallery->title }}" required>
                </div>

                <div>
                    <label for="content">Description</label><span style="color:red; font-size:large">*</span>
                    <textarea style="max-width: 100%;min-height: 60px;" type="text" class="form-control" id="img_desc" name="img_desc" placeholder="Add Description">{{ $gallery->img_desc }}</textarea>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1"> Image <span style="color:red;"></span></label>
                    <span style="color:red; font-size:large"> *</span>
                    <input type="file" name="img[]" id="img" class="form-control" multiple onchange="previewImage(event)">
                </div>

                <div id="imagePreview" class="mt-2">
                    @php
                        $images = is_string($gallery->img) ? json_decode($gallery->img, true) : $gallery->img;
                    @endphp

                    @if (is_array($images))
                        @foreach ($images as $imagePath)
                            <div class="existing-image">
                                <img src="{{ asset($imagePath) }}" style="width: 100px; height: 100px; margin-right: 5px;">
                                <input type="hidden" name="existing_images[]" value="{{ $imagePath }}">
                            </div>
                        @endforeach
                    @else
                        <p>No images found.</p>
                    @endif
                </div>

                </div>


                <label>Status</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="active" value="1" 
                        {{ $gallery->status == 1 ? 'checked' : '' }} required>
                    <label class="form-check-label" for="active">
                        Active
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="inactive" value="0" 
                        {{ $gallery->status == 0 ? 'checked' : '' }} required>
                    <label class="form-check-label" for="inactive">
                        Inactive
                    </label>
                </div>
                
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn-primary">Update</button>
                </div>
            </form>
        </div>
    </section>

@if (isset($links) && is_array($links))
    <div class="p-4">
        @foreach ($links as $link)
            <a href="{{ $link[1] }}">
                <button class="btn-primary">{{ $link[0] }}</button>
            </a>
        @endforeach
    </div>
@endif

<style>
    .preview_image {
        max-width: calc(100% / 2);
        height: auto;
        margin: 5px;
    }
</style>

<script>
    const previewImage = e => {
        const files = e.target.files;
        const preview = document.getElementById('imagePreview');
        preview.innerHTML = '';
        for (let i = 0; i < files.length; i++) {
            const reader = new FileReader();
            reader.onload = () => {
                const img = document.createElement('img');
                img.src = reader.result;
                img.style.width = '100px';
                img.style.height = '100px';
                img.style.marginRight = '5px';
                preview.appendChild(img);
            };
            reader.readAsDataURL(files[i]);
        }
    };
</script>

@endsection
