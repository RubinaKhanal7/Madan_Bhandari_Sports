@extends('backend.layouts.master')

@section('content')
    <!-- Content Wrapper. Contains page content -->

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
            <h1>Awards & Achievements</h1>
            <a href="{{ route('admin.services.create') }}">
                <button class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add</button>
            </a>
            <a href="{{ url('admin') }}">
                <button class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back</button>
            </a>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Awards & Achievements</li>
            </ol>
        </div>
    </div>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Description</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $serialNumber = ($services->currentPage() - 1) * $services->perPage() + 1;
            @endphp
            @foreach ($services as $service)
                <tr>
                    <td>{{ $serialNumber }}</td>
                    <td>{{ $service->title }}</td>
                    <td>
                        <img src="{{ asset('uploads/service/' . $service->image) }}" style="width: 150px; height:150px" />
                    </td>
                    <td>
                        {!! $summernoteContent->processContent($service->description) !!}
                    </td>
                    <td>
                        @if ($service->status == 1)
                            <span class="badge" style="color: black;">Active</span>
                        @else
                            <span class="badge" style="color: red;">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <div style="display: flex; flex-direction: row;">
                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal{{ $service->id }}" style="margin-right: 5px;">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $service->id }}">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </div>
                    </td>
                </tr>
                @php
                    $serialNumber++;
                @endphp

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal{{ $service->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $service->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel{{ $service->id }}">Edit Service</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to edit this service?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-primary">Edit</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Delete Modal -->
                <div class="modal fade" id="deleteModal{{ $service->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $service->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel{{ $service->id }}">Delete Service</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete this service?</p>
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
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
    <div class="pagination-wrapper">
        {{ $services->links() }}
    </div>
@endsection
