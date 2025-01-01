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
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Team Types</h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                Create New Team Type
            </button>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
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
                        <td>
                            <button type="button" class="btn btn-sm btn-primary" 
                                data-bs-toggle="modal" 
                                data-bs-target="#editModal{{ $teamType->id }}">
                                Edit
                            </button>
                            <form action="{{ route('admin.team-types.destroy', $teamType) }}" 
                                method="POST" 
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" 
                                    onclick="return confirm('Are you sure?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                
            </table>
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
                    <button type="submit" class="btn btn-primary">Save</button>
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
@endforeach
@endsection