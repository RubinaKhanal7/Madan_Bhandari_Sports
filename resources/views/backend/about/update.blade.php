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
            <h1 class="m-0">{{ $page_title }}</h1>
            <a href="{{ url('admin') }}"><button class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i>
                    Back</button></a>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form id="quickForm" method="POST" action="{{ route('admin.about-us.update', $about->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $about->id }}">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" id="title"
                        value="{{ $about->title ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="subtitle">Subtitle</label><span style="color:red; font-size:large"> *</span>
                    <input style="width:auto;" type="text" name="subtitle" class="form-control" id="subtitle"
                        placeholder="Subtitle" value="{{ $about->subtitle }}">
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" class="form-control" id="image" onchange="previewImage(event)">
                    <img id="preview1" src="{{ asset('uploads/about/' . $about->image) }}"
                        style="max-width: 300px; max-height:300px" />
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Description</label>
                    <textarea style="width: 100%; min-height: 150px;" type="text" class="form-control" name="description"
                        id="description" placeholder="Add Description">{{ $about->description ?? '' }}</textarea>
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea id="summernote" name="content" style="width: 100%; min-height: 150px;">
                        {{ $about->content }}
                    </textarea>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </section>

    <!-- Main row -->
    <script>
        const previewImage = e => {
            const reader = new FileReader();
            reader.readAsDataURL(e.target.files[0]);
            reader.onload = () => {
                const preview = document.getElementById('preview1');
                preview.src = reader.result;
            };
        };

        $(document).ready(function() {
            $('#summernote').summernote({
                height: 150, // set editor height
                minHeight: null, // set minimum height of editor
                maxHeight: null, // set maximum height of editor
                focus: true // set focus to editable area after initializing summernote
            });
        });
    </script>
@endsection
