@extends('backend.layouts.master')

@section('content')
<div class="card mt-3">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>MOU</h5>
        <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
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
                        <th>State</th>
                        <th>District</th>
                        <th>Local</th>
                        <th>University</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mous as $index => $mou)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $mou->state }}</td>
                        <td>{{ $mou->district }}</td>
                        <td>{{ $mou->local }}</td>
                        <td>{{ $mou->university }}</td>
                        <td>
                            @if($mou->image)
                                <img src="{{ asset($mou->image) }}" alt="Image" width="50">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>
                        <td>
                            <button class="btn {{ $mou->is_featured ? 'btn-success' : 'btn-danger' }} btn-sm" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#featuredModal{{ $mou->id }}">
                                {{ $mou->is_featured ? 'Featured' : 'Unfeatured' }}
                            </button>
                        </td>
                        <td>
                            <button class="btn {{ $mou->is_active ? 'btn-success' : 'btn-danger' }} btn-sm"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#statusModal{{ $mou->id }}">
                                {{ $mou->is_active ? 'Active' : 'Inactive' }}
                            </button>
                        </td>
                        <td>
                            <!-- Edit Button -->
                            <button class="btn btn-outline-primary btn-sm edit-btn" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editModal{{ $mou->id }}"
                                    style="width: 33px; text-align: center; font-size: 15px;">
                                <i class="fas fa-edit"></i>
                            </button>

                            <!-- Other images Button -->
                            <button class="btn btn-outline-success btn-sm" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#addImagesModal{{ $mou->id }}"
                                    style="width: 33px; text-align: center; font-size: 15px;">
                                <i class="fas fa-images"></i>
                            </button>

                            <!-- Delete Button -->
                            <button class="btn btn-outline-danger btn-sm" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteModal{{ $mou->id }}"
                                    style="width: 30px; text-align: center; font-size: 15px;">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>

                    <!-- Featured Status Modal -->
                    <div class="modal fade" id="featuredModal{{ $mou->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <form method="POST" action="{{ route('admin.mous.toggle-featured', $mou->id) }}">
                                @csrf
                                @method('PATCH')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Change Featured Status</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Do you want to {{ $mou->is_featured ? 'remove' : 'set' }} this MOU as featured?</p>
                                        <p><strong>Current status:</strong> {{ $mou->is_featured ? 'Featured' : 'Not Featured' }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn {{ $mou->is_featured ? 'btn-danger' : 'btn-success' }}">
                                            {{ $mou->is_featured ? 'Remove from Featured' : 'Set as Featured' }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Active Status Modal -->
                    <div class="modal fade" id="statusModal{{ $mou->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <form method="POST" action="{{ route('admin.mous.toggle-status', $mou->id) }}">
                                @csrf
                                @method('PATCH')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Change Status</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Do you want to {{ $mou->is_active ? 'deactivate' : 'activate' }} this MOU?</p>
                                        <p><strong>Current status:</strong> {{ $mou->is_active ? 'Active' : 'Inactive' }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn {{ $mou->is_active ? 'btn-danger' : 'btn-success' }}">
                                            {{ $mou->is_active ? 'Deactivate' : 'Activate' }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal fade" id="addImagesModal{{ $mou->id }}" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <form method="POST" action="{{ route('admin.mous.add-images', $mou->id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add Additional Images</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                    
                                        <!-- Show Already Added Images -->
                                        @php
                                            $existingImages = json_decode($mou->other_images, true) ?? [];
                                        @endphp
                    
                                        @if(!empty($existingImages))
                                            <div class="mb-4">
                                                <h6>Current Additional Images</h6>
                                                <div class="row">
                                                    @foreach($existingImages as $index => $image)
                                                        <div class="col-md-4 mb-3" id="image-container-{{ $index }}">
                                                            <div class="position-relative">
                                                                <img src="{{ asset($image) }}" class="img-thumbnail" alt="Additional Image {{ $index + 1 }}">
                                                                <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2"
                                                                        onclick="deleteImage('{{ $mou->id }}', {{ $index }})">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                    
                                        <!-- Upload New Images -->
                                        <div class="mb-3">
                                            <label class="form-label">Upload New Images</label>
                                            <input type="file" name="images[]" class="form-control" multiple accept="image/*" id="imageInput{{ $mou->id }}">
                                            <small class="text-muted">You can select multiple images. Maximum size: 2MB per image</small>
                                        </div>
                    
                                        <!-- Preview Container for Newly Selected Images -->
                                        <div id="previewContainer{{ $mou->id }}" class="mb-3"></div>
                    
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Upload</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal{{ $mou->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $mou->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel{{ $mou->id }}">Confirm Delete</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this record? This action cannot be undone.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <form action="{{ route('admin.mous.destroy', $mou->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{ $mou->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form method="POST" action="{{ route('admin.mous.update', $mou->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel">Edit MOU</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- State, District, and Local Fields in the Same Row -->
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="state{{ $mou->id }}" class="form-label">Province</label>
                                                        <select id="state{{ $mou->id }}" name="state" class="form-control" required>
                                                            <option value="">Select Province</option>
                                                            @foreach($provinces as $province)
                                                                <option value="{{ $province->title }}" 
                                                                        data-id="{{ $province->id }}"
                                                                        {{ $mou->state == $province->title ? 'selected' : '' }}>
                                                                    {{ $province->title }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="district{{ $mou->id }}" class="form-label">District</label>
                                                        <select id="district{{ $mou->id }}" name="district" class="form-control" required 
                                                            data-current="{{ $mou->district }}">
                                                        <option value="">Select District</option>
                                                    </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="local{{ $mou->id }}" class="form-label">Local Government</label>
                                                        <select id="local{{ $mou->id }}" name="local" class="form-control" required 
                                                            data-current="{{ $mou->local }}">
                                                        <option value="">Select Local Government</option>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                    
                                            <!-- University Field -->
                                            <div class="mb-3">
                                                <label for="university{{ $mou->id }}" class="form-label">University</label>
                                                <input type="text" id="university{{ $mou->id }}" name="university" class="form-control" value="{{ old('university', $mou->university) }}" required>
                                            </div>
                    
                                            <!-- Description Field -->
                                            <div class="mb-3">
                                                <label for="description{{ $mou->id }}" class="form-label">Description</label>
                                                <textarea id="description{{ $mou->id }}" name="description" class="form-control" rows="4" required>{{ old('description', $mou->description) }}</textarea>
                                            </div>
                    
                                            <!-- Image Upload -->
                                            <div class="mb-3">
                                                <label for="image{{ $mou->id }}" class="form-label">Image</label>
                                                <div class="preview-container-{{ $mou->id }}">
                                                    @if($mou->image)
                                                        <img src="{{ asset($mou->image) }}" alt="Current Image" 
                                                             id="imagePreview{{ $mou->id }}" style="max-width: 200px;">
                                                    @endif
                                                </div>
                                                <input type="file" id="image{{ $mou->id }}" name="image" class="form-control" onchange="previewImageEdit(event, {{ $mou->id }})">
                                            </div>
                    
                                            <!-- Cropper Container -->
                                            <div class="mb-3">
                                                <div class="crop-container-{{ $mou->id }}" style="display: none;">
                                                    <img id="imageToCrop{{ $mou->id }}" src="#" style="max-width: 100%;">
                                                </div>
                                            </div>
                                            <input type="hidden" name="cropped_image" id="croppedImage{{ $mou->id }}" value="">
                    
                                            <div class="mb-3 form-check">
                                                <input type="checkbox" id="is_featured{{ $mou->id }}" name="is_featured" class="form-check-input" 
                                                       {{ old('is_featured', $mou->is_featured) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="is_featured{{ $mou->id }}">Featured</label>
                                            </div>
                                            
                                            <!-- Active Checkbox -->
                                            <div class="mb-3 form-check">
                                                <input type="checkbox" id="is_active{{ $mou->id }}" name="is_active" class="form-check-input" 
                                                       {{ old('is_active', $mou->is_active) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="is_active{{ $mou->id }}">Active</label>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" onclick="saveCroppedImageEdit({{ $mou->id }})">
                                                Save Cropped Image
                                            </button>
                                            <button type="submit" class="btn btn-success" id="editSubmitBtn{{ $mou->id }}" style="display: none;">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    @endforeach
                    <!-- Create Modal -->
                    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form method="POST" action="{{ route('admin.mous.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="createModalLabel">Create New MOU</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- State, District, and Local Fields in One Row -->
                                            <div class="row">
                                            <!-- State/Province Field -->
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="state" class="form-label">Province</label>
                                                        <select id="state" name="state" class="form-control" required>
                                                            <option value="">Select Province</option>
                                                            @foreach($provinces as $province)
                                                                <option value="{{ $province->title }}" data-id="{{ $province->id }}">
                                                                    {{ $province->title }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- District Field -->
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="district" class="form-label">District</label>
                                                        <select id="district" name="district" class="form-control" required disabled>
                                                            <option value="">Select District</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Local Field -->
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="local" class="form-label">Local Government</label>
                                                        <select id="local" name="local" class="form-control" required disabled>
                                                            <option value="">Select Local Government</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- University Field -->
                                            <div class="mb-3">
                                                <label for="university" class="form-label">University</label>
                                                <input type="text" id="university" name="university" class="form-control" required>
                                            </div>

                                            <!-- Description Field -->
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea id="description" name="description" class="form-control" rows="4" required></textarea>
                                            </div>

                                            <!-- Image Upload -->
                                            <div class="mb-3">
                                                <label for="image" class="form-label">Image</label>
                                                <div id="imagePreviewContainer">
                                                    <img id="imagePreview" src="#" alt="Selected Image" style="max-width: 200px; display: none;">
                                                </div>
                                                <input type="file" id="image" name="image" class="form-control" onchange="previewImage(event)">
                                            </div>

                                            <div class="mb-3">
                                                <img id="imageToCrop" src="#" style="max-width: 100%; display: none;">
                                            </div>

                                            <input type="hidden" name="cropped_image" id="croppedImage" value="">

                                            <div class="mb-3 form-check">
                                                <input type="checkbox" id="is_featured" name="is_featured" class="form-check-input"
                                                    {{ old('is_featured') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="is_featured">Featured</label>
                                            </div>

                                            <!-- Active Checkbox -->
                                            <div class="mb-3 form-check">
                                                <input type="checkbox" id="is_active" name="is_active" class="form-check-input"
                                                    {{ old('is_active', true) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="is_active">Active</label>
                                            </div>
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
            document.getElementById('createSubmitBtn').style.display = 'block';
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
            document.getElementById('editSubmitBtn' + id).style.display = 'block';
            alert('Cropped image has been saved. You can now update the form.');
        }
    }
}

    function deleteImage(mouId, index) {
        if (confirm('Are you sure you want to delete this image?')) {
            fetch(`/admin/mous/${mouId}/delete-image/${index}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById(`image-container-${index}`).remove();
                } else {
                    alert('Failed to delete image: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to delete image');
            });
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
 document.addEventListener('DOMContentLoaded', function() {
    const districts = @json($districts);
    const locals = @json($locals);

    function setupDropdowns(isEdit = false, mouId = '') {
        const stateSelect = document.getElementById(isEdit ? `state${mouId}` : 'state');
        const districtSelect = document.getElementById(isEdit ? `district${mouId}` : 'district');
        const localSelect = document.getElementById(isEdit ? `local${mouId}` : 'local');

        if (!stateSelect || !districtSelect || !localSelect) return;

        function toggleDropdown(element, enabled) {
            element.disabled = !enabled;
            if (!enabled) {
                element.innerHTML = '<option value="">Select Option</option>';
            }
        }

        function populateDistricts() {
            const selectedProvinceId = stateSelect.options[stateSelect.selectedIndex].dataset.id;
            const filteredDistricts = districts.filter(d => d.province_id == selectedProvinceId);
            
            toggleDropdown(districtSelect, true);
            toggleDropdown(localSelect, false);

            let options = '<option value="">Select District</option>';
            filteredDistricts.forEach(district => {
                options += `<option value="${district.title}" data-id="${district.id}">${district.title}</option>`;
            });
            districtSelect.innerHTML = options;

            const currentDistrict = districtSelect.getAttribute('data-current');
            if (currentDistrict) {
                Array.from(districtSelect.options).forEach(option => {
                    if (option.value === currentDistrict) {
                        option.selected = true;
                        populateLocals(); 
                    }
                });
            }
        }

        function populateLocals() {
            const selectedDistrictId = districtSelect.options[districtSelect.selectedIndex].dataset.id;
            const filteredLocals = locals.filter(l => l.district_id == selectedDistrictId);
            
            toggleDropdown(localSelect, true);

            let options = '<option value="">Select Local Government</option>';
            filteredLocals.forEach(local => {
                options += `<option value="${local.title}">${local.title}</option>`;
            });
            localSelect.innerHTML = options;

            const currentLocal = localSelect.getAttribute('data-current');
            if (currentLocal) {
                Array.from(localSelect.options).forEach(option => {
                    if (option.value === currentLocal) {
                        option.selected = true;
                    }
                });
            }
        }

        toggleDropdown(districtSelect, !stateSelect.value);
        toggleDropdown(localSelect, false);

        stateSelect.addEventListener('change', populateDistricts);
        districtSelect.addEventListener('change', populateLocals);

        if (isEdit && stateSelect.value) {
            populateDistricts();
        }
    }

    setupDropdowns();

    document.querySelectorAll('[id^="editModal"]').forEach(modal => {
        const mouId = modal.id.replace('editModal', '');
        modal.addEventListener('shown.bs.modal', function() {
            setupDropdowns(true, mouId);
        });
    });
});
// Add this function to handle multiple image preview
function handleMultipleImages(event, mouId) {
    const input = event.target;
    const previewContainer = document.querySelector(`#previewContainer${mouId}`);
    const files = input.files;

    // Clear existing previews for new selections
    previewContainer.innerHTML = '';

    if (files) {
        Array.from(files).forEach((file, index) => {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                const previewWrapper = document.createElement('div');
                previewWrapper.className = 'position-relative d-inline-block me-2 mb-2';
                previewWrapper.id = `preview-wrapper-${mouId}-${index}`;
                
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'img-thumbnail';
                img.style.height = '100px';
                img.style.width = 'auto';
                
                const removeButton = document.createElement('button');
                removeButton.type = 'button';
                removeButton.className = 'btn btn-danger btn-sm position-absolute top-0 end-0 m-1';
                removeButton.innerHTML = '<i class="fas fa-times"></i>';
                removeButton.onclick = function() {
                    removeSelectedImage(mouId, index, input);
                };
                
                previewWrapper.appendChild(img);
                previewWrapper.appendChild(removeButton);
                previewContainer.appendChild(previewWrapper);
            };
            
            reader.readAsDataURL(file);
        });
    }
}

document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll("[id^=imageInput]").forEach(input => {
        input.addEventListener("change", function(event) {
            let previewContainer = document.getElementById("previewContainer" + this.id.replace("imageInput", ""));
            previewContainer.innerHTML = "";

            Array.from(event.target.files).forEach(file => {
                if (file.type.startsWith("image/")) {
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        let img = document.createElement("img");
                        img.src = e.target.result;
                        img.classList.add("img-thumbnail", "me-2", "mb-2");
                        img.style.maxWidth = "100px";
                        previewContainer.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    });
});


// Function to remove selected image
function removeSelectedImage(mouId, index, input) {
    const previewWrapper = document.getElementById(`preview-wrapper-${mouId}-${index}`);
    previewWrapper.remove();
    
    // Create a new FileList without the removed image
    const dt = new DataTransfer();
    const { files } = input;
    
    for (let i = 0; i < files.length; i++) {
        if (i !== index) {
            dt.items.add(files[i]);
        }
    }
    
    input.files = dt.files;
}

// Function to initialize preview containers for all MOUs
function initializeImagePreviews() {
    document.querySelectorAll('[id^="addImagesModal"]').forEach(modal => {
        const mouId = modal.id.replace('addImagesModal', '');
        const imageInput = modal.querySelector('input[type="file"]');
        const modalBody = modal.querySelector('.modal-body');
        
        // Create preview container if it doesn't exist
        if (!modalBody.querySelector(`#previewContainer${mouId}`)) {
            const previewContainer = document.createElement('div');
            previewContainer.id = `previewContainer${mouId}`;
            previewContainer.className = 'mb-3';
            modalBody.insertBefore(previewContainer, imageInput.parentElement.nextSibling);
        }
        
        // Add event listener for file input
        imageInput.addEventListener('change', (event) => handleMultipleImages(event, mouId));
    });
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', initializeImagePreviews);
</script>
@endsection