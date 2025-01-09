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

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title mb-0">Favicons</h5>
            </div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Fav 16x16</th>
                            <th>Fav 32x32</th>
                            <th>Fav ICO</th>
                            <th>Fav Apple</th>
                            <th>Fav 192x192</th>
                            <th>Fav 512x512</th>
                            <th>Site Manifest</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($favicons as $favicon)
                            <tr>
                                <td><img src="{{ asset('uploads/favicons/'.$favicon->fav_16) }}" alt="Fav 16" width="32"></td>
                                <td><img src="{{ asset('uploads/favicons/'.$favicon->fav_32) }}" alt="Fav 32" width="32"></td>
                                <td><img src="{{ asset('uploads/favicons/'.$favicon->fav_ico) }}" alt="Fav ICO" width="32"></td>
                                <td><img src="{{ asset('uploads/favicons/'.$favicon->fav_apple) }}" alt="Fav Apple" width="32"></td>
                                <td><img src="{{ asset('uploads/favicons/'.$favicon->fav_192) }}" alt="Fav 192" width="32"></td>
                                <td><img src="{{ asset('uploads/favicons/'.$favicon->fav_512) }}" alt="Fav 512" width="32"></td>
                                <td><a href="{{ $favicon->site_manifest }}" target="_blank">{{ $favicon->site_manifest }}</a></td>
                                <td>
                                    <button class="btn {{ $favicon->is_active ? 'btn-success' : 'btn-danger' }} btn-sm status-toggle" 
                                            data-favicon-id="{{ $favicon->id }}"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#statusModal{{ $favicon->id }}">
                                        {{ $favicon->is_active ? 'Active' : 'Inactive' }}
                                    </button>
                                </td>
                                <td>
                                    <button class="btn btn-outline-primary btn-sm edit-btn" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editFaviconModal{{ $favicon->id }}" 
                                            style="width: 32px;">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Status Change Modal -->
                      
                        <div class="modal fade" id="statusModal{{ $favicon->id }}" tabindex="-1">
                            <div class="modal-dialog">
                          <form method="POST" action="{{ route('admin.favicons.toggle-status', $favicon->id) }}">
                          @csrf
                          @method('PATCH')
                          <div class="modal-content">
                          <div class="modal-header">
                          <h5 class="modal-title">Change Status</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                          </div>
                          <div class="modal-body">
                            <p>Do you want to {{ $favicon->is_active ? 'deactivate' : 'activate' }} this favicon?</p>
                            <p><strong>Current status:</strong> {{ $favicon->is_active ? 'Active' : 'Inactive' }}</p>
                           </div>
                          <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                          <button type="submit" class="btn {{ $favicon->is_active ? 'btn-danger' : 'btn-success' }}">
                          {{ $favicon->is_active ? 'Deactivate' : 'Activate' }}
                       </button>
                      </div>
                    </div>
                   </form>
                </div>
             </div>

                          <!-- Edit Favicon Modal -->
                            <div class="modal fade" id="editFaviconModal{{ $favicon->id }}" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.favicons.update', $favicon->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Favicon</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <!-- Left Column -->
                                                    <div class="col-md-6">
                                                        @foreach (['fav_16', 'fav_32', 'fav_ico'] as $field)
                                                            <div class="mb-3">
                                                                <label>{{ ucfirst(str_replace('_', ' ', $field)) }}</label>
                                                                <input type="file" name="{{ $field }}" class="form-control">
                                                                @error($field)
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                                @if($favicon->{$field})
                                                                    <img src="{{ asset('uploads/favicons/'.$favicon->{$field}) }}" alt="{{ $field }}" width="50">
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <!-- Right Column -->
                                                    <div class="col-md-6">
                                                        @foreach (['fav_apple', 'fav_192', 'fav_512'] as $field)
                                                            <div class="mb-3">
                                                                <label>{{ ucfirst(str_replace('_', ' ', $field)) }}</label>
                                                                <input type="file" name="{{ $field }}" class="form-control">
                                                                @error($field)
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                                @if($favicon->{$field})
                                                                    <img src="{{ asset('uploads/favicons/'.$favicon->{$field}) }}" alt="{{ $field }}" width="50">
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Site Manifest URL</label>
                                                    <input type="url" name="site_manifest" class="form-control" value="{{ $favicon->site_manifest }}">
                                                    @error('site_manifest')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label>Is Active?</label>
                                                    <input type="checkbox" name="is_active" value="1" {{ $favicon->is_active ? 'checked' : '' }}>
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

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle status toggle
        document.querySelectorAll('.confirm-status-change').forEach(button => {
            button.addEventListener('click', function() {
                const faviconId = this.getAttribute('data-favicon-id');
                const modal = document.querySelector(`#statusModal${faviconId}`);
                const modalInstance = bootstrap.Modal.getInstance(modal);
                
                // Updated fetch request
                fetch(`/admin/favicons/${faviconId}/toggle-status`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Refresh the page to show updated status
                        window.location.reload();
                    } else {
                        alert('Failed to update status');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to update status');
                })
                .finally(() => {
                    if (modalInstance) {
                        modalInstance.hide();
                    }
                });
            });
        });
    });
</script>
@endpush

@endsection
