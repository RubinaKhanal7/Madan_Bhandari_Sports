@extends('backend.layouts.master')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Video Gallery</h5>
            <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createVideoModal">
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
                            <th>Title</th>
                            <th>Video Preview</th>
                            <th>Featured</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($videos as $video)
                            <tr>
                                <td>{{ $video->title_en }}</td>
                                <td>
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item" 
                                                src="{{ $video->url }}" 
                                                width="200" 
                                                height="150" 
                                                allowfullscreen>
                                        </iframe>
                                    </div>
                                </td>
                                <td>
                                    <button class="btn {{ $video->is_featured ? 'btn-success' : 'btn-danger' }} btn-sm" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#featuredModal{{ $video->id }}">
                                        {{ $video->is_featured ? 'Featured' : 'Unfeatured' }}
                                    </button>
                                </td>
                                <td>
                                    <button class="btn {{ $video->is_active ? 'btn-success' : 'btn-danger' }} btn-sm"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#statusModal{{ $video->id }}">
                                        {{ $video->is_active ? 'Active' : 'Inactive' }}
                                    </button>
                                </td>
                                <td>
                                    <!-- Edit Button -->
                                    <button class="btn btn-outline-primary btn-sm" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editVideoModal{{ $video->id }}"
                                            style="width: 33px; text-align: center; font-size: 15px;">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    
                                    {{-- <!-- Metadata Button -->
                                    <button class="btn btn-outline-info btn-sm" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#metadataModal{{ $video->id }}"
                                            style="width: 33px; text-align: center; font-size: 15px;">
                                        <i class="fas fa-info"></i>
                                    </button> --}}
                                    
                                    <!-- Delete Button -->
                                    <button class="btn btn-outline-danger btn-sm" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteVideoModal{{ $video->id }}"
                                            style="width: 33px; text-align: center; font-size: 15px;">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>

                              <!-- Featured Status Modal -->
                        <div class="modal fade" id="featuredModal{{ $video->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <form method="POST" action="{{ route('admin.video-galleries.toggle-featured', $video->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Change Featured Status</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Do you want to {{ $video->is_featured ? 'remove' : 'set' }} this video as featured?</p>
                                            <p><strong>Current status:</strong> {{ $video->is_featured ? 'Featured' : 'Not Featured' }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn {{ $video->is_featured ? 'btn-danger' : 'btn-success' }}">
                                                {{ $video->is_featured ? 'Remove from Featured' : 'Set as Featured' }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Active Status Modal -->
                        <div class="modal fade" id="statusModal{{ $video->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <form method="POST" action="{{ route('admin.video-galleries.toggle-status', $video->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Change Status</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Do you want to {{ $video->is_active ? 'deactivate' : 'activate' }} this video?</p>
                                            <p><strong>Current status:</strong> {{ $video->is_active ? 'Active' : 'Inactive' }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn {{ $video->is_active ? 'btn-danger' : 'btn-success' }}">
                                                {{ $video->is_active ? 'Deactivate' : 'Activate' }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                            <!-- Edit Video Modal -->
                            <div class="modal fade" id="editVideoModal{{ $video->id }}" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.video-galleries.update', $video->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Video</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group mb-3">
                                                    <label for="title_en">Title (English)</label>
                                                    <input type="text" name="title_en" class="form-control" value="{{ $video->title_en }}" required>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="title_ne">Title (Nepali)</label>
                                                    <input type="text" name="title_ne" class="form-control" value="{{ $video->title_ne }}" required>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="url">Video URL</label>
                                                    <input type="url" name="url" class="form-control" value="{{ $video->url }}" required>
                                                    <small class="form-text text-muted">
                                                        Supports YouTube, Vimeo, and direct video URLs. For YouTube, you can use either the watch URL or embed URL.
                                                    </small>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="videos">Video File Path (Optional)</label>
                                                    <input type="text" name="videos" class="form-control" value="{{ $video->videos }}">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="description_en">Description (English)</label>
                                                    <textarea name="description_en" class="form-control">{{ $video->description_en }}</textarea>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="description_ne">Description (Nepali)</label>
                                                    <textarea name="description_ne" class="form-control">{{ $video->description_ne }}</textarea>
                                                </div>
                                                <div class="form-check mb-3">
                                                    <input type="checkbox" name="is_featured" class="form-check-input" id="is_featured{{ $video->id }}" {{ $video->is_featured ? 'checked' : '' }}>
                                                    <label for="is_featured{{ $video->id }}" class="form-check-label">Featured</label>
                                                </div>
                                                <div class="form-check mb-3">
                                                    <input type="checkbox" name="is_active" class="form-check-input" id="is_active{{ $video->id }}" {{ $video->is_active ? 'checked' : '' }}>
                                                    <label for="is_active{{ $video->id }}" class="form-check-label">Active</label>
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

                            <!-- Delete Video Modal -->
                            <div class="modal fade" id="deleteVideoModal{{ $video->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.video-galleries.destroy', $video->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-header">
                                                <h5 class="modal-title">Delete Video</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete <strong>{{ $video->title_en }}</strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-danger">Delete</button>
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
</div>

<!-- Create Video Modal -->
<div class="modal fade" id="createVideoModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('admin.video-galleries.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add New Video</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3 d-flex">
                        <div class="me-3">
                            <label for="title_en">Title (English)</label>
                            <input type="text" name="title_en" class="form-control" value="{{ old('title_en') }}" required style="width: 250px;">
                        </div>
                        <div>
                            <label for="title_ne">Title (Nepali)</label>
                            <input type="text" name="title_ne" class="form-control" value="{{ old('title_ne') }}" required style="width: 250px;">
                        </div>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="url">Video URL</label>
                        <input type="url" name="url" class="form-control" value="{{ old('url') }}" required>
                        <small class="form-text text-muted">
                            Supports YouTube, Vimeo, and direct video URLs. For YouTube, you can use either the watch URL or embed URL.
                        </small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="videos">Video File Path (Optional)</label>
                        <input type="text" name="videos" class="form-control" value="{{ old('videos') }}">
                        <small class="form-text text-muted">
                            If you have a direct video file path, you can enter it here.
                        </small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="description_en">Description (English)</label>
                        <textarea name="description_en" class="form-control" rows="3">{{ old('description_en') }}</textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="description_ne">Description (Nepali)</label>
                        <textarea name="description_ne" class="form-control" rows="3">{{ old('description_ne') }}</textarea>
                    </div>
                    <div class="form-check mb-3">
                        <input type="checkbox" name="is_featured" class="form-check-input" id="create_is_featured" {{ old('is_featured') ? 'checked' : '' }}>
                        <label for="create_is_featured" class="form-check-label">Featured</label>
                    </div>
                    <div class="form-check mb-3">
                        <input type="checkbox" name="is_active" class="form-check-input" id="create_is_active" {{ old('is_active', true) ? 'checked' : '' }}>
                        <label for="create_is_active" class="form-check-label">Active</label>
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


@endsection

@push('scripts')
<script>
    // Add any custom JavaScript here if needed
    document.addEventListener('DOMContentLoaded', function() {
        // Example: Add form validation or handle video URL parsing
    });
</script>
@endpush