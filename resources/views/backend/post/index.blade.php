@extends('backend.layouts.master')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Posts</h4>
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
                        <th>Title (NE)</th>
                        <th>Title (EN)</th>
                        <th>Category</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $index => $post)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $post->title_ne }}</td>
                            <td>{{ $post->title_en }}</td>
                            <td>{{ $post->category->title_en }}</td>
                            <td> 
                                 @if($post->image)
                                <img src="{{ asset($post->image) }}" alt="Image" width="50">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>
                            <td>
                                <span class="badge {{ $post->is_featured ? 'bg-success' : 'bg-danger' }}">
                                    {{ $post->is_featured ? 'Yes' : 'No' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge {{ $post->is_active ? 'bg-success' : 'bg-danger' }}">
                                    {{ $post->is_active ? 'Yes' : 'No' }}
                                </span>
                            </td>
                            <td>
                                <!-- Edit Button -->
                                <button class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $post->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <!-- Delete Button -->
                                <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $post->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal{{ $post->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form method="POST" action="{{ route('admin.posts.update', $post->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel">Edit Post</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Title NE Field -->
                                            <div class="mb-3">
                                                <label for="title_ne" class="form-label">Title (NE)</label>
                                                <textarea id="title_ne" name="title_ne" class="form-control" required>{{ old('title_ne', $post->title_ne) }}</textarea>
                                            </div>
                                            
                                            <!-- Title EN Field -->
                                            <div class="mb-3">
                                                <label for="title_en" class="form-label">Title (EN)</label>
                                                <textarea id="title_en" name="title_en" class="form-control" required>{{ old('title_en', $post->title_en) }}</textarea>
                                            </div>

                                            <!-- Description NE Field -->
                                            <div class="mb-3">
                                                <label for="description_ne" class="form-label">Description (NE) (Optional)</label>
                                                <textarea id="description_ne" name="description_ne" class="form-control">{{ old('description_ne', $post->description_ne) }}</textarea>
                                            </div>

                                            <!-- Description EN Field -->
                                            <div class="mb-3">
                                                <label for="description_en" class="form-label">Description (EN) (Optional)</label>
                                                <textarea id="description_en" name="description_en" class="form-control">{{ old('description_en', $post->description_en) }}</textarea>
                                            </div>

                                            <!-- Category Selection -->
                                            <div class="mb-3">
                                                <label for="category_id" class="form-label">Category</label>
                                                <select id="category_id" name="category_id" class="form-select" required>
                                                    <option value="">Select Category</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}" {{ $category->id == $post->category_id ? 'selected' : '' }}>
                                                            {{ $category->title_en }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Image Upload -->
                                            <div class="mb-3">
                                                <label for="image" class="form-label">Image</label>
                                                <div class="preview-container-{{ $post->id }}">
                                                    @if($post->image)
                                                        <img src="{{ asset($post->image) }}" alt="Current Image" 
                                                             id="imagePreview{{ $post->id }}" style="max-width: 200px;">
                                                    @endif
                                                </div>
                                                <input type="file" name="image" class="form-control" 
                                                       onchange="previewImageEdit(event, {{ $post->id }})">
                                            </div>
                                            
                                            <div class="mb-3">
                                                <div class="crop-container-{{ $post->id }}" style="display: none;">
                                                    <img id="imageToCrop{{ $post->id }}" src="#" style="max-width: 100%;">
                                                </div>
                                            </div>
                                            
                                            <input type="hidden" name="cropped_image" id="croppedImage{{ $post->id }}" value="">
                                            
                                            <!-- Add Save Cropped Image button before the form submit button -->
                                            <button type="button" class="btn btn-primary" 
                                                    onclick="saveCroppedImageEdit({{ $post->id }})">
                                                Save Cropped Image
                                            </button>

                                            <!-- PDF Upload -->
                                            <div class="mb-3">
                                                <label for="pdf" class="form-label">PDF (Optional)</label>
                                                <input type="file" id="pdf" name="pdf[]" class="form-control" multiple>
                                                @if($post->pdf)
                                                    <div class="mt-2">
                                                        <p>Existing PDF(s):</p>
                                                        @foreach($post->pdf as $pdf)
                                                            <a href="{{ asset('storage/' . $pdf) }}" target="_blank">{{ basename($pdf) }}</a><br>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Featured Checkbox -->
                                            <div class="mb-3 form-check">
                                                <input type="hidden" name="is_featured" value="0">
                                                <input type="checkbox" id="is_featured" name="is_featured" value="1" class="form-check-input" {{ $post->is_featured ? 'checked' : '' }}>
                                                <label class="form-check-label" for="is_featured">Featured</label>
                                            </div>

                                            <!-- Active Checkbox -->
                                            <div class="mb-3 form-check">
                                                <input type="hidden" name="is_active" value="0">
                                                <input type="checkbox" id="is_active" name="is_active" value="1" class="form-check-input" {{ $post->is_active ? 'checked' : '' }}>
                                                <label class="form-check-label" for="is_active">Active</label>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Update Post</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>


                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal{{ $post->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form method="POST" action="{{ route('admin.posts.destroy', $post->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Delete Post</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete this post?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger">Delete</button>
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
                    @if ($posts->onFirstPage())
                        <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $posts->previousPageUrl() }}" rel="prev">&laquo;</a></li>
                    @endif

                    @foreach ($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
                        @if ($page == $posts->currentPage())
                            <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach

                    @if ($posts->hasMorePages())
                        <li class="page-item"><a class="page-link" href="{{ $posts->nextPageUrl() }}" rel="next">&raquo;</a></li>
                    @else
                        <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Create New Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title_ne" class="form-label">Title (NE)</label>
                        <textarea id="title_ne" name="title_ne" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="title_en" class="form-label">Title (EN)</label>
                        <textarea id="title_en" name="title_en" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="description_ne" class="form-label">Description (NE) (Optional)</label>
                        <textarea id="description_ne" name="description_ne" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="description_en" class="form-label">Description (EN) (Optional)</label>
                        <textarea id="description_en" name="description_en" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select id="category_id" name="category_id" class="form-select" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                @if($category->is_active)
                                    <option value="{{ $category->id }}">
                                        {{ $category->title_en }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>              
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
                    
                    <!-- Add Save Cropped Image button before the form submit button -->
                    <button type="button" class="btn btn-primary" onclick="saveCroppedImage()">
                        Save Cropped Image
                    </button>
                    <div class="mb-3">
                        <label for="pdf" class="form-label">PDF (Optional)</label>
                        <input type="file" id="pdf" name="pdf[]" class="form-control" multiple>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="hidden" name="is_featured" value="0">
                        <input type="checkbox" id="is_featured" name="is_featured" value="1" class="form-check-input">
                        <label class="form-check-label" for="is_featured">Featured</label>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" id="is_active" name="is_active" value="1" class="form-check-input" checked>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create Post</button>
                </div>
            </div>
        </form>
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
