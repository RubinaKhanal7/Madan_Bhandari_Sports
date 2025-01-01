@extends('backend.layouts.master')

@section('content')
<div class="container mt-5">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
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
                <li class="breadcrumb-item active">{{ $page_title }}</li>
            </ol>
        </div>
    </div>

    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
            @error('title')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control summernote @error('content') is-invalid @enderror" id="summernote" name="content" rows="5" required>{{ old('content') }}</textarea>
            @error('content')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
            @enderror
        </div>

       <!-- Type Dropdown -->
    <div class="form-group">
        <label for="type">Type</label>
        <select id="type" name="type" class="form-control" required>
            <option value="" disabled {{ old('type') ? '' : 'selected' }}>Select a type</option>
            @foreach($types as $type)
                <option value="{{ $type }}" {{ old('type') == $type ? 'selected' : '' }}>{{ $type }}</option>
            @endforeach
        </select>
    </div>
        

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
            @error('image')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
            @enderror
            <img id="preview" style="max-width: 500px; max-height:500px" />
        </div>
        

        <label>Status</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="active"
                    value="1" required>
                <label class="form-check-label" for="active">
                    Active
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="active"
                    value="0" required>
                <label class="form-check-label" for="active">
                    Inactive
                    
                </label>
            </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>

{{-- <script>
    $(document).ready(function() {
// Initialize Summernote
$('#content').summernote({
    placeholder: 'Enter content here...',
    tabsize: 2,
    height: 150,
    callbacks: {
        onImageUpload: function(files) {
            uploadImage(files[0]);
        }
    }
})
})
</script> --}}


<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 300, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: true // set focus to editable area after initializing summernote
        });
    });
</script>



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
