@extends('backend.layouts.master')
@section('content')
<div class="card mt-3">
    <div class="card-body">
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

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title mb-0">User Management</h5>
            <button type="button" 
                    class="btn btn-outline-primary btn-sm" 
                    data-bs-toggle="modal" 
                    data-bs-target="#createUserModal">
                + Add New
            </button>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Registration Date</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $key => $user)
                    <tr>
                        <td>{{ $users->firstItem() + $key }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->format('Y-m-d') }}</td>
                        <td>
                            @if($user->is_admin == 1 && !$user->is_approved)
                                <span class="badge bg-info position-relative">
                                    <i class="fas fa-user-shield me-1"></i> Request
                                    <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                                        <span class="visually-hidden">New Request</span>
                                    </span>
                                </span>
                            @elseif($user->is_admin == 1 && $user->is_approved)
                                <span class="badge bg-primary">
                                    <i class=""></i> Admin
                                </span>
                            @else
                                <span class="badge bg-secondary">User</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge {{ $user->is_approved ? 'bg-success' : 'bg-warning' }}">
                                {{ $user->is_approved ? 'Approved' : 'Pending' }}
                            </span>
                        </td>
                        <td>
                            @if(!$user->created_by_admin)
                                <button type="button" 
                                        class="btn btn-outline-primary btn-sm"
                                        style="width: 32px;"
                                        data-bs-toggle="modal"
                                        data-bs-target="#approveModal{{ $user->id }}"
                                        title="Approve"
                                        {{ $user->is_approved ? 'disabled' : '' }}>
                                    <i class="fas fa-check"></i>
                                </button>
                            @endif
                            <button type="button" 
                                    class="btn btn-outline-danger btn-sm"
                                    style="width: 32px;"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $user->id }}"
                                    title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>

                            <!-- If user is admin and not approved, show the "View Documents" button -->
                            @if($user->is_admin == 1 && !$user->is_approved)
                                <button type="button" 
                                        class="btn btn-outline-info btn-sm"
                                        style="width: 32px;"
                                        data-bs-toggle="modal"
                                        data-bs-target="#viewDocumentsModal{{ $user->id }}"
                                        title="View Documents">
                                    <i class="fas fa-file-alt"></i>
                                </button>
                            @endif
                        </td>
                    </tr>

                    <!-- View Documents Modal -->
                    @if($user->is_admin == 1 && !$user->is_approved)
                    <div class="modal fade" id="viewDocumentsModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-light">
                                    <h5 class="modal-title">
                                        <i class="fas fa-user-shield text-info me-2"></i>
                                        Review Admin Documents - {{ $user->name }}
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h6 class="mb-0">Citizenship Front</h6>
                                                </div>
                                                <div class="card-body p-2">
                                                    @if($user->citizenship_front)
                                                        <img src="{{ asset('storage/upload/citizenships/' . basename($user->citizenship_front)) }}" 
                                                             class="img-fluid rounded" 
                                                             alt="Citizenship Front">
                                                    @else
                                                        <p class="text-muted">No front image uploaded</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h6 class="mb-0">Citizenship Back</h6>
                                                </div>
                                                <div class="card-body p-2">
                                                    @if($user->citizenship_back)
                                                        <img src="{{ asset('storage/upload/citizenships/' . basename($user->citizenship_back)) }}" 
                                                             class="img-fluid rounded" 
                                                             alt="Citizenship Back">
                                                    @else
                                                        <p class="text-muted">No back image uploaded</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <form action="{{ route('admin.users.approve', $user->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-check-circle me-1"></i>
                                            Approve as Admin
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Approve Modal -->
                    <div class="modal fade" id="approveModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog {{ $user->is_admin == 1 ? 'modal-lg' : '' }}">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">
                                        @if($user->is_admin == 1)
                                            <i class="fas fa-user-shield text-info me-2"></i>Review Admin Request
                                        @else
                                            Approve User
                                        @endif
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    @if($user->is_admin == 1)
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h6 class="mb-0">Citizenship Front</h6>
                                                    </div>
                                                    <div class="card-body p-2">
                                                        @if($user->citizenship_front)
                                                            <img src="{{ asset($user->citizenship_front) }}" 
                                                                 class="img-fluid rounded" 
                                                                 alt="Citizenship Front">
                                                        @else
                                                            <p class="text-muted">No front image uploaded</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h6 class="mb-0">Citizenship Back</h6>
                                                    </div>
                                                    <div class="card-body p-2">
                                                        @if($user->citizenship_back)
                                                            <img src="{{ asset($user->citizenship_back) }}" 
                                                                 class="img-fluid rounded" 
                                                                 alt="Citizenship Back">
                                                        @else
                                                            <p class="text-muted">No back image uploaded</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <p>Are you sure you want to approve {{ $user->name }}?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <form action="{{ route('admin.users.approve', $user->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-check-circle me-1"></i>
                                            @if($user->is_admin == 1)
                                                Approve as Admin
                                            @else
                                                Approve
                                            @endif
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Delete User</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete {{ $user->name }}?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">No users found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-3">
            {{ $users->links() }}
        </div>
    </div>
</div>

 <!-- Create User Modal -->
 <div class="modal fade" id="createUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('admin.users.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" for="name">Full Name</label>
                        <input type="text" name="name" class="form-control" required>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label" for="email">Email Address (Optional)</label>
                            <input type="email" name="email" class="form-control">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="phonenumber">Phone Number</label>
                            <input type="text" name="phonenumber" class="form-control" required>
                            @error('phonenumber')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" name="password" class="form-control">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="password_confirmation">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label" for="pin">PIN</label>
                            <input type="password" name="pin" class="form-control" maxlength="6">
                            @error('pin')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="pin_confirmation">Confirm PIN</label>
                            <input type="password" name="pin_confirmation" class="form-control" maxlength="6">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label d-block">User Type</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_admin" id="regularUser" value="0" checked>
                            <label class="form-check-label" for="regularUser">Regular User</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_admin" id="adminUser" value="1">
                            <label class="form-check-label" for="adminUser">Admin User</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.getElementById('createUserForm').addEventListener('submit', function(e) {
e.preventDefault();

// Reset previous errors
document.getElementById('errorAlert').classList.add('d-none');
document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));

const formData = new FormData(this);

fetch(this.action, {
    method: 'POST',
    body: formData,
    headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    }
})
.then(response => response.json())
.then(data => {
    if (data.errors) {
        // Show error alert
        const errorAlert = document.getElementById('errorAlert');
        const errorList = document.getElementById('errorList');
        errorList.innerHTML = '';
        
        Object.keys(data.errors).forEach(field => {
            // Add invalid class to field
            const input = document.getElementById(field);
            if (input) {
                input.classList.add('is-invalid');
                const feedbackDiv = document.getElementById(field + 'Error');
                if (feedbackDiv) {
                    feedbackDiv.textContent = data.errors[field][0];
                }
            }
            
            // Add error to alert
            const li = document.createElement('li');
            li.textContent = data.errors[field][0];
            errorList.appendChild(li);
        });
        
        errorAlert.classList.remove('d-none');
    } else if (data.success) {
        // Close modal and reload page
        bootstrap.Modal.getInstance(document.getElementById('createUserModal')).hide();
        window.location.reload();
    }
})
.catch(error => {
    console.error('Error:', error);
});
});
</script>
@endpush

@endsection