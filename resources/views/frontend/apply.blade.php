@extends('frontend.layouts.master')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Application For {{ $demand->vacancy }}</h1>
        <form id="applicationForm" action="{{ route('apply.store', ['id' => $demand->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">{{ trans('messages.Name') }}</label><span style="color:red; font-size:large"> *</span>
                <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">{{ trans('messages.Email') }}</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">{{ trans('messages.Address') }}</label>
                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}">
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="phone_no" class="form-label">{{ trans('messages.Phone Number') }}</label><span style="color:red; font-size:large"> *</span>
                <input type="tel" class="form-control @error('phone_no') is-invalid @enderror" id="phone_no" name="phone_no" value="{{ old('phone_no') }}" required>
                @error('phone_no')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="whatsapp_no" class="form-label">{{ trans('messages.WhatsApp Number') }}</label>
                <input type="tel" class="form-control @error('whatsapp_no') is-invalid @enderror" id="whatsapp_no" name="whatsapp_no" value="{{ old('whatsapp_no') }}">
                @error('whatsapp_no')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="cv" class="form-label">{{ trans('messages.Upload CV') }}</label><span style="color:red; font-size:large"> *</span>
                <input type="file" class="form-control @error('cv') is-invalid @enderror" id="cv" name="cv" required>
                @error('cv')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="photo" class="form-label">{{ trans('messages.Upload Photo') }}</label>
                <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo">
                @error('photo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="g-recaptcha" data-sitekey="6LdAPAoqAAAAADCgyV-AMkcB0Il2IkaZuAMlgjYx"></div>
            @if ($errors->has('g-recaptcha-response'))
                <div class="invalid-feedback d-block">{{ $errors->first('g-recaptcha-response') }}</div>
            @endif
            <button type="submit" class="apply-btn">Submit Application</button>
        </form>
    </div>
    <!-- Custom CSS -->
    <style>
        .apply-btn {
            background-color:#F9A002;
            color: whitesmoke;
            padding:10px;
            cursor: pointer;
            margin-top: 10px; /* Adjust spacing as needed */
            margin-bottom: 10px;
            border-radius: 4px;
            text-decoration: none; 
            display: inline-block; 
        }       

        .apply-btn:hover {
            background-color:rgba(100, 59, 19, 0.97);
            color: whitesmoke;
        }
    </style>

    <!-- JavaScript to validate reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        document.getElementById('applicationForm').addEventListener('submit', function(event) {
            var recaptcha = document.querySelector('.g-recaptcha-response');
            if (!recaptcha || recaptcha.value === '') {
                event.preventDefault();
                alert('Please tick the reCAPTCHA box before submitting.');
            }
        });
    </script>
@endsection
