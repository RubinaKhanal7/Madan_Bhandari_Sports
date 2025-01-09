@extends('backend.layouts.master')

@section('content')
<div class="container mt-3">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Provinces</h5>
            <button type="button" 
                class="btn btn-outline-primary btn-sm" 
                data-bs-toggle="modal" 
                data-bs-target="#createProvinceModal">
            + Add New
            </button>
        </div>
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

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($provinces as $province)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $province->title }}</td>
                    <td>
                        <button class="btn {{ $province->is_active ? 'btn-success' : 'btn-danger' }} btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#statusModal{{ $province->id }}">
                            {{ $province->is_active ? 'Active' : 'Inactive' }}
                        </button>
                    </td>
                   
                    <td>
                        <!-- Edit Button -->
                        <button class="btn btn-outline-primary btn-sm edit-btn" data-bs-toggle="modal" 
                                data-bs-target="#editProvinceModal{{ $province->id }}" style="width: 32px;">
                            <i class="fas fa-edit"></i>
                        </button>
                    
                        <!-- Delete Button -->
                        <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" 
                                data-bs-target="#deleteProvinceModal{{ $province->id }}" style="width: 32px;">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                    
                </tr>

                 <!-- Status Modal -->
                 <div class="modal fade" id="statusModal{{ $province->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <form method="POST" action="{{ route('admin.provinces.updateStatus', $province->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Change Status</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Do you want to <strong>{{ $province->is_active ? 'deactivate' : 'activate' }}</strong> this province?</p>
                                    <p><strong>Current Status:</strong> {{ $province->is_active ? 'Active' : 'Inactive' }}</p>
                                    <input type="hidden" name="is_active" value="{{ $province->is_active ? 0 : 1 }}">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn {{ $province->is_active ? 'btn-danger' : 'btn-success' }}">
                                        {{ $province->is_active ? 'Deactivate' : 'Activate' }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Edit Modal -->
                <div class="modal fade" id="editProvinceModal{{ $province->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('admin.provinces.update', $province) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Province</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" class="form-control" name="title" value="{{ $province->title }}" required>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="is_active" {{ $province->is_active ? 'checked' : '' }}>
                                        <label class="form-check-label">Active</label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Save Changes</button> 
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Delete Modal -->
                <div class="modal fade" id="deleteProvinceModal{{ $province->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('admin.provinces.destroy', $province) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="modal-header">
                                    <h5 class="modal-title">Delete Province</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete the province "{{ $province->title }}"?
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
         <!-- Pagination -->
         <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                @if ($provinces->onFirstPage())
                    <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $provinces->previousPageUrl() }}" rel="prev">&laquo;</a></li>
                @endif

                @foreach ($provinces->getUrlRange(1, $provinces->lastPage()) as $page => $url)
                    @if ($page == $provinces->currentPage())
                        <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach

                @if ($provinces->hasMorePages())
                    <li class="page-item"><a class="page-link" href="{{ $provinces->nextPageUrl() }}" rel="next">&raquo;</a></li>
                @else
                    <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                @endif
            </ul>
        </nav>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createProvinceModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.provinces.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add Province</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" required>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_active" checked>
                            <label class="form-check-label">Active</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
