@extends('backend.layouts.master')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Cover Images</h2>
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createCoverImageModal">Create Cover Image</button>
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
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($coverImages as $coverImage)
                        <tr>
                            <td>{{ $coverImage->title_en }}</td>
                            <td>{{ $coverImage->title_ne }}</td>
                            <td>
                                @if($coverImage->image)
                                <img src="{{ asset($coverImage->image) }}" alt="Cover Image" style="max-width: 100px;">
                                @else
                                    <span>No image</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-outline-info btn-sm" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editCoverImageModal{{ $coverImage->id }}" 
                                        style="width: 32px;">
                                    <i class="fas fa-edit"></i>
                                </button>
                                 
                                <form action="{{ route('admin.cover-images.destroy', $coverImage->id) }}" 
                                      method="POST" 
                                      style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-outline-danger btn-sm" 
                                            style="width: 32px;" 
                                            onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editCoverImageModal{{ $coverImage->id }}" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form action="{{ route('admin.cover-images.update', $coverImage->id) }}" 
                                    method="POST" 
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Cover Image</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Title (EN)</label>
                                            <input type="text" name="title_en" class="form-control" value="{{ $coverImage->title_en }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Title (NE)</label>
                                            <input type="text" name="title_ne" class="form-control" value="{{ $coverImage->title_ne }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Image</label>
                                            <div class="preview-container-{{ $coverImage->id }}">
                                                @if($coverImage->image)
                                                    <img src="{{ asset($coverImage->image) }}" 
                                                        alt="Current Image" 
                                                        id="imagePreview{{ $coverImage->id }}" 
                                                        style="max-width: 200px; margin-bottom: 10px;">
                                                @endif
                                            </div>
                                            <input type="file" 
                                                name="image" 
                                                class="form-control" 
                                                onchange="previewImageEdit(event, {{ $coverImage->id }})">
                                        </div>
                                        
                                        <!-- Container for Cropper -->
                                        <div class="mb-3">
                                            <div class="crop-container-{{ $coverImage->id }}" style="display: none;">
                                                <img id="imageToCrop{{ $coverImage->id }}" 
                                                    src="#" 
                                                    style="max-width: 100%;">
                                            </div>
                                        </div>

                                        <input type="hidden" 
                                            name="cropped_image" 
                                            id="croppedImage{{ $coverImage->id }}" 
                                            value="">
                                        
                                        <div class="mb-3">
                                            <label class="form-label">Is Active?</label>
                                            <input type="checkbox" 
                                                name="is_active" 
                                                value="1" 
                                                {{ $coverImage->is_active ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" 
                                                class="btn btn-primary" 
                                                onclick="saveCroppedImageEdit({{ $coverImage->id }})">
                                            Save Cropped Image
                                        </button>
                                        <button type="submit" class="btn btn-success">Update</button>
                                    </div>
                                </form>
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
<div class="modal fade" id="createCoverImageModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('admin.cover-images.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Create Cover Image</h5>
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
                        <label class="form-label">Image</label>
                        <div id="imagePreviewContainer" style="margin-bottom: 10px;">
                            <img id="imagePreview" src="#" alt="Selected Image" style="max-width: 200px; display: none;">
                        </div>
                        <input type="file" name="image" class="form-control" required onchange="previewImage(event)">
                    </div>
            
                    <div class="mb-3">
                        <img id="imageToCrop" src="#" style="max-width: 100%; display: none;">
                    </div>

                    <input type="hidden" name="cropped_image" id="croppedImage" value="">
            
                    <div class="mb-3">
                        <label class="form-label">Is Active?</label>
                        <input type="checkbox" name="is_active" checked value="1">
                    </div>

                    <button type="button" class="btn btn-primary" onclick="saveCroppedImage()">Save Cropped Image</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
 function previewImage(event, coverImageId = null) {
    var reader = new FileReader();
    reader.onload = function() {
        var output;
        if (coverImageId) {
            output = document.getElementById('currentImage' + coverImageId); 
        } else {
            output = document.getElementById('imagePreview'); 
        }
        output.src = reader.result;
        output.style.display = 'block';
    };
    reader.readAsDataURL(event.target.files[0]);
}

let croppers = {};

function previewImage(event) {
    var file = event.target.files[0];
    if (file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var imagePreview = document.getElementById('imagePreview');
            var imageToCrop = document.getElementById('imageToCrop');
            
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block';
            
            imageToCrop.src = e.target.result;
            imageToCrop.style.display = 'block';
            
            if (croppers['create']) {
                croppers['create'].destroy();
            }
            
            croppers['create'] = new Cropper(imageToCrop, {
                aspectRatio: 16 / 9,
                viewMode: 1,
                autoCropArea: 0.8,
            });
        };
        reader.readAsDataURL(file);
    }
}

function previewImageEdit(event, id) {
    var file = event.target.files[0];
    if (file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var imagePreview = document.getElementById('imagePreview' + id);
            var imageToCrop = document.getElementById('imageToCrop' + id);
            var cropContainer = document.querySelector('.crop-container-' + id);
            
            imagePreview.src = e.target.result;
            imageToCrop.src = e.target.result;
            cropContainer.style.display = 'block';
            
            if (croppers[id]) {
                croppers[id].destroy();
            }
            
            croppers[id] = new Cropper(imageToCrop, {
                aspectRatio: 16 / 9,
                viewMode: 1,
                autoCropArea: 0.8,
            });
        };
        reader.readAsDataURL(file);
    }
}

function saveCroppedImage() {
    if (croppers['create']) {
        var canvas = croppers['create'].getCroppedCanvas();
        if (canvas) {
            var croppedImage = canvas.toDataURL('image/jpeg');
            document.getElementById('croppedImage').value = croppedImage;
            alert('Cropped image has been saved. You can now submit the form.');
        }
    }
}

function saveCroppedImageEdit(id) {
    if (croppers[id]) {
        var canvas = croppers[id].getCroppedCanvas();
        if (canvas) {
            var croppedImage = canvas.toDataURL('image/jpeg');
            document.getElementById('croppedImage' + id).value = croppedImage;
            alert('Cropped image has been saved. You can now update the form.');
        }
    }
}
</script>
@endsection
