@extends('backend.layouts.master')

@section('content')
<div class="container mt-3">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>MetaData</h4>
            <!-- Add Button -->
            <button type="button" 
                class="btn btn-outline-primary btn-sm" 
                data-bs-toggle="modal" 
                data-bs-target="#createModal">
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
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Meta Title</th>
                    <th>Slug</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($metaData as $data)
                <tr>
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->metaTitle }}</td>
                    <td>{{ $data->slug }}</td>
                    <td>
                            <!-- Edit Button -->
                            <button class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $data->id }}">
                                <i class="fas fa-edit"></i>
                            </button>
                        
                            <!-- Delete Button -->
                            <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $data->id }}">
                                <i class="fas fa-trash"></i>
                            </button>
                    </td>
                </tr>

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal{{ $data->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('admin.meta-data.update', $data->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit MetaData</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="metaTitle" class="form-label">Meta Title</label>
                                        <input type="text" name="metaTitle" class="form-control" value="{{ $data->metaTitle }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="slug" class="form-label">Slug</label>
                                        <input type="text" name="slug" class="form-control" value="{{ $data->slug }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="metaDescription" class="form-label">Meta Description</label>
                                        <textarea name="metaDescription" class="form-control">{{ $data->metaDescription }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="metaKeywords" class="form-label">Meta Keywords</label>
                                        <textarea name="metaKeywords" class="form-control">{{ $data->metaKeywords }}</textarea>
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
                <div class="modal fade" id="deleteModal{{ $data->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('admin.meta-data.destroy', $data->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="modal-header">
                                    <h5 class="modal-title">Delete MetaData</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this MetaData?
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

        <!-- Create Modal -->
        <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('admin.meta-data.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">Add MetaData</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="metaTitle" class="form-label">Meta Title</label>
                                <input type="text" name="metaTitle" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" name="slug" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="metaDescription" class="form-label">Meta Description</label>
                                <textarea name="metaDescription" class="form-control"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="metaKeywords" class="form-label">Meta Keywords</label>
                                <textarea name="metaKeywords" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
