@extends('backend.layouts.master')

@section('content')
<div class="card">
    <div class="card-body">
        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Page Title and Add User Button -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title mb-0">User Management</h5>
            <button type="button" 
                    class="btn btn-outline-primary btn-sm" 
                    data-bs-toggle="modal" 
                    data-bs-target="#createUserModal">
                + Add New 
            </button>
        </div>

        <!-- Users Table -->
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Registration Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $key => $user)
                        <tr>
                            <td>{{ $users->firstItem() + $key }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email ?? 'N/A' }}</td>
                            <td>{{ $user->created_at->format('Y-m-d H:i:s') }}</td>
                            <td>
                                <button type="button" 
                                        class="btn btn-outline-info btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#approveModal{{ $user->id }}">
                                    <i class="fas fa-check"></i>
                                </button>

                                <button type="button" 
                                        class="btn btn-outline-danger btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $user->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No users found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
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
                    <!-- Full Name Field -->
                    <div class="mb-3">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email Address Field -->
                    <div class="mb-3">
                        <label for="email">Email Address (Optional)</label>
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Phone Number Field -->
                    <div class="mb-3">
                        <label for="phonenumber">Phone Number</label>
                        <input type="text" id="phonenumber" name="phonenumber" class="form-control @error('phonenumber') is-invalid @enderror" value="{{ old('phonenumber') }}">
                        @error('phonenumber')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password or Pin Option -->
                    <div class="mb-3">
                        <label for="password_or_pin">Choose either a password or a pin:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="password_or_pin" id="password_option" value="password" {{ old('password_or_pin') == 'password' ? 'checked' : '' }}>
                            <label class="form-check-label" for="password_option">Password (Minimum 8 characters)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="password_or_pin" id="pin_option" value="pin" {{ old('password_or_pin') == 'pin' ? 'checked' : '' }}>
                            <label class="form-check-label" for="pin_option">Pin (4 Digits)</label>
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div class="mb-3" id="password_field" style="{{ old('password_or_pin') == 'password' ? '' : 'display:none;' }}">
                        <label for="password">Password (Min 8 characters)</label>
                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Pin Field -->
                    <div class="mb-3" id="pin_field" style="{{ old('password_or_pin') == 'pin' ? '' : 'display:none;' }}">
                        <label for="pin">Pin (4 Digits)</label>
                        <input type="text" id="pin" name="pin" class="form-control @error('pin') is-invalid @enderror" value="{{ old('pin') }}">
                        @error('pin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirm Password/Pin -->
                    <div class="mb-3" id="confirm_password_field" style="{{ old('password_or_pin') == 'password' ? '' : 'display:none;' }}">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3" id="confirm_pin_field" style="{{ old('password_or_pin') == 'pin' ? '' : 'display:none;' }}">
                        <label for="pin_confirmation">Confirm Pin</label>
                        <input type="text" id="pin_confirmation" name="pin_confirmation" class="form-control @error('pin_confirmation') is-invalid @enderror" value="{{ old('pin_confirmation') }}">
                        @error('pin_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create User</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('password_option').addEventListener('change', function() {
        document.getElementById('password_field').style.display = '';
        document.getElementById('pin_field').style.display = 'none';
        document.getElementById('confirm_password_field').style.display = '';
        document.getElementById('confirm_pin_field').style.display = 'none';
    });

    document.getElementById('pin_option').addEventListener('change', function() {
        document.getElementById('pin_field').style.display = '';
        document.getElementById('password_field').style.display = 'none';
        document.getElementById('confirm_pin_field').style.display = '';
        document.getElementById('confirm_password_field').style.display = 'none';
    });
</script>

@endsection
