@extends('backend.layouts.master')

@section('content')
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

    <div class="row mb-0"> 
        <div class="col-sm-6">
            <h1 class="m-0">{{ $page_title }}</h1>
            <a href="{{ url('admin') }}"><button class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back</button></a>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <form id="quickForm" method="POST" action="{{ route('admin.site-settings.update', $sitesetting->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $sitesetting->id }}">
            <div class="card-body">
                <div class="form-group">
                    <label for="title_ne">Title (Nepali)</label>
                    <input type="text" name="title_ne" class="form-control" placeholder="Title in Nepali" id="title_ne" value="{{ $sitesetting->title_ne }}">
                </div>

                <div class="form-group">
                    <label for="title_en">Title (English)</label>
                    <input type="text" name="title_en" class="form-control" placeholder="Title in English" id="title_en" value="{{ $sitesetting->title_en }}">
                </div>

                <div class="form-group">
                    <label for="slogan_ne">Slogan (Nepali)</label>
                    <input type="text" name="slogan_ne" class="form-control" placeholder="Slogan in Nepali" id="slogan_ne" value="{{ $sitesetting->slogan_ne }}">
                </div>

                <div class="form-group">
                    <label for="slogan_en">Slogan (English)</label>
                    <input type="text" name="slogan_en" class="form-control" placeholder="Slogan in English" id="slogan_en" value="{{ $sitesetting->slogan_en }}">
                </div>

                <div class="form-group">
                    <label for="main_logo">Main Logo</label>
                    <input type="file" name="main_logo" class="form-control" placeholder="Main Logo" id="main_logo" accept="image/*">
                    <div class="mt-2" id="main-logo-preview-container">
                        <img id="main_preview" src="{{ asset('uploads/sitesetting/' . $sitesetting->main_logo) }}" style="max-width: 300px; max-height:300px" />
                    </div>
                </div>
    
                <div class="form-group">
                    <label for="alt_logo">Alt Logo</label>
                    <input type="file" name="alt_logo" class="form-control" placeholder="Alt Logo" id="alt_logo" accept="image/*">
                    <div class="mt-2" id="alt-logo-preview-container">
                        <img id="alt_preview" src="{{ asset('uploads/sitesetting/' . $sitesetting->alt_logo) }}" style="max-width: 300px; max-height:300px" />
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

                <div class="form-group">
                    <label for="established_year">Established Year</label>
                    <input type="text" name="established_year" class="form-control" placeholder="Established Year" id="established_year" value="{{ $sitesetting->established_year }}">
                </div>

                <div class="form-group">
                    <label for="description_ne">Description (Nepali)</label>
                    <textarea name="description_ne" class="form-control" placeholder="Description in Nepali" id="description_ne">{{ $sitesetting->description_ne }}</textarea>
                </div>

                <div class="form-group">
                    <label for="description_en">Description (English)</label>
                    <textarea name="description_en" class="form-control" placeholder="Description in English" id="description_en">{{ $sitesetting->description_en }}</textarea>
                </div>

                <div class="form-group">
                    <label for="google_map">Google Maps Link</label>
                    <input name="google_map" class="form-control" placeholder="Google Maps Link (https://)" id="google_map" value="{{ $sitesetting->google_map }}">
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>

    <!-- Modal for Image Cropping -->
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

    <script>
        let cropper;
        let currentFile;
        let currentImageType;

        // Image file input change event for both logos
        document.getElementById('main_logo').addEventListener('change', function(e) {
            handleImageUpload(e, 'main_logo');
        });

        document.getElementById('alt_logo').addEventListener('change', function(e) {
            handleImageUpload(e, 'alt_logo');
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

        // Save cropped image data and update hidden input fields
        document.getElementById('saveCrop').addEventListener('click', function () {
            const cropData = cropper.getData();
            const cropDataString = JSON.stringify({
                width: Math.round(cropData.width),
                height: Math.round(cropData.height),
                x: Math.round(cropData.x),
                y: Math.round(cropData.y)
            });

            const base64Image = cropper.getCroppedCanvas().toDataURL('image/png');

            if (currentImageType === 'main_logo') {
                document.getElementById('main_logo_cropped').value = base64Image;
                document.getElementById('main_logo_crop_data').value = cropDataString;
                document.getElementById('main_preview').src = base64Image;
            } else if (currentImageType === 'alt_logo') {
                document.getElementById('alt_logo_cropped').value = base64Image;
                document.getElementById('alt_logo_crop_data').value = cropDataString;
                document.getElementById('alt_preview').src = base64Image;
            }

            // Close modal after saving crop
            $('#cropModal').modal('hide');
        });
    </script>
@endsection