@extends('backend.layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
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
        
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('admin.teams.index') }}">
                            <button class="btn btn-primary btn-sm">
                                <i class="fa fa-arrow-left"></i> Back
                            </button>
                        </a>
                        Edit Team Member
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.teams.update', $team->id ) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input name="id" value="{{ $team->id }}" hidden>
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ old('name', $team->name) }}" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="position">Position:</label>
                                <input type="text" name="position" id="position" class="form-control"
                                    value="{{ old('position', $team->position) }}" required>
                                @error('position')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="phone_no">Phone Number:</label>
                                <input type="text" name="phone_no" id="phone_no" class="form-control"
                                    value="{{ old('phone_no', $team->phone_no) }}" required>
                                @error('phone_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="role">Role:</label>
                            
                                <select id="role" class="form-control @error('role') is-invalid @enderror" name="role">
                                    <option value="Executive Team" {{ ($team->role) == 'Executive Team' ? 'selected' : '' }}>
                                        Executive Team
                                    </option>
                                    <option value="Advisory Team" {{ ($team->role) == 'Advisory Team' ? 'selected' : '' }}>
                                        Advisory Team
                                    </option>
                                    <option value="Others" {{ ($team->role) == 'Others' ? 'selected' : '' }}>
                                        Others
                                    </option>
                                </select>
                                
                                @error('role')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            


                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    value="{{ old('email', $team->email) }}">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Description:</label>

                                <textarea style="width: 100%; min-height: 150px;" type="text" class="form-control summernote @error('description') is-invalid @enderror" name="description"
                                id="summernote" placeholder="Add Description">{{ old('description', $team->description)}}</textarea>

                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>



                            <div class="form-group">
                                <label for="image">Update Image:</label>
                                <input type="file" name="image" id="image" class="form-control-file"
                                    accept="image/*" onchange="previewImage(event)">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <img id="preview" src="{{ asset('uploads/team/' . $team->image) }}" alt="Current Image"
                                    style="max-width: 100%; max-height: 200px;">
                            </div>


                            <label>Status</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="active" value="1" 
                                    {{ $team->status == 1 ? 'checked' : '' }} required>
                                <label class="form-check-label" for="active">
                                    Active
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="inactive" value="0" 
                                    {{ $team->status == 0 ? 'checked' : '' }} required>
                                <label class="form-check-label" for="inactive">
                                    Inactive
                                </label>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const previewImage = (event) => {
            const preview = document.getElementById('preview');
            preview.src = URL.createObjectURL(event.target.files[0]);
            preview.onload = () => {
                URL.revokeObjectURL(preview.src);
            };
        };


        $(document).ready(function() {
            $('#summernote').summernote({
                height: 300, // set editor height
                minHeight: null, // set minimum height of editor
                maxHeight: null, // set maximum height of editor
                focus: true // set focus to editable area after initializing summernote
            });
        });
    </script>
@endsection
