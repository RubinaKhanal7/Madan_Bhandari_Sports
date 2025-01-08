@extends('backend.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Photo Galleries</h3>
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
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Title (NE)</th>
                                <th>Title (EN)</th>
                                <th>Images</th>
                                <th>Status</th>
                                <th>Featured</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($galleries as $gallery)
                            <tr>
                                <td>{{ $gallery->title_ne }}</td>
                                <td>{{ $gallery->title_en }}</td>
                                <td>
                                    @if($gallery->images)
                                        @foreach($gallery->images as $image)
                                            <img src="{{ asset($image) }}" alt="Gallery Image" class="img-thumbnail" style="height: 50px;">
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    <button type="button" 
                                        class="btn btn-sm {{ $gallery->is_active ? 'btn-success' : 'btn-danger' }}"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#statusModal{{ $gallery->id }}">
                                        {{ $gallery->is_active ? 'Active' : 'Inactive' }}
                                    </button>
                                </td>
                                <td>
                                    <button type="button" 
                                        class="btn btn-sm {{ $gallery->is_featured ? 'btn-info' : 'btn-secondary' }}"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#featuredModal{{ $gallery->id }}">
                                        {{ $gallery->is_featured ? 'Featured' : 'Not Featured' }}
                                    </button>
                                </td>
                                <td>
                                    <button class="btn btn-outline-primary btn-sm" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#metadataModal{{ $gallery->id }}" 
                                        style="width: 32px; text-align: center; font-size: 15px;">
                                    <span>M</span>
                                    </button>

                                   <!-- Edit Button -->
                                    <button class="btn btn-outline-info btn-sm" data-bs-toggle="modal" 
                                    data-bs-target="#editModal{{ $gallery->id }}" style="width: 32px;">
                                    <i class="fas fa-edit"></i>
                                    </button>

                                    <!-- Delete Button -->
                                    <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" 
                                    data-bs-target="#deleteModal{{ $gallery->id }}" style="width: 32px;">
                                    <i class="fas fa-trash"></i>
                                    </button>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $galleries->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.photo-galleries.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Create New Gallery</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Nepali Column -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Title (NE)</label>
                                <input type="text" name="title_ne" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Description (NE) (Optional)</label>
                                <textarea name="description_ne" class="form-control"></textarea>
                            </div>
                        </div>
                        <!-- English Column -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Title (EN)</label>
                                <input type="text" name="title_en" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Description (EN) (Optional)</label>
                                <textarea name="description_en" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Images</label>
                        <input type="file" name="images[]" class="form-control" multiple accept="image/*" required>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="is_featured" class="form-check-input" value="1">
                        <label class="form-check-label">Featured</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="is_active" class="form-check-input" value="1" checked>
                        <label class="form-check-label">Active</label>
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



<!-- Edit Modals -->
@foreach($galleries as $gallery)
    <div class="modal fade" id="editModal{{ $gallery->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $gallery->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('admin.photo-galleries.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel{{ $gallery->id }}">Edit Gallery</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <!-- Nepali Column -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Title (NE)</label>
                                    <input type="text" name="title_ne" class="form-control" value="{{ $gallery->title_ne }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Description (NE) (Optional)</label>
                                    <textarea name="description_ne" class="form-control">{{ $gallery->description_ne }}</textarea>
                                </div>
                            </div>
                            <!-- English Column -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Title (EN)</label>
                                    <input type="text" name="title_en" class="form-control" value="{{ $gallery->title_en }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Description (EN) (Optional)</label>
                                    <textarea name="description_en" class="form-control">{{ $gallery->description_en }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Existing Images</label>
                            <div class="row">
                                @if($gallery->images)
                                    @foreach($gallery->images as $index => $image)
                                        <div class="col-md-3 mb-2">
                                            <div class="card">
                                                <img src="{{ asset($image) }}" class="card-img-top" alt="Gallery Image">
                                                <div class="card-body p-2">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" 
                                                            class="custom-control-input" 
                                                            id="keepImage{{ $gallery->id }}_{{ $index }}"
                                                            name="existing_images[]" 
                                                            value="{{ $image }}" 
                                                            checked>
                                                        <label class="custom-control-label" for="keepImage{{ $gallery->id }}_{{ $index }}">
                                                            Keep Image
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Add New Images</label>
                            <input type="file" name="new_images[]" class="form-control" multiple accept="image/*">
                            <small class="form-text text-muted">Select multiple images to add to the gallery</small>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" name="is_featured" class="form-check-input" value="1" {{ $gallery->is_featured ? 'checked' : '' }}>
                            <label class="form-check-label">Featured</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" name="is_active" class="form-check-input" value="1" {{ $gallery->is_active ? 'checked' : '' }}>
                            <label class="form-check-label">Active</label>
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
<!-- Metadata Modal -->
<div class="modal fade" id="metadataModal{{ $gallery->id }}" tabindex="-1" aria-labelledby="metadataModalLabel{{ $gallery->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="metadataModalLabel{{ $gallery->id }}">Edit Metadata</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.photo-galleries.metadata.store', $gallery->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="metaTitle{{ $gallery->id }}" class="form-label">Meta Title</label>
                        <input type="text" name="metaTitle" class="form-control" id="metaTitle{{ $gallery->id }}" 
                            value="{{ optional($gallery->metaData)->metaTitle ?? $gallery->title_en }}">
                    </div>
                    <div class="mb-3">
                        <label for="metaDescription{{ $gallery->id }}" class="form-label">Meta Description</label>
                        <textarea name="metaDescription" class="form-control" id="metaDescription{{ $gallery->id }}">{{ optional($gallery->metaData)->metaDescription ?? $gallery->description_en }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="metaKeywords{{ $gallery->id }}" class="form-label">Meta Keywords</label>
                        <textarea name="metaKeywords" class="form-control" id="metaKeywords{{ $gallery->id }}">{{ optional($gallery->metaData)->metaKeywords }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
            
        </div>
    </div>
</div>
    <!-- Delete Modal-->
    <div class="modal fade" id="deleteModal{{ $gallery->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $gallery->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel{{ $gallery->id }}">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this gallery?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('admin.photo-galleries.destroy', $gallery->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Status Modal -->
    <div class="modal fade" id="statusModal{{ $gallery->id }}" tabindex="-1" aria-labelledby="statusModalLabel{{ $gallery->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusModalLabel{{ $gallery->id }}">Update Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to change the status of this gallery to 
                    <strong>{{ $gallery->is_active ? 'Inactive' : 'Active' }}</strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('admin.photo-gallery.update-status', $gallery->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn {{ $gallery->is_active ? 'btn-danger' : 'btn-success' }}">
                            {{ $gallery->is_active ? 'Make Inactive' : 'Make Active' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Modal -->
    <div class="modal fade" id="featuredModal{{ $gallery->id }}" tabindex="-1" aria-labelledby="featuredModalLabel{{ $gallery->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="featuredModalLabel{{ $gallery->id }}">Update Featured Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to change this gallery to 
                    <strong>{{ $gallery->is_featured ? 'Not Featured' : 'Featured' }}</strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('admin.photo-gallery.update-featured', $gallery->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn {{ $gallery->is_featured ? 'btn-secondary' : 'btn-info' }}">
                            {{ $gallery->is_featured ? 'Remove from Featured' : 'Make Featured' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>
@endforeach

@endsection

@push('scripts')
<script>
// Preview images before upload for create modal
document.querySelector('input[name="images[]"]').addEventListener('change', function(e) {
    const preview = document.createElement('div');
    preview.className = 'row mt-2';
    
    Array.from(e.target.files).forEach(file => {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML += `
                <div class="col-md-3 mb-2">
                    <img src="${e.target.result}" class="img-thumbnail" style="height: 100px;">
                </div>
            `;
        }
        reader.readAsDataURL(file);
    });
    
    const existingPreview = this.nextElementSibling;
    if(existingPreview && existingPreview.className === 'row mt-2') {
        existingPreview.remove();
    }
    this.after(preview);
});

// Preview images before upload for edit modal
document.querySelectorAll('input[name="new_images[]"]').forEach(input => {
    input.addEventListener('change', function(e) {
        const preview = document.createElement('div');
        preview.className = 'row mt-2';
        
        Array.from(e.target.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML += `
                    <div class="col-md-3 mb-2">
                        <img src="${e.target.result}" class="img-thumbnail" style="height: 100px;">
                    </div>
                `;
            }
            reader.readAsDataURL(file);
        });
        
        const existingPreview = this.nextElementSibling;
        if(existingPreview && existingPreview.className === 'row mt-2') {
            existingPreview.remove();
        }
        this.after(preview);
    });
});
</script>
@endpush
