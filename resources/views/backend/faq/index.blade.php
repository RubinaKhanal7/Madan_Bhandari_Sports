@extends('backend.layouts.master')
@section('content')
<div class="card mt-3">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">FAQ Management</h5>
        <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createCoverImageModal">
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
    

            <div class="accordion" id="faqAccordion">
                @foreach($faqs as $key => $faq)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $faq->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $faq->id }}">
                            <span class="me-2">{{ $key + 1 }}.</span> {{ $faq->title }}
                        </button>
                    </h2>
                    <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-md-8">
                                    {{ $faq->answer }}
                                </div>
                                <div class="col-md-4 text-end">
                                    <button 
                                        class="btn {{ $faq->is_active ? 'btn-success' : 'btn-danger' }} btn-sm" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#changeStatusModal{{ $faq->id }}">
                                        {{ $faq->is_active ? 'Active' : 'Inactive' }}
                                    </button>
                                    <button class="btn btn-outline-primary btn-sm edit-btn" data-bs-toggle="modal" data-bs-target="#editFaqModal{{ $faq->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteFaqModal{{ $faq->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Change Status Modal -->
                <div class="modal fade" id="changeStatusModal{{ $faq->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('admin.faqs.update', $faq->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title">Change Status</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to change the status of this FAQ?</p>
                                    <div class="mb-3">
                                        <label for="is_active" class="form-label">Select New Status</label>
                                        <select name="is_active" class="form-select" required>
                                            <option value="1" {{ $faq->is_active ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ !$faq->is_active ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                    <!-- Hidden fields to maintain validation -->
                                    <input type="hidden" name="title" value="{{ $faq->title }}">
                                    <input type="hidden" name="answer" value="{{ $faq->answer }}">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Change Status</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Edit Modal -->
                <div class="modal fade" id="editFaqModal{{ $faq->id }}" tabindex="-1" aria-labelledby="editFaqLabel{{ $faq->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('admin.faqs.update', $faq->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editFaqLabel{{ $faq->id }}">Edit FAQ</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Title</label>
                                        <textarea name="title" class="form-control" required>{{ $faq->title }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="answer" class="form-label">Answer</label>
                                        <textarea name="answer" class="form-control" required>{{ $faq->answer }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Is Active?</label>
                                        <input type="checkbox" name="is_active" checked value="1">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Delete Modal -->
                <div class="modal fade" id="deleteFaqModal{{ $faq->id }}" tabindex="-1" aria-labelledby="deleteFaqLabel{{ $faq->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('admin.faqs.destroy', $faq->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteFaqLabel{{ $faq->id }}">Delete FAQ</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this FAQ?
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
            </div>
        </div>
    </div>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createFaqModal" tabindex="-1" aria-labelledby="createFaqLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.faqs.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createFaqLabel">Add FAQ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <textarea name="title" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="answer" class="form-label">Answer</label>
                        <textarea name="answer" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Is Active?</label>
                        <input type="checkbox" name="is_active" checked value="1">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection