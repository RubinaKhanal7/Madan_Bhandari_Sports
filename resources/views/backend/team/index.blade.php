@extends('backend.layouts.master')

@section('content')
<div class="container mt-3">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Team Members</h3>
                    <button type="button" 
                    class="btn btn-outline-primary btn-sm" 
                    data-bs-toggle="modal" 
                    data-bs-target="#createTeamModal">
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
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Team Type</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Featured</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($teams as $team)
                            <tr>
                                <td>{{ $team->name }}</td>
                                <td>{{ $team->position }}</td>
                                <td>{{ $team->teamType->title_en }}</td>
                                <td>{{ $team->email }}</td>
                                <td>{{ $team->phone }}</td>
                                <td>
                                    <span class="badge {{ $team->is_featured ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $team->is_featured ? 'Yes' : 'No' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge {{ $team->is_active ? 'bg-success' : 'bg-danger' }}">
                                        {{ $team->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td style="white-space: nowrap;">
                                    <!-- Edit Button -->
                                    <button type="button" class="btn btn-outline-info btn-sm" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editTeamModal{{ $team->id }}" 
                                            style="width: 32px;">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                
                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.teams.destroy', $team->id) }}" method="POST" class="d-inline" data-toggle="modal" data-target="#deleteConfirmationModal">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#deleteConfirmationModal" 
                                                onclick="event.preventDefault(); document.getElementById('deleteTeamForm').action='{{ route('admin.teams.destroy', $team->id) }}';">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                </td>
                                
                            </tr>

                            <!-- Edit Modal for each team member -->
                            <div class="modal fade" id="editTeamModal{{ $team->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.teams.update', $team->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Team Member</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Team Type</label>
                                                    <select name="team_type_id" class="form-control" required>
                                                        @foreach($teamTypes as $type)
                                                            <option value="{{ $type->id }}" {{ $team->team_type_id == $type->id ? 'selected' : '' }}>
                                                                {{ $type->title_en }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" name="name" class="form-control" value="{{ $team->name }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Position</label>
                                                    <input type="text" name="position" class="form-control" value="{{ $team->position }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" name="email" class="form-control" value="{{ $team->email }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Phone</label>
                                                    <input type="text" name="phone" class="form-control" value="{{ $team->phone }}">
                                                </div>
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" name="is_featured" class="custom-control-input" 
                                                               id="editIsFeatured{{ $team->id }}" {{ $team->is_featured ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="editIsFeatured{{ $team->id }}">Featured</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" name="is_active" class="custom-control-input" 
                                                               id="editIsActive{{ $team->id }}" {{ $team->is_active ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="editIsActive{{ $team->id }}">Active</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Delete Confirmation Modal -->
                            <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form id="deleteTeamForm" action="" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this team member? This action cannot be undone.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
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
        @if ($teams->onFirstPage())
            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
        @else
            <li class="page-item"><a class="page-link" href="{{ $teams->previousPageUrl() }}" rel="prev">&laquo;</a></li>
        @endif

        @foreach ($teams->getUrlRange(1, $teams->lastPage()) as $page => $url)
            @if ($page == $teams->currentPage())
                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
            @endif
        @endforeach

        @if ($teams->hasMorePages())
            <li class="page-item"><a class="page-link" href="{{ $teams->nextPageUrl() }}" rel="next">&raquo;</a></li>
        @else
            <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
        @endif
    </ul>
</nav>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Create Team Modal -->
<div class="modal fade" id="createTeamModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.teams.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add New Team Member</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Team Type</label>
                        <select name="team_type_id" class="form-control" required>
                            @foreach($teamTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->title_en }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Position</label>
                        <input type="text" name="position" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control">
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="is_featured" class="custom-control-input" id="createIsFeatured">
                            <label class="custom-control-label" for="createIsFeatured">Featured</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="is_active" class="custom-control-input" id="createIsActive" checked>
                            <label class="custom-control-label" for="createIsActive">Active</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
