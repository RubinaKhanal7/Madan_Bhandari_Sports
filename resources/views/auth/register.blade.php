<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('adminassets/assets/bootstrap/dist/css/bootstrap.min.css') }}" />
    <!-- Favicons and theme styles as per your login page -->
    
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ asset('adminassets/assets/img/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('adminassets/assets/img/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('adminassets/assets/img/favicons/favicon-16x16.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('adminassets/assets/img/favicons/favicon.ico') }}">
    <link href="{{ asset('adminassets/assets/css/theme.min.css') }}" rel="stylesheet" id="style-default">
    <link href="{{ asset('adminassets/assets/css/user.min.css') }}" rel="stylesheet" id="user-style-default">
    <link href="{{ asset('adminassets/assets/toastr/toastr.min.css') }}" rel="stylesheet">
</head>

<body>
    <style>
        .fa-eye{
            font-size: 24px;
        }
    </style>
@if (session('message'))
        <div class="alert alert-warning">
            {{ session('message') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <script>
        @if(Session::has('toast_message'))
            // Assuming you're using a toast library like Toastr
            toastr.success("{{ Session::get('toast_message') }}");
        @endif
    </script>


    <main class="main" id="top">
        <div class="container-fluid">
            <div class="row min-vh-100 flex-center g-0">
                <div class="col-lg-8 col-xxl-5 py-3 position-relative">
                    <div class="card overflow-hidden z-index-1">
                        <div class="card-body p-0">
                            <div class="row g-0 h-100">
                                <div class="col-md-5 text-center bg-card-gradient py-1">
                                    <div class="position-relative p-4  pb-md-7 light">
                                        <a class="link-light mb-1 font-sans-serif fs-4 d-inline-block fw-bolder"
                                            href="#">Welcome to Mandan Bhandari Sports Academy</a>
                                    </div>
                                    <img height="200" width="200" src="{{asset("image/about.jpg")}}" class="rounded">
                                </div>
                                <div class="col-md-7 d-flex flex-center">
                                    <div class="p-4 p-md-5 flex-grow-1">
                                        <h3>Register a New Account</h3>
                                        <form method="POST" action="{{ route('register') }}" id="registerForm" enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-3">
                                                <label class="form-label" for="name">Full Name</label>
                                                <input type="text" 
                                                       class="form-control @error('name') is-invalid @enderror" 
                                                       id="name" 
                                                       name="name" 
                                                       value="{{ old('name') }}" 
                                                       required 
                                                       autocomplete="name" 
                                                       autofocus>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="is_admin" id="isAdmin" value="1" onchange="toggleCitizenshipFields()">
                                                    <label class="form-check-label" for="isAdmin">
                                                        Are you an admin?
                                                    </label>
                                                </div>
                                            </div>
                                            
                                            <div id="citizenshipFields" style="display: none;" class="mb-3">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="form-label" for="citizenship_front">Citizenship Front <span class="text-danger">*</span></label>
                                                        <input type="file" 
                                                               class="form-control @error('citizenship_front') is-invalid @enderror" 
                                                               id="citizenship_front" 
                                                               name="citizenship_front" 
                                                               accept="image/jpeg,image/png,image/jpg">
                                                        <small class="text-muted">Accepted formats: JPG, JPEG, PNG (max 2MB)</small>
                                                        @error('citizenship_front')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label" for="citizenship_back">Citizenship Back <span class="text-danger">*</span></label>
                                                        <input type="file" 
                                                               class="form-control @error('citizenship_back') is-invalid @enderror" 
                                                               id="citizenship_back" 
                                                               name="citizenship_back" 
                                                               accept="image/jpeg,image/png,image/jpg">
                                                        <small class="text-muted">Accepted formats: JPG, JPEG, PNG (max 2MB)</small>
                                                        @error('citizenship_back')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                @error('citizenship')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                @error('image_upload')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                    
                                            <div class="mb-3">
                                                <label class="form-label" for="email">Email Address</label>
                                                <input type="email" 
                                                       class="form-control @error('email') is-invalid @enderror" 
                                                       id="email" 
                                                       name="email" 
                                                       value="{{ old('email') }}" 
                                                       required 
                                                       autocomplete="email">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                    
                                            <div class="mb-3">
                                                <label class="form-label" for="phonenumber">Phone Number</label>
                                                <input type="text" 
                                                       class="form-control @error('phonenumber') is-invalid @enderror" 
                                                       id="phonenumber" 
                                                       name="phonenumber" 
                                                       value="{{ old('phonenumber') }}" 
                                                       required>
                                                @error('phonenumber')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                    
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label class="form-label" for="password">Password</label>
                                                    <div class="input-group">
                                                        <input type="password" 
                                                               class="form-control @error('password') is-invalid @enderror" 
                                                               id="password" 
                                                               name="password" 
                                                               required>
                                                        <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('password', this)">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                    </div>
                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label" for="password-confirm">Confirm Password</label>
                                                    <div class="input-group">
                                                        <input type="password" 
                                                               class="form-control" 
                                                               id="password-confirm" 
                                                               name="password_confirmation" 
                                                               required>
                                                        <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('password-confirm', this)">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label class="form-label" for="pin">PIN</label>
                                                    <div class="input-group">
                                                        <input type="password" 
                                                               class="form-control @error('pin') is-invalid @enderror" 
                                                               id="pin" 
                                                               name="pin" 
                                                               maxlength="4">
                                                        <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('pin', this)">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                    </div>
                                                    @error('pin')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label" for="pin-confirm">Confirm PIN</label>
                                                    <div class="input-group">
                                                        <input type="password" 
                                                               class="form-control" 
                                                               id="pin-confirm" 
                                                               name="pin_confirmation" 
                                                               maxlength="4">
                                                        <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('pin-confirm', this)">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                                            <div id="recaptcha-error" style="color: red; font-size: 0.9rem; margin-top: 5px;"></div>
                                            
                                            <button class="btn btn-primary d-block w-100 mt-3"
                                                type="submit">Register</button>
                                        </form>
                                        <div class="text-center mt-3">
                                            <a href="{{ route('login') }}">Already have an account? Login</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- JavaScripts -->
    <script src="{{ asset('adminassets/assets/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('adminassets/vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('adminassets/vendors/fontawesome/all.min.js') }}"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            var response = grecaptcha.getResponse();
            var errorDiv = document.getElementById('recaptcha-error');
            errorDiv.textContent = '';
    
            if (response.length == 0) {
                event.preventDefault();
                errorDiv.textContent = "Please verify that you are not a robot.";
            }
        });
    </script>
    <script>
        function togglePassword(fieldId, element) {
            var inputField = document.getElementById(fieldId);
            var icon = element.querySelector('i');
            if (inputField.type === 'password') {
                inputField.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                inputField.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        function toggleCitizenshipFields() {
    const isAdmin = document.getElementById('isAdmin').checked;
    const citizenshipFields = document.getElementById('citizenshipFields');
    citizenshipFields.style.display = isAdmin ? 'block' : 'none';
}
    </script>
    <script>
        function validateFile(input) {
            const file = input.files[0];
            const maxSize = 2 * 1024 * 1024; // 2MB in bytes
            const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            
            if (file) {
                if (!allowedTypes.includes(file.type)) {
                    alert('Please select a valid image file (JPG, JPEG, or PNG)');
                    input.value = '';
                    return false;
                }
                
                if (file.size > maxSize) {
                    alert('File size must be less than 2MB');
                    input.value = '';
                    return false;
                }
            }
            return true;
        }
        
        document.getElementById('citizenship_front').addEventListener('change', function() {
            validateFile(this);
        });
        
        document.getElementById('citizenship_back').addEventListener('change', function() {
            validateFile(this);
        });
        
        function toggleCitizenshipFields() {
            const isAdmin = document.getElementById('isAdmin').checked;
            const citizenshipFields = document.getElementById('citizenshipFields');
            citizenshipFields.style.display = isAdmin ? 'block' : 'none';
            
            // Clear file inputs when hiding the fields
            if (!isAdmin) {
                document.getElementById('citizenship_front').value = '';
                document.getElementById('citizenship_back').value = '';
            }
        }
        </script>
</body>

</html>