@extends('backend.layouts.master')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Photo Galleries</h2>
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createPhotoGalleryModal">Create Photo Gallery</button>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Title (EN)</th>
                        <th>Title (NE)</th>
                        <th>Images</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            
                    <tbody>
                        @foreach($photoGalleries as $photoGallery)
                            <tr>
                                <td>{{ $photoGallery->title_en }}</td>
                                <td>{{ $photoGallery->title_ne }}</td>
                                <td>
                                    @foreach($photoGallery->images as $image)  <!-- No json_decode() needed -->
                                        <img src="{{ asset($image) }}" alt="Photo Gallery Image" style="max-width: 100px;">
                                    @endforeach
                                </td>
                                <td>
                                    <button class="btn btn-outline-info btn-sm" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editPhotoGalleryModal{{ $photoGallery->id }}" 
                                            style="width: 32px;">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                     
                                    <button class="btn btn-outline-danger btn-sm" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deletePhotoGalleryModal{{ $photoGallery->id }}" 
                                            style="width: 32px;">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                           
                    <!-- Edit Modal -->
                    <div class="modal fade" id="editPhotoGalleryModal{{ $photoGallery->id }}" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form action="{{ route('admin.photo-galleries.update', $photoGallery->id) }}" 
                                      method="POST" 
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Photo Gallery</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Title (EN)</label>
                                            <input type="text" name="title_en" class="form-control" value="{{ $photoGallery->title_en }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Title (NE)</label>
                                            <input type="text" name="title_ne" class="form-control" value="{{ $photoGallery->title_ne }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Images</label>
                                            <div class="preview-container-{{ $photoGallery->id }}">
                                                @foreach(json_decode($photoGallery->images) as $image)
                                                    <img src="{{ asset($image) }}" 
                                                         alt="Current Image" 
                                                         id="imagePreview{{ $photoGallery->id }}" 
                                                         style="max-width: 200px; margin-bottom: 10px;">
                                                @endforeach
                                            </div>
                                            <input type="file" 
                                                   name="images[]" 
                                                   class="form-control" 
                                                   multiple
                                                   onchange="previewImagesEdit(event, {{ $photoGallery->id }})">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Description (EN)</label>
                                            <textarea name="description_en" class="form-control">{{ $photoGallery->description_en }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Description (NE)</label>
                                            <textarea name="description_ne" class="form-control">{{ $photoGallery->description_ne }}</textarea>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label class="form-label">Is Active?</label>
                                            <input type="checkbox" 
                                                name="is_active" 
                                                value="1" 
                                                {{ $photoGallery->is_active ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>   

                      <!-- Delete Confirmation Modal -->
                      <div class="modal fade" id="deletePhotoGalleryModal{{ $photoGallery->id }}" tabindex="-1" aria-labelledby="deletePhotoGalleryModalLabel{{ $photoGallery->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deletePhotoGalleryModalLabel{{ $photoGallery->id }}">Delete Photo Gallery</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this photo gallery?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <form action="{{ route('admin.photo-galleries.destroy', $photoGallery->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>                    
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createPhotoGalleryModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('admin.photo-galleries.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Create Photo Gallery</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Title (EN)</label>
                        <input type="text" name="title_en" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Title (NE)</label>
                        <input type="text" name="title_ne" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Images</label>
                        <div id="imagePreviewContainer" style="margin-bottom: 10px;">
                            <img id="imagePreview" src="#" alt="Selected Image" style="max-width: 200px; display: none;">
                        </div>
                        <input type="file" name="images[]" class="form-control" multiple required onchange="previewImages(event)">
                    </div>
            
                    <div class="mb-3">
                        <label class="form-label">Description (EN)</label>
                        <textarea name="description_en" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description (NE)</label>
                        <textarea name="description_ne" class="form-control"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Is Active?</label>
                        <input type="checkbox" name="is_active" checked value="1">
                    </div>

                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function previewImages(event, photoGalleryId = null) {
    var reader = new FileReader();
    reader.onload = function() {
        var output;
        if (photoGalleryId) {
            output = document.getElementById('imagePreview' + photoGalleryId); 
        } else {
            output = document.getElementById('imagePreview'); 
        }
        output.src = reader.result;
        output.style.display = 'block';
    };
    reader.readAsDataURL(event.target.files[0]);
}

function previewImagesEdit(event, photoGalleryId) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('imagePreview' + photoGalleryId);
        output.src = reader.result;
        output.style.display = 'block';
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endsection
