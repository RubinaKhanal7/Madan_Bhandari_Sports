@extends('backend.layouts.master')

@section('content')
  
    <div class="card">
        <div class="card-header">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $page_title }}</h1>
                    
                </div>
                <div class="col-sm-6">
                   
                </div>
            </div>
        </div>
            @if(session('success'))
                <div class="alert alert-success border-2 d-flex align-items-center" role="alert">
                    <div class="bg-success me-3 icon-item"><span class="fas fa-check-circle text-white fs-3"></span></div>
                    <p class="mb-0 flex-1">{{ session('success') }}</p>
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                </div>
             @endif


        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Slogan</th>
                        <th>Email</th>
                        <th>Est.Year</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
            @forelse ($sitesettings as $sitesetting)
                <tr data-widget="expandable-table" aria-expanded="false">
                    <td width="5%">{{ $loop->iteration }}</td>
                    <td>{{ $sitesetting->title_en }}</td>
                    <td>{{ $sitesetting->slogan_en }}</td>
                    <td>
                        @php
                            $officeEmails = json_decode($sitesetting->email, true);
                        @endphp
                        @if (is_array($officeEmails))
                            @foreach ($officeEmails as $email)
                                {{ $email }} <br>
                            @endforeach
                        @else
                            {{ $sitesetting->email }}
                        @endif
                    </td>
                    <td>{{ $sitesetting->established_year }}</td>
                    <td>
                        @if($sitesetting->is_active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Inactive</span>
                        @endif
                    </td>
                    <td style="white-space: nowrap;">
                        <button type="button" class="btn btn-outline-primary btn-sm edit-btn" 
                                data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $sitesetting->id }}"
                                style="width: 32px;">
                            <i class="fas fa-edit"></i>
                        </button>
                        
                        <button type="button" class="btn btn-outline-info btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#socialMediaModal{{ $sitesetting->id }}"
                                style="width: 32px;">
                            S
                        </button>
                    </td>
                </tr>

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal{{ $sitesetting->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $sitesetting->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel{{ $sitesetting->id }}">Edit Site Settings</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="quickForm" method="POST" action="{{ route('admin.site-settings.update', $sitesetting->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="id" value="{{ $sitesetting->id }}">
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="title_ne">Title (Nepali)</label>
                                                <input type="text" name="title_ne" class="form-control" placeholder="Title in Nepali" value="{{ $sitesetting->title_ne }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="title_en">Title (English)</label>
                                                <input type="text" name="title_en" class="form-control" placeholder="Title in English" value="{{ $sitesetting->title_en }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="slogan_ne">Slogan (Nepali)</label>
                                                <input type="text" name="slogan_ne" class="form-control" placeholder="Slogan in Nepali" value="{{ $sitesetting->slogan_ne }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="slogan_en">Slogan (English)</label>
                                                <input type="text" name="slogan_en" class="form-control" placeholder="Slogan in English" value="{{ $sitesetting->slogan_en }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="main_logo">Main Logo</label>
                                                <input type="file" name="main_logo" class="form-control" accept="image/*">
                                                <div class="mt-2">
                                                    <img src="{{ asset('uploads/sitesetting/' . $sitesetting->main_logo) }}" style="max-width: 200px;" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="alt_logo">Alt Logo</label>
                                                <input type="file" name="alt_logo" class="form-control" accept="image/*">
                                                <div class="mt-2">
                                                    <img src="{{ asset('uploads/sitesetting/' . $sitesetting->alt_logo) }}" style="max-width: 200px;" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group" id="phone_no_container">
                                        <label for="phone_no">Phone Numbers</label>
                                        @foreach(json_decode($sitesetting->phone_no) as $phone)
                                            <div class="input-group mb-3">
                                                <input type="text" name="phone_no[]" class="form-control" placeholder="Phone Number" value="{{ $phone }}">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary remove-phone" type="button">-</button>
                                                    <button class="btn btn-outline-secondary add-phone" type="button">+</button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="form-group" id="email_container">
                                        <label for="email">Emails</label>
                                        @foreach(json_decode($sitesetting->email) as $email)
                                            <div class="input-group mb-3">
                                                <input type="email" name="email[]" class="form-control" placeholder="Email" value="{{ $email }}">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary remove-email" type="button">-</button>
                                                    <button class="btn btn-outline-secondary add-email" type="button">+</button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="established_year">Established Year</label>
                                                <input type="text" name="established_year" class="form-control" value="{{ $sitesetting->established_year }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="google_map">Google Maps Link</label>
                                                <input name="google_map" class="form-control" value="{{ $sitesetting->google_map }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="description_ne">Description (Nepali)</label>
                                                <textarea name="description_ne" class="form-control" rows="3">{{ $sitesetting->description_ne }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="description_en">Description (English)</label>
                                                <textarea name="description_en" class="form-control" rows="3">{{ $sitesetting->description_en }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Social Media Modal -->
                <div class="modal fade" id="socialMediaModal{{ $sitesetting->id }}" tabindex="-1"
                    aria-labelledby="socialMediaModalLabel{{ $sitesetting->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="socialMediaModalLabel{{ $sitesetting->id }}">Edit Social Media Links</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('admin.socialmedia.update', $sitesetting->socialmedia) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="facebook_link">Facebook Link</label>
                                            <input type="url" name="facebook_link" id="facebook_link" class="form-control"
                                                   value="{{ old('facebook_link', $sitesetting->socialMedia->facebook_link ?? '') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="instagram_link">Instagram Link</label>
                                            <input type="url" name="instagram_link" id="instagram_link" class="form-control"
                                                   value="{{ old('instagram_link', $sitesetting->socialMedia->instagram_link ?? '') }}">
                                        </div>
                                    </div>
                
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="snapchat_link">Snapchat Link</label>
                                            <input type="url" name="snapchat_link" id="snapchat_link" class="form-control"
                                                   value="{{ old('snapchat_link', $sitesetting->socialMedia->snapchat_link ?? '') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="linkedin_link">LinkedIn Link</label>
                                            <input type="url" name="linkedin_link" id="linkedin_link" class="form-control"
                                                   value="{{ old('linkedin_link', $sitesetting->socialMedia->linkedin_link ?? '') }}">
                                        </div>
                                    </div>
                
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="tiktok_link">TikTok Link</label>
                                            <input type="url" name="tiktok_link" id="tiktok_link" class="form-control"
                                                   value="{{ old('tiktok_link', $sitesetting->socialMedia->tiktok_link ?? '') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="youtube_link">YouTube Link</label>
                                            <input type="url" name="youtube_link" id="youtube_link" class="form-control"
                                                   value="{{ old('youtube_link', $sitesetting->socialMedia->youtube_link ?? '') }}">
                                        </div>
                                    </div>
                
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="twitter_link">Twitter Link</label>
                                            <input type="url" name="twitter_link" id="twitter_link" class="form-control"
                                                   value="{{ old('twitter_link', $sitesetting->socialMedia->twitter_link ?? '') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="embed_fbpage">Facebook Page Embed Code</label>
                                            <textarea name="embed_fbpage" id="embed_fbpage" class="form-control" rows="3">{{ old('embed_fbpage', $sitesetting->socialMedia->embed_fbpage ?? '') }}</textarea>
                                        </div>
                                    </div>
                
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <tr>
                    <td colspan="8">No data available</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Image Crop Modal -->
    <div class="modal fade" id="cropModal" tabindex="-1" aria-labelledby="cropModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cropModalLabel">Crop Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="image-preview" style="max-width: 100%; max-height: 400px; display: block;">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="saveCrop" class="btn btn-primary">Save Crop</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Handle dynamic phone number fields
    $(document).on('click', '.add-phone', function() {
        const container = $(this).closest('.input-group');
        const newInput = container.clone();
        newInput.find('input').val('');
        container.after(newInput);
    });

    $(document).on('click', '.remove-phone', function() {
        const container = $(this).closest('.input-group');
        if (container.siblings('.input-group').length > 0) {
            container.remove();
        }
    });

    // Handle dynamic email fields
    $(document).on('click', '.add-email', function() {
        const container = $(this).closest('.input-group');
        const newInput = container.clone();
        newInput.find('input').val('');
        container.after(newInput);
    });

    $(document).on('click', '.remove-email', function() {
        const container = $(this).closest('.input-group');
        if (container.siblings('.input-group').length > 0) {
            container.remove();
        }
    });

    // Image cropping functionality
    let cropper;
    let currentFile;
    let currentImageType;

    // Image file input change event for both logos
    $(document).on('change', 'input[type="file"]', function(e) {
        const imageType = $(this).attr('name');
        handleImageUpload(e, imageType);
    });

    function handleImageUpload(e, imageType) {
        const files = e.target.files;
        if (files && files.length > 0) {
            currentFile = files[0];
            currentImageType = imageType;
            const url = URL.createObjectURL(currentFile);
            const imagePreview = document.getElementById('image-preview');
            imagePreview.src = url;

            // Show the crop modal
            $('#cropModal').modal('show');

            if (cropper) {
                cropper.destroy();
            }
            cropper = new Cropper(imagePreview, {
                aspectRatio: 16 / 9,
                viewMode: 1,
            });
        }
    }

    // Save cropped image
    $('#saveCrop').click(function() {
        const cropData = cropper.getData();
        const cropDataString = JSON.stringify({
            width: Math.round(cropData.width),
            height: Math.round(cropData.height),
            x: Math.round(cropData.x),
            y: Math.round(cropData.y)
        });

        const base64Image = cropper.getCroppedCanvas().toDataURL('image/png');
        
        // Create hidden inputs for cropped image data if they don't exist
        let form = $(`input[name="${currentImageType}"]`).closest('form');
        
        let croppedInput = form.find(`input[name="${currentImageType}_cropped"]`);
        if (croppedInput.length === 0) {
            croppedInput = $('<input>').attr({
                type: 'hidden',
                name: `${currentImageType}_cropped`
            });
            form.append(croppedInput);
        }
        
        let cropDataInput = form.find(`input[name="${currentImageType}_crop_data"]`);
        if (cropDataInput.length === 0) {
            cropDataInput = $('<input>').attr({
                type: 'hidden',
                name: `${currentImageType}_crop_data`
            });
            form.append(cropDataInput);
        }

        // Update the preview image
        const previewContainer = $(`input[name="${currentImageType}"]`).closest('.form-group').find('img');
        if (previewContainer.length) {
            previewContainer.attr('src', base64Image);
        }

        // Set the cropped image data
        croppedInput.val(base64Image);
        cropDataInput.val(cropDataString);

        // Close modal
        $('#cropModal').modal('hide');
    });

    // Form validation
    $(function () {
        $('#quickForm').validate({
            rules: {
                title_en: {
                    required: true
                },
                title_ne: {
                    required: true
                },
                // Add other validation rules as needed
            },
            messages: {
                title_en: {
                    required: "Please enter the English title"
                },
                title_ne: {
                    required: "Please enter the Nepali title"
                },
                // Add other validation messages as needed
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
@endpush