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
                            <td><img src="{{ asset($coverImage->image) }}" width="100"></td>
                            <td style="white-space: nowrap;">
                                <!-- Edit Button -->
                                <button class="btn btn-outline-info btn-sm" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editCoverImageModal{{ $coverImage->id }}" 
                                        style="width: 32px;">
                                    <i class="fas fa-edit"></i>
                                </button>
                            
                                <!-- Delete Button -->
                                <form action="{{ route('admin.cover-images.destroy', $coverImage->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" style="width: 32px;" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                            
                        </tr>

                        <!-- Edit Modal -->

                        <div class="modal fade" id="editCoverImageModal{{ $coverImage->id }}" tabindex="-1" aria-labelledby="editCoverImageModalLabel{{ $coverImage->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form action="{{ route('admin.cover-images.update', $coverImage->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editCoverImageModalLabel{{ $coverImage->id }}">Edit Cover Image</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group mb-3">
                                                <label for="title_en">Title (EN)</label>
                                                <input type="text" name="title_en" class="form-control" value="{{ $coverImage->title_en }}" required>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="title_ne">Title (NE)</label>
                                                <input type="text" name="title_ne" class="form-control" value="{{ $coverImage->title_ne }}" required>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="image">Image</label>
                                                <input type="file" name="image" class="form-control image-input" id="editImageInput{{ $coverImage->id }}" accept="image/*">
                                                
                                                <!-- Current Image Preview -->
                                                <div class="current-image mt-2">
                                                    <small>Current Image:</small><br>
                                                    <img src="{{ asset($coverImage->image) }}" width="200" class="current-preview">
                                                </div>
                                                
                                                <!-- Cropper Container -->
                                                <div class="cropper-container mt-3" style="display: none;">
                                                    <div class="img-container" style="max-height: 400px;">
                                                        <img id="editCropperImage{{ $coverImage->id }}" src="" style="max-width: 100%;">
                                                    </div>
                                                    <div class="crop-buttons mt-2">
                                                        <button type="button" class="btn btn-sm btn-primary rotate-left">↺ Rotate Left</button>
                                                        <button type="button" class="btn btn-sm btn-primary rotate-right">↻ Rotate Right</button>
                                                        <button type="button" class="btn btn-sm btn-success crop-button">✓ Crop</button>
                                                        <button type="button" class="btn btn-sm btn-danger reset-button">↺ Reset</button>
                                                    </div>
                                                </div>
                                                
                                                <!-- Final Preview -->
                                                <div class="final-preview mt-3" style="display: none;">
                                                    <small>Preview:</small><br>
                                                    <img src="" style="max-width: 200px;">
                                                </div>
                                                
                                                <input type="hidden" name="cropped_data" class="cropped-data">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="is_active">Is Active?</label>
                                                <input type="checkbox" name="is_active" value="1" {{ $coverImage->is_active ? 'checked' : '' }}>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Update</button>
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
<div class="modal fade" id="createCoverImageModal" tabindex="-1" aria-labelledby="createCoverImageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.cover-images.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createCoverImageModalLabel">Create Cover Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title_en">Title (EN)</label>
                        <input type="text" name="title_en" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="title_ne">Title (NE)</label>
                        <input type="text" name="title_ne" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image" class="form-control" id="createImageInput" required>
                        <div id="createCropperContainer" style="display: none; max-width: 100%; margin-top: 10px;">
                            <img id="createImagePreview" style="max-width: 100%;">
                        </div>
                        <input type="hidden" name="crop_x" id="createCropX">
                        <input type="hidden" name="crop_y" id="createCropY">
                        <input type="hidden" name="crop_width" id="createCropWidth">
                        <input type="hidden" name="crop_height" id="createCropHeight">
                    </div>
                    <div class="form-group">
                        <label for="is_active">Is Active?</label>
                        <input type="checkbox" name="is_active" value="1">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let croppers = {};
    
    function initializeCropper(imageId) {
        const image = document.getElementById(imageId);
        return new Cropper(image, {
            aspectRatio: 16 / 9,
            viewMode: 2,
            dragMode: 'move',
            autoCropArea: 1,
            restore: false,
            guides: true,
            center: true,
            highlight: false,
            cropBoxMovable: true,
            cropBoxResizable: true,
            toggleDragModeOnDblclick: false,
        });
    }
    
    // Handle all image inputs
    document.querySelectorAll('.image-input').forEach(input => {
        const modalId = input.id.replace('editImageInput', '');
        const cropperContainer = input.closest('.modal-body').querySelector('.cropper-container');
        const cropperImage = document.getElementById(`editCropperImage${modalId}`);
        const currentImage = input.closest('.modal-body').querySelector('.current-image');
        const finalPreview = input.closest('.modal-body').querySelector('.final-preview');
        const croppedDataInput = input.closest('.modal-body').querySelector('.cropped-data');
        
        // Handle file input change
        input.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Show cropper container and hide current image
                cropperContainer.style.display = 'block';
                currentImage.style.display = 'none';
                finalPreview.style.display = 'none';
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    cropperImage.src = e.target.result;
                    
                    // Destroy existing cropper if any
                    if (croppers[modalId]) {
                        croppers[modalId].destroy();
                    }
                    
                    // Initialize new cropper
                    croppers[modalId] = initializeCropper(`editCropperImage${modalId}`);
                };
                reader.readAsDataURL(file);
            }
        });
        
        // Rotate Left
        input.closest('.modal-body').querySelector('.rotate-left').addEventListener('click', function() {
            if (croppers[modalId]) {
                croppers[modalId].rotate(-90);
            }
        });
        
        // Rotate Right
        input.closest('.modal-body').querySelector('.rotate-right').addEventListener('click', function() {
            if (croppers[modalId]) {
                croppers[modalId].rotate(90);
            }
        });
        
        // Reset
        input.closest('.modal-body').querySelector('.reset-button').addEventListener('click', function() {
            if (croppers[modalId]) {
                croppers[modalId].reset();
            }
        });
        
        // Crop
        input.closest('.modal-body').querySelector('.crop-button').addEventListener('click', function() {
            if (croppers[modalId]) {
                const canvas = croppers[modalId].getCroppedCanvas({
                    width: 800,    // Max width
                    height: 600,   // Max height
                    imageSmoothingEnabled: true,
                    imageSmoothingQuality: 'high',
                });
                
                const croppedImageUrl = canvas.toDataURL('image/jpeg', 0.8);
                
                // Show final preview
                finalPreview.style.display = 'block';
                finalPreview.querySelector('img').src = croppedImageUrl;
                
                // Store cropped data
                croppedDataInput.value = croppedImageUrl;
                
                // Hide cropper
                cropperContainer.style.display = 'none';
            }
        });
    });
});
</script>
@endpush
@endsection
