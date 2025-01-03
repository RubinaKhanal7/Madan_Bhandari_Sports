@extends('backend.layouts.master')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Categories</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Add Category</button>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Title (EN)</th>
                        <th>Title (NE)</th>
                        <th>Image</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $category->title_en }}</td>
                            <td>{{ $category->title_ne }}</td>
                            <td>
                                @if($category->image)
                                    <img src="{{ asset($category->image) }}" alt="Image" width="50">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge {{ $category->is_active ? 'bg-success' : 'bg-danger' }}">
                                    {{ $category->is_active ? 'Yes' : 'No' }}
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-outline-info btn-sm" data-bs-toggle="modal" 
                                        data-bs-target="#editModal{{ $category->id }}" style="width: 32px;">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" 
                                        data-bs-target="#deleteModal{{ $category->id }}" style="width: 32px;">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal{{ $category->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <form method="POST" action="{{ route('admin.categories.update', $category->id) }}" 
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Category</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Title (EN)</label>
                                                <input type="text" name="title_en" class="form-control" 
                                                       value="{{ $category->title_en }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Title (NE)</label>
                                                <input type="text" name="title_ne" class="form-control" 
                                                       value="{{ $category->title_ne }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Image</label>
                                                <div class="preview-container-{{ $category->id }}">
                                                    @if($category->image)
                                                        <img src="{{ asset($category->image) }}" 
                                                             alt="Current Image" 
                                                             id="imagePreview{{ $category->id }}" 
                                                             style="max-width: 200px; margin-bottom: 10px;">
                                                    @endif
                                                </div>
                                                <input type="file" name="image" class="form-control" 
                                                       onchange="previewImageEdit(event, {{ $category->id }})">
                                            </div>
                                            
                                            <!-- Container for Cropper -->
                                            <div class="mb-3">
                                                <div class="crop-container-{{ $category->id }}" style="display: none;">
                                                    <img id="imageToCrop{{ $category->id }}" src="#" 
                                                         style="max-width: 100%;">
                                                </div>
                                            </div>

                                            <input type="hidden" name="cropped_image" 
                                                   id="croppedImage{{ $category->id }}" value="">
                                            
                                            <div class="form-check mb-3">
                                                <input type="checkbox" name="is_active" class="form-check-input" 
                                                       {{ $category->is_active ? 'checked' : '' }}>
                                                <label class="form-check-label">Active</label>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" 
                                                    data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" 
                                                    onclick="saveCroppedImageEdit({{ $category->id }})">
                                                Save Cropped Image
                                            </button>
                                            <button type="submit" class="btn btn-success">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal{{ $category->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <form method="POST" action="{{ route('admin.categories.destroy', $category->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Delete Category</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete this category?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" 
                                                    data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Category</h5>
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
                            <div id="imagePreviewContainer">
                                <img id="imagePreview" src="#" alt="Selected Image" 
                                     style="max-width: 200px; display: none;">
                            </div>
                            <input type="file" name="image" class="form-control" onchange="previewImage(event)">
                        </div>
                        
                        <div class="mb-3">
                            <img id="imageToCrop" src="#" style="max-width: 100%; display: none;">
                        </div>

                        <input type="hidden" name="cropped_image" id="croppedImage" value="">
                        
                        <div class="form-check mb-3">
                            <input type="checkbox" name="is_active" class="form-check-input" checked>
                            <label class="form-check-label">Active</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="saveCroppedImage()">
                            Save Cropped Image
                        </button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
let croppers = {};

function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const imagePreview = document.getElementById('imagePreview');
            const imageToCrop = document.getElementById('imageToCrop');
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
                responsive: true,
                restore: false,
                guides: true,
                center: true,
                highlight: false,
                cropBoxMovable: true,
                cropBoxResizable: true,
                toggleDragModeOnDblclick: false,
            });
        };
        reader.readAsDataURL(file);
    }
}

function previewImageEdit(event, id) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const imagePreview = document.getElementById('imagePreview' + id);
            const imageToCrop = document.getElementById('imageToCrop' + id);
            const cropContainer = document.querySelector('.crop-container-' + id);

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
                responsive: true,
                restore: false,
                guides: true,
                center: true,
                highlight: false,
                cropBoxMovable: true,
                cropBoxResizable: true,
                toggleDragModeOnDblclick: false,
            });
        };
        reader.readAsDataURL(file);
    }
}

function saveCroppedImage() {
    if (croppers['create']) {
        const canvas = croppers['create'].getCroppedCanvas({
            width: 1024,    
            height: 576,    
            imageSmoothingEnabled: true,
            imageSmoothingQuality: 'high',
        });
        
        if (canvas) {
            const croppedImage = canvas.toDataURL('image/jpeg', 0.9);
            document.getElementById('croppedImage').value = croppedImage;

            const imagePreview = document.getElementById('imagePreview');
            imagePreview.src = croppedImage;

            alert('Cropped image has been saved. You can now submit the form.');
        }
    }
}

function saveCroppedImageEdit(id) {
    if (croppers[id]) {
        const canvas = croppers[id].getCroppedCanvas({
            width: 1024,  
            height: 576,  
            imageSmoothingEnabled: true,
            imageSmoothingQuality: 'high',
        });
        
        if (canvas) {
            const croppedImage = canvas.toDataURL('image/jpeg', 0.9);
            document.getElementById('croppedImage' + id).value = croppedImage;

            const imagePreview = document.getElementById('imagePreview' + id);
            imagePreview.src = croppedImage;
        
            alert('Cropped image has been saved. You can now update the form.');
        }
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const createModal = document.getElementById('createModal');
    createModal.addEventListener('hidden.bs.modal', function() {
        if (croppers['create']) {
            croppers['create'].destroy();
            delete croppers['create'];
        }
    });

    const editModals = document.querySelectorAll('[id^="editModal"]');
    editModals.forEach(modal => {
        modal.addEventListener('hidden.bs.modal', function() {
            const id = modal.id.replace('editModal', '');
            if (croppers[id]) {
                croppers[id].destroy();
                delete croppers[id];
            }
        });
    });
});
</script>
@endsection


