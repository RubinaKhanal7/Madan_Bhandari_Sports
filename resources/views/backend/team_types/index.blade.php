@extends('backend.layouts.master')

@section('content')

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container mt-3">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Team Types</h5>
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

            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title (NE)</th>
                        <th>Title (EN)</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($teamTypes as $teamType)
                    <tr>
                        <td>{{ $loop->iteration }}</td> 
                        <td>{{ $teamType->title_ne }}</td>
                        <td>{{ $teamType->title_en }}</td>
                        <td>
                            <span class="badge {{ $teamType->is_active ? 'bg-success' : 'bg-danger' }}">
                                {{ $teamType->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td style="white-space: nowrap;">
                            <!-- Edit Button -->
                            <button type="button" class="btn btn-outline-info btn-sm" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editModal{{ $teamType->id }}" 
                                    style="width: 32px;">
                                <i class="fas fa-edit"></i>
                            </button>
                        
                            <!-- Delete Button -->
                            <button type="button" class="btn btn-outline-danger btn-sm" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteModal{{ $teamType->id }}" 
                                    style="width: 32px;">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                
            </table>
            <!-- Pagination -->
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        @if ($teamTypes->onFirstPage())
            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
        @else
            <li class="page-item"><a class="page-link" href="{{ $teamTypes->previousPageUrl() }}" rel="prev">&laquo;</a></li>
        @endif

        @foreach ($teamTypes->getUrlRange(1, $teamTypes->lastPage()) as $page => $url)
            @if ($page == $teamTypes->currentPage())
                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
            @endif
        @endforeach

        @if ($teamTypes->hasMorePages())
            <li class="page-item"><a class="page-link" href="{{ $teamTypes->nextPageUrl() }}" rel="next">&raquo;</a></li>
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
        <div class="modal-content">
            <form action="{{ route('admin.team-types.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Create Team Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title_ne" class="form-label">Title (Nepali)</label>
                        <input type="text" class="form-control" id="title_ne" name="title_ne" required>
                    </div>
                    <div class="mb-3">
                        <label for="title_en" class="form-label">Title (English)</label>
                        <input type="text" class="form-control" id="title_en" name="title_en" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" checked>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modals -->
@foreach($teamTypes as $teamType)
<div class="modal fade" id="editModal{{ $teamType->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $teamType->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.team-types.update', $teamType) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel{{ $teamType->id }}">Edit Team Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title_ne{{ $teamType->id }}" class="form-label">Title (Nepali)</label>
                        <input type="text" class="form-control" id="title_ne{{ $teamType->id }}" 
                            name="title_ne" value="{{ $teamType->title_ne }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="title_en{{ $teamType->id }}" class="form-label">Title (English)</label>
                        <input type="text" class="form-control" id="title_en{{ $teamType->id }}" 
                            name="title_en" value="{{ $teamType->title_en }}" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="is_active{{ $teamType->id }}" 
                            name="is_active" {{ $teamType->is_active ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active{{ $teamType->id }}">Active</label>
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

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal{{ $teamType->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $teamType->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.team-types.destroy', $teamType) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel{{ $teamType->id }}">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this team type?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection
