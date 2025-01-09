@extends('backend.layouts.master')

@section('content')
<div class="card mt-3">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Local Governments</h5>
        <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
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
                        <th>SN</th>
                        <th>Title</th>
                        <th>District</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($localGovernments as $localGov)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $localGov->title }}</td>
                        <td>{{ $localGov->district->title }}</td>
                        <td>
                            <button class="btn {{ $localGov->is_active ? 'btn-success' : 'btn-danger' }} btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#statusModal{{ $localGov->id }}">
                                {{ $localGov->is_active ? 'Active' : 'Inactive' }}
                            </button>
                        </td>
                        <td>
                            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $localGov->id }}" style="width: 32px;">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $localGov->id }}" style="width: 32px;">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>

                    <!-- Status Modal -->
                    <div class="modal fade" id="statusModal{{ $localGov->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <form method="POST" action="{{ route('admin.local-governments.updateStatus', $localGov->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Change Status</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Do you want to <strong>{{ $localGov->is_active ? 'deactivate' : 'activate' }}</strong> this local government?</p>
                                        <p><strong>Current Status:</strong> {{ $localGov->is_active ? 'Active' : 'Inactive' }}</p>
                                        <input type="hidden" name="is_active" value="{{ $localGov->is_active ? 0 : 1 }}">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn {{ $localGov->is_active ? 'btn-danger' : 'btn-success' }}">
                                            {{ $localGov->is_active ? 'Deactivate' : 'Activate' }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{ $localGov->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST" action="{{ route('admin.local-governments.update', $localGov->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Local Government</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Title</label>
                                            <input type="text" name="title" class="form-control" value="{{ $localGov->title }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">District</label>
                                            <select name="district_id" class="form-control" required>
                                                @foreach($districts as $district)
                                                <option value="{{ $district->id }}" {{ $localGov->district_id == $district->id ? 'selected' : '' }}>
                                                    {{ $district->title }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input type="checkbox" name="is_active" class="form-check-input" {{ $localGov->is_active ? 'checked' : '' }}>
                                            <label class="form-check-label">Active</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal{{ $localGov->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <form method="POST" action="{{ route('admin.local-governments.destroy', $localGov->id) }}">
                                @csrf
                                @method('DELETE')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete Local Government</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete this local government?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    @if ($localGovernments->onFirstPage())
                    <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                    @else
                    <li class="page-item"><a class="page-link" href="{{ $localGovernments->previousPageUrl() }}">&laquo;</a></li>
                    @endif

                    @foreach ($localGovernments->getUrlRange(1, $localGovernments->lastPage()) as $page => $url)
                    @if ($page == $localGovernments->currentPage())
                    <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                    @else
                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                    @endforeach

                    @if ($localGovernments->hasMorePages())
                    <li class="page-item"><a class="page-link" href="{{ $localGovernments->nextPageUrl() }}">&raquo;</a></li>
                    @else
                    <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.local-governments.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Local Government</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">District</label>
                        <select name="district_id" class="form-control" required>
                            <option value="">Select District</option>
                            @foreach($districts as $district)
                            <option value="{{ $district->id }}">{{ $district->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-check mb-3">
                        <input type="checkbox" name="is_active" class="form-check-input" checked>
                        <label class="form-check-label">Active</label>
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