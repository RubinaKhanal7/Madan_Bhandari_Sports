@extends('backend.layouts.master')

@section('content')
<div class="container">
    <h2>Roles Management</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createRoleModal">Create Role</button>

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
                        <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="btn btn-outline-danger btn-sm" 
                                    style="width: 32px;" 
                                    onclick="return confirm('Are you sure?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
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
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
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
