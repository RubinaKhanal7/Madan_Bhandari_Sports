@extends('backend.layouts.master')

@section('content')
<div class="container mt-3">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Member Types</h5>
            <button type="button" 
            class="btn btn-outline-primary btn-sm" 
            data-bs-toggle="modal" 
            data-bs-target="#createMemberTypeModal">
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
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($memberTypes as $memberType)
                        <tr>
                            <td>{{ $memberType->title }}</td>
                            <td>
                                <button class="btn btn-sm {{ $memberType->is_active ? 'btn-success' : 'btn-danger' }}"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#statusModal{{ $memberType->id }}">
                                    {{ $memberType->is_active ? 'Active' : 'Inactive' }}
                                </button>
                            </td>
                            <td style="white-space: nowrap;">
                                <button class="btn btn-outline-primary btn-sm edit-btn" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editMemberTypeModal{{ $memberType->id }}" 
                                        style="width: 32px;">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <button class="btn btn-outline-danger btn-sm" style="width: 32px;" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#deleteMemberTypeModal{{ $memberType->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Status Change Modal -->
                      
                        <div class="modal fade" id="statusModal{{ $memberType->id }}" tabindex="-1">
                            <div class="modal-dialog">
                          <form method="POST" action="{{ route('admin.member_types.toggle-status', $memberType->id) }}">
                          @csrf
                          @method('PATCH')
                          <div class="modal-content">
                          <div class="modal-header">
                          <h5 class="modal-title">Change Status</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                          </div>
                          <div class="modal-body">
                            <p>Do you want to {{ $memberType->is_active ? 'deactivate' : 'activate' }} this member type?</p>
                            <p><strong>Current status:</strong> {{ $memberType->is_active ? 'Active' : 'Inactive' }}</p>
                           </div>
                          <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                          <button type="submit" class="btn {{ $memberType->is_active ? 'btn-danger' : 'btn-success' }}">
                          {{ $memberType->is_active ? 'Deactivate' : 'Activate' }}
                       </button>
                      </div>
                    </div>
                   </form>
                </div>
             </div>
  

                        <!-- Edit Modal for each member type -->
                        <div class="modal fade" id="editMemberTypeModal{{ $memberType->id }}" tabindex="-1" aria-labelledby="editMemberTypeModalLabel{{ $memberType->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('admin.member_types.update', $memberType->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editMemberTypeModalLabel{{ $memberType->id }}">Edit Member Type</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="title">Title</label>
                                                <input type="text" name="title" class="form-control" value="{{ $memberType->title }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Is Active?</label>
                                                <input type="checkbox" 
                                                    name="is_active" 
                                                    value="1" 
                                                    {{ $memberType->is_active ? 'checked' : '' }}>
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

                        <!-- Delete Confirmation Modal -->
                        <div class="modal fade" id="deleteMemberTypeModal{{ $memberType->id }}" tabindex="-1" aria-labelledby="deleteMemberTypeModalLabel{{ $memberType->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('admin.member_types.destroy', $memberType->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteMemberTypeModalLabel{{ $memberType->id }}">Delete Member Type</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete the member type <strong>{{ $memberType->title }}</strong>?</p>
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

<!-- Create Modal -->
<div class="modal fade" id="createMemberTypeModal" tabindex="-1" aria-labelledby="createMemberTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.member_types.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createMemberTypeModalLabel">Create Member Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Is Active?</label>
                        <input type="checkbox" name="is_active" checked value="1">
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
@endsection
