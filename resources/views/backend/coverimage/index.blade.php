@extends('backend.layouts.master')
@section('content')
<div class="card mt-3">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Cover Images</h5>
        <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createCoverImageModal">
            + Add New
        </button>
    </div>
    <div class="card-body">
        @if(session('success'))
        <div class="alert alert-success border-2 d-flex align-items-center" role="alert">
            <div class="bg-success me-3 icon-item"><span class="fas fa-check-circle text-white fs-3"></span></div>
            <p class="mb-0 flex-1">{{ session('success') }}</p>
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger border-2 d-flex align-items-center" role="alert">
            <div class="bg-danger me-3 icon-item"><span class="fas fa-exclamation-circle text-white fs-3"></span></div>
            <p class="mb-0 flex-1">{{ session('error') }}</p>
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger border-2" role="alert">
                <div class="d-flex">
                    <div class="bg-danger me-3 icon-item">
                        <span class="fas fa-exclamation-circle text-white fs-3"></span>
                    </div>
                    <div class="flex-1">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif


        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Title (EN)</th>
                        <th>Title (NE)</th>
                        <th>Image</th>
                        <th>Status</th>
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
                                <button class="btn btn-sm {{ $coverImage->is_active ? 'btn-success' : 'btn-danger' }}"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#statusModal{{ $coverImage->id }}">
                                    {{ $coverImage->is_active ? 'Active' : 'Inactive' }}
                                </button>
                            </td>
                            <td>
                                <button class="btn btn-outline-primary btn-sm edit-btn" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editCoverImageModal{{ $coverImage->id }}" 
                                        style="width: 32px;">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-outline-danger btn-sm" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#deleteCoverImageModal{{ $coverImage->id }}" 
                                        style="width: 32px;">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Status Change Modal -->
                      
                        <div class="modal fade" id="statusModal{{ $coverImage->id }}" tabindex="-1">
                          <div class="modal-dialog">
                        <form method="POST" action="{{ route('admin.cover-images.toggle-status', $coverImage->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title">Change Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                          <p>Do you want to {{ $coverImage->is_active ? 'deactivate' : 'activate' }} this cover image?</p>
                          <p><strong>Current status:</strong> {{ $coverImage->is_active ? 'Active' : 'Inactive' }}</p>
                         </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn {{ $coverImage->is_active ? 'btn-danger' : 'btn-success' }}">
                        {{ $coverImage->is_active ? 'Deactivate' : 'Activate' }}
                     </button>
                    </div>
                  </div>
                 </form>
              </div>
           </div>

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
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                            <label class="form-label">Title (EN)</label>
                                            <input type="text" name="title_en" class="form-control" value="{{ $coverImage->title_en }}" required>
                                        </div>
                                            <div class="col-md-6">
                                            <label class="form-label">Title (NE)</label>
                                            <input type="text" name="title_ne" class="form-control" value="{{ $coverImage->title_ne }}" required>
                                            </div>
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
                                        <button type="button" class="btn btn-primary" onclick="saveCroppedImageEdit({{ $coverImage->id }})">
                                            Save Cropped Image
                                        </button>
                                        <button type="submit" class="btn btn-success" id="editSubmitBtn{{ $coverImage->id }}" style="display: none;">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>   
                      <!-- Delete Confirmation Modal -->
                      <div class="modal fade" id="deleteCoverImageModal{{ $coverImage->id }}" tabindex="-1" aria-labelledby="deleteCoverImageModalLabel{{ $coverImage->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteCoverImageModalLabel{{ $coverImage->id }}">Delete Cover Image</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this cover image?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <form action="{{ route('admin.cover-images.destroy', $coverImage->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
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
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Title (EN)</label>
                            <input type="text" name="title_en" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Title (NE)</label>
                            <input type="text" name="title_ne" class="form-control" required>
                        </div>
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

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="saveCroppedImage()">
                            Save Cropped Image
                        </button>
                        <button type="submit" class="btn btn-success" id="createSubmitBtn" style="display: none;">Save</button>
                    </div>
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

            // Hide the submit button when new image is selected
            document.getElementById('createSubmitBtn').style.display = 'none';
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

            // Hide the submit button when new image is selected
            document.getElementById('editSubmitBtn' + id).style.display = 'none';
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
            document.getElementById('imagePreview').src = croppedImage;
            // Show the submit button after cropping
            document.getElementById('createSubmitBtn').style.display = 'block';
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
            document.getElementById('imagePreview' + id).src = croppedImage;
            // Show the submit button after cropping
            document.getElementById('editSubmitBtn' + id).style.display = 'block';
            alert('Cropped image has been saved. You can now update the form.');
        }
    }
}

// Add this to handle modal reset
document.addEventListener('DOMContentLoaded', function() {
    // Reset create modal when closed
    const createModal = document.getElementById('createCoverImageModal');
    createModal.addEventListener('hidden.bs.modal', function() {
        if (croppers['create']) {
            croppers['create'].destroy();
            delete croppers['create'];
        }
        document.getElementById('createSubmitBtn').style.display = 'none';
    });

    // Reset edit modals when closed
    const editModals = document.querySelectorAll('[id^="editCoverImageModal"]');
    editModals.forEach(modal => {
        const id = modal.id.replace('editCoverImageModal', '');
        modal.addEventListener('hidden.bs.modal', function() {
            if (croppers[id]) {
                croppers[id].destroy();
                delete croppers[id];
            }
            const submitBtn = document.getElementById('editSubmitBtn' + id);
            if (submitBtn) {
                submitBtn.style.display = 'none';
            }
        });
    });
});
</script>
@endsection
