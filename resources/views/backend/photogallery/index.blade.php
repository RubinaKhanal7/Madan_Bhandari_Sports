@extends('backend.layouts.master')

@section('content')
    <div class="container">
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif

        @if (Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
        @endif

        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{ $page_title }}</h1>
                <a href="{{ route('admin.photo-galleries.create') }}" class="btn btn-primary btn-sm">
                    <i class="fa fa-plus"></i> Add
                </a>
                <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Images</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                {{-- @php
                    $perPage = $gallery->perPage(); 
                    $currentPage = $gallery->currentPage(); 
                    $serialNumber = ($currentPage - 1) * $perPage + 1; 
                @endphp --}}
                @foreach ($gallery as $image)
                    <tr>
                        {{-- <td>{{ $serialNumber++ }}</td> --}}
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $image->title }}</td>
                        <td>{{ $image->img_desc }}</td>
                        <td>
                            @if (is_array($image->img))
                                <div class="album-container">
                                    @foreach ($image->img as $index => $imagePath)
                                        <img class="album-image"
                                            id="preview{{ $loop->parent->iteration }}{{ $index }}"
                                            src="{{ asset($imagePath) }}"
                                            style="width: 100px; height:100px; margin-right: 5px;" />
                                     @endforeach
                                </div>
                            @else
                                <img src="{{ asset($image->img) }}" style="width: 150px; height:150px;" />
                            @endif
                        </td>

                        <td> @if ($image->status == 1)
                            <span class="badge badge-success text-black">Active</span>
                        @else
                            <span class="badge badge-danger text-danger">Inactive</span>
                        @endif
                        </td>


                        <td>
                            
                            <div style="display: flex; flex-direction:row;">
                                <!-- Edit button triggers edit modal -->
                                <button class="btn btn-warning btn-sm" data-toggle="modal"
                                    data-target="#editModal{{ $image->id }}" style="margin-right: 5px;"><i
                                        class="fas fa-edit"></i> Edit</button>
                                <!-- Delete button triggers delete modal -->
                                <button class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#deleteModal{{ $image->id }}">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{ $image->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="editModalLabel{{ $image->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Photo Gallery</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to edit this photo gallery?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <a href="{{ route('admin.photo-galleries.edit', $image->id) }}" class="btn btn-primary">Edit</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal{{ $image->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="deleteModalLabel{{ $image->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Delete Photo Gallery</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this photo gallery?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <form action="{{ route('admin.photo-galleries.destroy', $image->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <nav aria-label="Page navigation">
            <ul class="pagination">
                {{ $gallery->links() }}
            </ul>
        </nav>
    </div>
@stop
