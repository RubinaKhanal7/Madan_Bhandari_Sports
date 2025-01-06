@extends('backend.layouts.master')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Member Types</h2>
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
                <div class="bg-danger me-3 icon-item">
                    <span class="fas fa-times-circle text-white fs-3"></span>
                </div>
                <p class="mb-0 flex-1">{{ session('error') }}</p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($memberTypes as $memberType)
                        <tr>
                            <td>{{ $memberType->title }}</td>
                            <td style="white-space: nowrap;">
                                <button class="btn btn-outline-info btn-sm" 
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
