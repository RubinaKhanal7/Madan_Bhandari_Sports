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

    <div class="container">
        <h1>Edit News/Event</h1>

        <form method="POST" action="{{ route('admin.news.update', $newsEvent->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <a href="{{ route('admin.news.index') }}" class="btn btn-secondary mb-3">Back</a>

            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $newsEvent->title) }}" required>
                @error('title')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <!-- Type Dropdown -->
            <div class="form-group">
                <label for="type">Type</label>
                <select id="type" name="type" class="form-control" required>
                    <option value="" disabled {{ old('type', isset($newsEvent->type) ? '' : 'selected') }}>Select a type</option>
                    @foreach($types as $type)
                        <option value="{{ $type }}" {{ old('type', $newsEvent->type ?? '') == $type ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                </select>
            </div>


            {{-- <div class="form-group">
                <label for="type">Type</label>
                <select id="type" name="type" class="form-control" required>
                    <option value="" disabled>Select a type</option>
                    <option value="Award Shows" {{ old('type', $newsEvent->type ?? '') == 'Award Shows' ? 'selected' : '' }}>Award Shows</option>
                    <option value="Competitions" {{ old('type', $newsEvent->type ?? '') == 'Competitions' ? 'selected' : '' }}>Competitions</option>
                    <option value="Events" {{ old('type', $newsEvent->type ?? '') == 'Events' ? 'selected' : '' }}>Events</option>
                    <option value="Video Launch" {{ old('type', $newsEvent->type ?? '') == 'Video Launch' ? 'selected' : '' }}>Video Launch</option>
                </select>
            </div>
             --}}
        

            <div class="form-group">
                <label for="content">Content:</label>
                <textarea class="form-control summernote @error('content') is-invalid @enderror" id="content" name="content" rows="5" required>{{ old('content', $newsEvent->content) }}</textarea>
                @error('content')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Current Image:</label>
                <div>
                    @if($newsEvent->image)
                        <img id="preview1" src="{{ asset('uploads/newsandevents/' . $newsEvent->image) }}" style="max-width: 300px; max-height: 300px;" alt="{{ $newsEvent->title }}" />
                    @else
                        No image uploaded.
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="image">New Image (optional):</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*" onchange="previewImage(event)">
                @error('image')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>



            <label>Status</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="active" value="1" 
                    {{ $newsEvent->status == 1 ? 'checked' : '' }} required>
                <label class="form-check-label" for="active">
                    Active
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="inactive" value="0" 
                    {{ $newsEvent->status == 0 ? 'checked' : '' }} required>
                <label class="form-check-label" for="inactive">
                    Inactive
                </label>
            </div>
            

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <script>
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
    });

    // Function to upload image
    function uploadImage(file) {
        var data = new FormData();
        data.append('file', file);

        $.ajax({
            url: "{{ route('admin.news-and-events.uploadImage') }}",
            method: 'POST',
            data: data,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data.url) {
                    $('#content').summernote('insertImage', data.url);
                } else {
                    alert('Image upload failed!');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus + " " + errorThrown);
            }
        });
    }
});

    </script>
@endsection
