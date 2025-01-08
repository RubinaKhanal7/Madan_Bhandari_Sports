@extends('backend.layouts.master')


@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Categories</h5>
            <button type="button" 
            class="btn btn-outline-primary btn-sm" 
            data-bs-toggle="modal" 
            data-bs-target="#createModal">
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
                        <th>SN</th>
                        <th>Title (EN)</th>
                        <th>Title (NE)</th>
                        <th>Image</th>
                        <th>Status</th>
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
                                <!-- Button to toggle status -->
                                <button class="btn {{ $category->is_active ? 'btn-success' : 'btn-danger' }} btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#statusModal{{ $category->id }}">
                                    {{ $category->is_active ? 'Active' : 'Inactive' }}
                                </button>
                            </td>
                            
                            <td>
                                <button class="btn btn-outline-info btn-sm" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#metadataModal{{ $category->id }}" 
                                        style="width: 32px; text-align: center; font-size: 15px;">
                                    <span>M</span>
                                </button>
                        
                                <button class="btn btn-outline-primary btn-sm edit-btn" data-bs-toggle="modal" 
                                        data-bs-target="#editModal{{ $category->id }}" style="width: 32px;">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" 
                                        data-bs-target="#deleteModal{{ $category->id }}" style="width: 32px;">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>

                        
                        <!-- Modal for changing status -->
                        <div class="modal fade" id="statusModal{{ $category->id }}" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
                         <div class="modal-dialog">
                         <form method="POST" action="{{ route('admin.categories.updateStatus', $category->id) }}">
                            @csrf
                          @method('PUT')
                         <div class="modal-content">
                          <div class="modal-header">
                          <h5 class="modal-title" id="statusModalLabel">Change Status</h5>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                       <div class="modal-body">
                    <!-- Message based on current status -->
                    <p>
                        Do you want to 
                        <strong>{{ $category->is_active ? 'deactivate' : 'activate' }}</strong> 
                        this category?
                    </p>
                    <p>
                        <strong>Current Status:</strong> 
                        {{ $category->is_active ? 'Active' : 'Inactive' }}
                    </p>
                    <!-- Hidden input to toggle the status -->
                    <input type="hidden" name="is_active" value="{{ $category->is_active ? 0 : 1 }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <!-- Button changes dynamically -->
                    <button type="submit" class="btn {{ $category->is_active ? 'btn-danger' : 'btn-success' }}">
                        {{ $category->is_active ? 'Deactivate' : 'Activate' }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal{{ $category->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                <form method="POST" action="{{ route('admin.categories.update', $category->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Category</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <!-- Title (EN) -->
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Title (EN)</label>
                                                    <input type="text" name="title_en" class="form-control" value="{{ $category->title_en }}" required>
                                                </div>
                        
                                                <!-- Title (NE) -->
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Title (NE)</label>
                                                    <input type="text" name="title_ne" class="form-control" value="{{ $category->title_ne }}" required>
                                                </div>
                                            </div>
                        
                                            <div class="row">
                                                <!-- Description (EN) -->
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Description (EN)</label>
                                                    <textarea name="description_en" class="form-control">{{ $category->description_en }}</textarea>
                                                </div>
                        
                                                <!-- Description (NE) -->
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Description (NE)</label>
                                                    <textarea name="description_ne" class="form-control">{{ $category->description_ne }}</textarea>
                                                </div>
                                            </div>
                        
                                            <!-- Image Upload -->
                                            <div class="mb-3">
                                                <label class="form-label">Image</label>
                                                <div class="preview-container-{{ $category->id }}">
                                                    @if($category->image)
                                                        <img src="{{ asset($category->image) }}" alt="Current Image" 
                                                             id="imagePreview{{ $category->id }}" style="max-width: 200px; margin-bottom: 10px;">
                                                    @endif
                                                </div>
                                                <input type="file" name="image" class="form-control" onchange="previewImageEdit(event, {{ $category->id }})">
                                            </div>
                        
                                            <!-- Container for Cropper -->
                                            <div class="mb-3">
                                                <div class="crop-container-{{ $category->id }}" style="display: none;">
                                                    <img id="imageToCrop{{ $category->id }}" src="#" style="max-width: 100%;">
                                                </div>
                                            </div>
                        
                                            <input type="hidden" name="cropped_image" id="croppedImage{{ $category->id }}" value="">
                        
                                            <!-- Active Checkbox -->
                                            <div class="form-check mb-3">
                                                <input type="checkbox" name="is_active" class="form-check-input" {{ $category->is_active ? 'checked' : '' }}>
                                                <label class="form-check-label">Active</label>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" onclick="saveCroppedImageEdit({{ $category->id }})">
                                                Save Cropped Image
                                            </button>
                                            <button type="submit" class="btn btn-success">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                        

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal{{ $category->id }}" tabindex="-1">
                            <div class="modal-dialog ">
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
                        <!-- Metadata Modal -->
                            <div class="modal fade" id="metadataModal{{ $category->id }}" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form method="POST" 
                                        action="{{ $category->metadata ? route('admin.categories.metadata.update', $category->id) : route('admin.categories.metadata.store', $category->id) }}">
                                        @csrf
                                        @if($category->metadata)
                                            @method('PUT')
                                        @endif
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">{{ $category->metadata ? 'Edit' : 'Add' }} Metadata</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Meta Title</label>
                                                    <input type="text" name="metaTitle" class="form-control" 
                                                        value="{{ old('metaTitle', $category->metadata?->metaTitle) }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Meta Description</label>
                                                    <textarea name="metaDescription" class="form-control" rows="3">{{ old('metaDescription', $category->metadata?->metaDescription) }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Meta Keywords</label>
                                                    <textarea name="metaKeywords" class="form-control" rows="2">{{ old('metaKeywords', $category->metadata?->metaKeywords) }}</textarea>
                                                    <small class="text-muted">Separate keywords with commas</small>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success">{{ $category->metadata ? 'Update' : 'Save' }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                    @endforeach
                </tbody>
            </table>
                      <!-- Pagination -->
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        @if ($categories->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $categories->previousPageUrl() }}" rel="prev">&laquo;</a></li>
                        @endif

                        @foreach ($categories->getUrlRange(1, $categories->lastPage()) as $page => $url)
                            @if ($page == $categories->currentPage())
                                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach

                        @if ($categories->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $categories->nextPageUrl() }}" rel="next">&raquo;</a></li>
                        @else
                            <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                        @endif
                    </ul>
                </nav>
        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
            <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <!-- Title (EN) -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Title (EN)</label>
                                <input type="text" name="title_en" class="form-control" required>
                            </div>
    
                            <!-- Title (NE) -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Title (NE)</label>
                                <input type="text" name="title_ne" class="form-control" required>
                            </div>
                        </div>
    
                        <div class="row">
                            <!-- Description (EN) -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Description (EN) (Optional)</label>
                                <textarea name="description_en" class="form-control"></textarea>
                            </div>
    
                            <!-- Description (NE) -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Description (NE) (Optional)</label>
                                <textarea name="description_ne" class="form-control"></textarea>
                            </div>
                        </div>
    
                        <div class="mb-3">
                            <label class="form-label">Image (Optional)</label>
                            <div id="imagePreviewContainer">
                                <img id="imagePreview" src="#" alt="Selected Image" style="max-width: 200px; display: none;">
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
                        <button type="button" class="btn btn-primary" onclick="saveCroppedImage()">Save Cropped Image</button>
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
<script>
    function populateMetadata(categoryId) {
        const titleEn = document.querySelector(`#editModal${categoryId} input[name="title_en"]`).value;
        const descriptionEn = document.querySelector(`#editModal${categoryId} textarea[name="description_en"]`)?.value || '';
        
        const metadataModal = document.querySelector(`#metadataModal${categoryId}`);
        const metaTitleInput = metadataModal.querySelector('input[name="metaTitle"]');
        const metaDescriptionTextarea = metadataModal.querySelector('textarea[name="metaDescription"]');

        if (!metaTitleInput.value) {
            metaTitleInput.value = titleEn;
        }
        
        if (!metaDescriptionTextarea.value) {
            metaDescriptionTextarea.value = descriptionEn;
        }
    }

    document.addEventListener('DOMContentLoaded', function() {

        document.querySelectorAll('[data-bs-target^="#metadataModal"]').forEach(button => {
            button.addEventListener('click', function() {
                const categoryId = this.getAttribute('data-bs-target').replace('#metadataModal', '');
                populateMetadata(categoryId);
            });
        });
    });
    </script>
@endsection


