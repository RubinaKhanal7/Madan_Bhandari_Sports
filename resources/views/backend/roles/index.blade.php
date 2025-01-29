@extends('backend.layouts.master')

@section('content')
<div class="container mt-3">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Roles Management</h2>
            <button type="button" 
                class="btn btn-outline-primary btn-sm" 
                data-bs-toggle="modal" 
                data-bs-target="#createRoleModal">
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
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Role</th>
                    <th>Permissions</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->permissions->pluck('name')->join(', ') }}</td>
                        <td style="white-space: nowrap;">
                            <!-- Edit Button -->
                            <a href="#" 
                            class="btn btn-outline-primary btn-sm" 
                            style="width: 32px;" 
                            data-bs-toggle="modal" 
                            data-bs-target="#editRoleModal{{ $role->id }}">
                                <i class="fas fa-edit"></i>
                            </a>
                        
                            <!-- Delete Button -->
                            <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" style="display:none;" id="deleteRoleForm{{ $role->id }}">
                                @csrf
                                @method('DELETE')
                            </form>
                            <a href="#" 
                            class="btn btn-outline-danger btn-sm" 
                            style="width: 32px;" 
                            data-bs-toggle="modal" 
                            data-bs-target="#deleteConfirmationModal" 
                            onclick="event.preventDefault(); document.getElementById('deleteRoleForm').action='{{ route('admin.roles.destroy', $role->id) }}';">
                                <i class="fas fa-trash"></i>
                            </a>

                        </td>   
                    </tr>

                    <!-- Edit Role Modal -->
                    <div class="modal fade" id="editRoleModal{{ $role->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5>Edit Role</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="name">Role Name</label>
                                            <input type="text" name="name" value="{{ $role->name }}" class="form-control" required>
                                        </div>
                                        <div>
                                            <label>Permissions</label>
                                            <div>
                                                <input type="checkbox" id="selectAllEdit{{ $role->id }}" onchange="toggleAllCheckboxes(this, 'edit-permissions-{{ $role->id }}')"> Select All
                                            </div>
                                            <div class="form-check">
                                                @foreach($permissions as $permission)
                                                    <div class="mb-2">
                                                        <input 
                                                            type="checkbox" 
                                                            name="permissions[]" 
                                                            value="{{ $permission->id }}" 
                                                            class="form-check-input edit-permissions-{{ $role->id }}" 
                                                            {{ $role->permissions->contains($permission) ? 'checked' : '' }}
                                                        >
                                                        <label class="form-check-label">{{ $permission->name }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="modal-footer">
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
                                <form id="deleteRoleForm" action="" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this role? This action cannot be undone.
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

    <!-- Create Role Modal -->
    <div class="modal fade" id="createRoleModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.roles.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5>Create Role</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name">Role Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Role Name" required>
                        </div>
                        <div>
                            <label>Permissions</label>
                            <div>
                                <input type="checkbox" id="selectAllCreate" onchange="toggleAllCheckboxes(this, 'create-permissions')"> Select All
                            </div>
                            <div class="form-check">
                                @foreach($permissions as $permission)
                                    <div class="mb-2">
                                        <input 
                                            type="checkbox" 
                                            name="permissions[]" 
                                            value="{{ $permission->id }}" 
                                            class="form-check-input create-permissions"
                                        >
                                        <label class="form-check-label">{{ $permission->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>                    
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleAllCheckboxes(checkbox, className) {
        const checkboxes = document.querySelectorAll('.' + className);
        checkboxes.forEach(cb => cb.checked = checkbox.checked);
    }
</script>
@endsection
