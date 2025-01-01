@extends('backend.layouts.master')

@section('content')
    <!-- Content Wrapper. Contains page content -->

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="container">
        <h1>Create Blog Post Categories</h1>
        <form method="POST" action="{{ route('admin.blog-posts-categories.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                @error('title')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*" onchange="previewImage(event)">
                @error('image')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
                <div id="imagePreview" class="mt-2"></div>
            </div>
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea class="form-control summernote @error('content') is-invalid @enderror" id="content" name="content" rows="10" required>{{ old('content') }}</textarea>
                @error('content')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label>Status</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="active" value="1" {{ old('status') == '1' ? 'checked' : '' }} required>
                    <label class="form-check-label" for="active">
                        Active
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="inactive" value="0" {{ old('status') == '0' ? 'checked' : '' }} required>
                    <label class="form-check-label" for="inactive">
                        Inactive
                    </label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
        <script>
            $(document).ready(function() {
                $('.summernote').summernote();
            });

            function previewImage(event) {
                var input = event.target;
                var preview = document.getElementById('imagePreview');

                while (preview.firstChild) {
                    preview.removeChild(preview.firstChild); // Clear previous preview
                }

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        var img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.maxWidth = '200px'; // Adjust the maximum width as needed
                        img.style.maxHeight = '200px'; // Adjust the maximum height as needed
                        preview.appendChild(img);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
    </div>
@endsection
