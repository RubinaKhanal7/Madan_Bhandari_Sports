@extends('backend.layouts.master')

@section('content')
<ddiv class="card mt-3">
    <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Posts</h5>
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
                        <th>Title (NE)</th>
                        <th>Title (EN)</th>
                        <th>Category</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Status</th>
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
                            <button class="btn {{ $post->is_featured ? 'btn-success' : 'btn-danger' }} btn-sm" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#featuredModal{{ $post->id }}">
                                {{ $post->is_featured ? 'Featured' : 'Unfeatured' }}
                            </button>
                        </td>
                        <td>
                            <button class="btn {{ $post->is_active ? 'btn-success' : 'btn-danger' }} btn-sm"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#statusModal{{ $post->id }}">
                                {{ $post->is_active ? 'Active' : 'Inactive' }}
                            </button>
                        </td>
                            <td>
                                <button class="btn btn-outline-info btn-sm" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#metadataModal{{ $post->id }}" 
                                        style="width: 33px; text-align: center; font-size: 15px;">
                                    <span>M</span>
                                </button>

                                <!-- Edit Button -->
                                <button class="btn btn-outline-primary btn-sm edit-btn" data-bs-toggle="modal" data-bs-target="#editModal{{ $post->id }}" style="width: 33px; text-align: center; font-size: 15px;">
                                    <i class="fas fa-edit"></i>
                                </button>

                                 <!-- Other images Button -->

                                 <button class="btn btn-outline-success btn-sm" 
                                 data-bs-toggle="modal" 
                                 data-bs-target="#addImagesModal{{ $post->id }}"
                                 style="width: 33px; text-align: center; font-size: 15px;">
                                 <i class="fas fa-images"></i>
                             </button>

                            <button class="btn btn-outline-info btn-sm" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#showModal{{ $post->id }}"
                                        style="width: 33px; text-align: center; font-size: 15px;">
                                    <i class="fas fa-eye"></i>
                            </button>

                                <!-- Delete Button -->
                                <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $post->id }}"  style="width: 30px; text-align: center; font-size: 15px;">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Featured Status Modal -->
                        <div class="modal fade" id="featuredModal{{ $post->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <form method="POST" action="{{ route('admin.posts.toggle-featured', $post->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Change Featured Status</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Do you want to {{ $post->is_featured ? 'remove' : 'set' }} this post as featured?</p>
                                            <p><strong>Current status:</strong> {{ $post->is_featured ? 'Featured' : 'Not Featured' }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn {{ $post->is_featured ? 'btn-danger' : 'btn-success' }}">
                                                {{ $post->is_featured ? 'Remove from Featured' : 'Set as Featured' }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Active Status Modal -->
                        <div class="modal fade" id="statusModal{{ $post->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <form method="POST" action="{{ route('admin.posts.toggle-status', $post->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Change Status</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Do you want to {{ $post->is_active ? 'deactivate' : 'activate' }} this post?</p>
                                            <p><strong>Current status:</strong> {{ $post->is_active ? 'Active' : 'Inactive' }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn {{ $post->is_active ? 'btn-danger' : 'btn-success' }}">
                                                {{ $post->is_active ? 'Deactivate' : 'Activate' }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Other Images Modal -->
                        <div class="modal fade" id="addImagesModal{{ $post->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <form method="POST" 
                                    action="{{ route('admin.posts.add-images', $post->id) }}" 
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Add Additional Images</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Current Images -->
                                            @if($post->other_images && count($post->other_images) > 0)
                                                <div class="mb-4">
                                                    <h6>Current Additional Images</h6>
                                                    <div class="row">
                                                        @foreach($post->other_images as $index => $image)
                                                            <div class="col-md-4 mb-3" id="image-container-{{ $index }}">
                                                                <div class="position-relative">
                                                                    <img src="{{ asset($image) }}" 
                                                                        class="img-thumbnail" 
                                                                        alt="Additional Image {{ $index + 1 }}">
                                                                    <button type="button" 
                                                                            class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2"
                                                                            onclick="deleteImage('{{ $post->id }}', {{ $index }})">
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
                                                <input type="file" 
                                                    name="images[]" 
                                                    class="form-control" 
                                                    multiple 
                                                    accept="image/*"
                                                    required>
                                                <small class="text-muted">You can select multiple images. Maximum size: 2MB per image</small>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Upload </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Show Modal -->
                        <div class="modal fade" id="showModal{{ $post->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Post Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <!-- English Content -->
                                            <div class="col-md-6">
                                                <h6 class="fw-bold">English Content</h6>
                                                <hr>
                                                <div class="mb-3">
                                                    <label class="fw-bold">Title:</label>
                                                    <p>{{ $post->title_en }}</p>
                                                </div>
                                                @if($post->description_en)
                                                <div class="mb-3">
                                                    <label class="fw-bold">Description:</label>
                                                    <p>{{ $post->description_en }}</p>
                                                </div>
                                                @endif
                                            </div>

                                            <!-- Nepali Content -->
                                            <div class="col-md-6">
                                                <h6 class="fw-bold">Nepali Content</h6>
                                                <hr>
                                                <div class="mb-3">
                                                    <label class="fw-bold">Title:</label>
                                                    <p>{{ $post->title_ne }}</p>
                                                </div>
                                                @if($post->description_ne)
                                                <div class="mb-3">
                                                    <label class="fw-bold">Description:</label>
                                                    <p>{{ $post->description_ne }}</p>
                                                </div>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Category -->
                                        <div class="mb-3">
                                            <label class="fw-bold">Category:</label>
                                            <p>{{ $post->category->title_en }} ({{ $post->category->title_ne }})</p>
                                        </div>

                                        <!-- Featured Image -->
                                        <div class="mb-3">
                                            <label class="fw-bold">Featured Image:</label>
                                            <div>
                                                @if($post->image)
                                                    <img src="{{ asset($post->image) }}" alt="Featured Image" class="img-fluid" style="max-width: 300px;">
                                                @else
                                                    <p class="text-muted">No featured image</p>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Other Images -->
                                        @if($post->other_images && count($post->other_images) > 0)
                                        <div class="mb-3">
                                            <label class="fw-bold">Other Images:</label>
                                            <div class="row">
                                                @foreach($post->other_images as $image)
                                                    <div class="col-md-4 mb-2">
                                                        <img src="{{ asset($image) }}" alt="Additional Image" class="img-fluid">
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endif

                                        <!-- PDF Files -->
                                        @if($post->pdf && count($post->pdf) > 0)
                                        <div class="mb-3">
                                            <label class="fw-bold">PDF Files:</label>
                                            <ul class="list-unstyled">
                                                @foreach($post->pdf as $pdf)
                                                    <li>
                                                        <a href="{{ asset($pdf) }}" target="_blank">
                                                            <i class="fas fa-file-pdf"></i> {{ basename($pdf) }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif

                                        <!-- Metadata -->
                                        @if($post->metadata)
                                        <div class="mb-3">
                                            <h6 class="fw-bold">Metadata</h6>
                                            <hr>
                                            <div class="mb-2">
                                                <label class="fw-bold">Meta Title:</label>
                                                <p>{{ $post->metadata->metaTitle }}</p>
                                            </div>
                                            <div class="mb-2">
                                                <label class="fw-bold">Meta Description:</label>
                                                <p>{{ $post->metadata->metaDescription }}</p>
                                            </div>
                                            <div class="mb-2">
                                                <label class="fw-bold">Meta Keywords:</label>
                                                <p>{{ $post->metadata->metaKeywords }}</p>
                                            </div>
                                        </div>
                                        @endif

                                        <!-- Status Information -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-2">
                                                    <label class="fw-bold">Status:</label>
                                                    <span class="badge bg-{{ $post->is_active ? 'success' : 'danger' }}">
                                                        {{ $post->is_active ? 'Active' : 'Inactive' }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-2">
                                                    <label class="fw-bold">Featured Status:</label>
                                                    <span class="badge bg-{{ $post->is_featured ? 'success' : 'danger' }}">
                                                        {{ $post->is_featured ? 'Featured' : 'Not Featured' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal{{ $post->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                <form method="POST" action="{{ route('admin.posts.update', $post->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel">Edit Post</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Start Row for English and Nepali Fields -->
                                            <div class="row">
                                                <!-- English Fields Column -->
                                                <div class="col-md-6">
                                                    <!-- Title EN Field -->
                                                    <div class="mb-3">
                                                        <label for="title_en" class="form-label">Title (EN)</label>
                                                        <textarea id="title_en" name="title_en" class="form-control" required>{{ old('title_en', $post->title_en) }}</textarea>
                                                    </div>
                        
                                                    <!-- Description EN Field -->
                                                    <div class="mb-3">
                                                        <label for="description_en" class="form-label">Description (EN) (Optional)</label>
                                                        <textarea id="description_en" name="description_en" class="form-control">{{ old('description_en', $post->description_en) }}</textarea>
                                                    </div>
                                                </div>
                        
                                                <!-- Nepali Fields Column -->
                                                <div class="col-md-6">
                                                    <!-- Title NE Field -->
                                                    <div class="mb-3">
                                                        <label for="title_ne" class="form-label">Title (NE)</label>
                                                        <textarea id="title_ne" name="title_ne" class="form-control" required>{{ old('title_ne', $post->title_ne) }}</textarea>
                                                    </div>
                        
                                                    <!-- Description NE Field -->
                                                    <div class="mb-3">
                                                        <label for="description_ne" class="form-label">Description (NE) (Optional)</label>
                                                        <textarea id="description_ne" name="description_ne" class="form-control">{{ old('description_ne', $post->description_ne) }}</textarea>
                                                    </div>
                                                </div>
                                            </div> <!-- End Row -->
                        
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
                                                <input type="file" name="image" class="form-control" onchange="previewImageEdit(event, {{ $post->id }})">
                                            </div>
                        
                                            <div class="mb-3">
                                                <div class="crop-container-{{ $post->id }}" style="display: none;">
                                                    <img id="imageToCrop{{ $post->id }}" src="#" style="max-width: 100%;">
                                                </div>
                                            </div>
                        
                                            <input type="hidden" name="cropped_image" id="croppedImage{{ $post->id }}" value="">
                        
                                           <!-- PDF Upload -->
                                            <div class="mb-3">
                                                <label for="pdf" class="form-label">PDF (Optional)</label>
                                                <input type="file" id="pdf" name="pdf[]" class="form-control" multiple>
                                                @if($post->pdf)
                                                    <div class="mt-2">
                                                        <p>Existing PDF(s):</p>
                                                        @foreach($post->pdf as $pdf)
                                                            <a href="{{ asset($pdf) }}" target="_blank">{{ basename($pdf) }}</a><br>
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
                                            <button type="button" class="btn btn-primary" onclick="saveCroppedImageEdit({{ $post->id }})">
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

                         <!-- Metadata Modal -->
                         <div class="modal fade" id="metadataModal{{ $post->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                <form method="POST" 
                                    action="{{ $post->metadata ? route('admin.posts.metadata.update', $post->id) : route('admin.posts.metadata.store', $post->id) }}">
                                    @csrf
                                    @if($post->metadata)
                                        @method('PUT')
                                    @endif
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ $post->metadata ? 'Edit' : 'Add' }} Metadata</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Meta Title</label>
                                                <input type="text" name="metaTitle" class="form-control" 
                                                    value="{{ old('metaTitle', $post->metadata?->metaTitle) }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Meta Description</label>
                                                <textarea name="metaDescription" class="form-control" rows="3">{{ old('metaDescription', $post->metadata?->metaDescription) }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Meta Keywords</label>
                                                <textarea name="metaKeywords" class="form-control" rows="2">{{ old('metaKeywords', $post->metadata?->metaKeywords) }}</textarea>
                                                <small class="text-muted">Separate keywords with commas</small>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success">{{ $post->metadata ? 'Update' : 'Save' }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
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
    <div class="modal-dialog modal-lg">
         <div class="modal-content">
        <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Create New Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Start Row for English and Nepali Fields -->
                    <div class="row">
                        <!-- Nepali Fields Column -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="title_ne" class="form-label">Title (NE)</label>
                                <textarea id="title_ne" name="title_ne" class="form-control" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="description_ne" class="form-label">Description (NE) (Optional)</label>
                                <textarea id="description_ne" name="description_ne" class="form-control"></textarea>
                            </div>
                        </div>

                        <!-- English Fields Column -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="title_en" class="form-label">Title (EN)</label>
                                <textarea id="title_en" name="title_en" class="form-control" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="description_en" class="form-label">Description (EN) (Optional)</label>
                                <textarea id="description_en" name="description_en" class="form-control"></textarea>
                            </div>
                        </div>
                    </div> <!-- End Row -->

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
                     <button type="button" class="btn btn-primary" onclick="saveCroppedImage()">
                        Save Cropped Image
                    </button>
                    <button type="submit" class="btn btn-primary">Save</button>
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
    function populateMetadata(postId) {
    const titleEn = document.querySelector(`#editModal${postId} textarea[name="title_en"]`).value;
    const descriptionEn = document.querySelector(`#editModal${postId} textarea[name="description_en"]`)?.value || '';
    
    const metadataModal = document.querySelector(`#metadataModal${postId}`);
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
            const postId = this.getAttribute('data-bs-target').replace('#metadataModal', '');
            populateMetadata(postId);
        });
    });
});

function deleteImage(postId, index) {
    if (confirm('Are you sure you want to delete this image?')) {
        fetch(`/admin/posts/${postId}/delete-image/${index}`, {
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
    </script>
@endsection
