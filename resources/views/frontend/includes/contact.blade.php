
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
 

 {{-- Display Success or Error Messages --}}
 @if(session('success'))
 <div class="alert alert-success">
     {{ session('success') }}
 </div>
@endif

@if(session('error'))
 <div class="alert alert-danger">
     {{ session('error') }}
 </div>
@endif
    <section class="container">
        {{-- <h1 class="page_title">Contact</h1> --}}
        <div class="d-flex flex-column justify-content-center my-5 row customconnectwithus">
            <div class="d-flex flex-column justify-content-center row">
                <div class="customconnectwithus-innersection d-flex justify-content-between">
                    <div class="customconnectwithus-innersection-left col-md-5">
                        <form id="contactForm" class="form-horizontal" method="POST" action="{{ route('Contact.store') }}">
                            @csrf
                            <div class="customconnectwithus-innersection-left_inputcontainer d-flex flex-column">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="NAME" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="customconnectwithus-innersection-left_inputcontainer d-flex flex-column">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="EMAIL" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="customconnectwithus-innersection-left_inputcontainer d-flex flex-column">
                                <input type="tel" class="form-control @error('phone_no') is-invalid @enderror" id="phone_no" placeholder="Phone No." name="phone_no" value="{{ old('phone_no') }}" required>
                                @error('phone_no')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="customconnectwithus-innersection-left_inputcontainer d-flex flex-column">
                                <textarea class="form-control message-box @error('message') is-invalid @enderror" rows="4" placeholder="MESSAGE" name="message" required>{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="customconnectwithus-innersection-left_inputcontainer d-flex flex-column my-1">
                                <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                                <div id="recaptchaError" class="text-danger mt-2"></div>
                            </div>
                            <div class="customconnectwithus-innersection-left_inputcontainer d-flex flex-column my-1">
                                <button type="submit" class="btn">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="customconnectwithus-innersection-right-map col-md-6">
                        <div class="py-2">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.0113295175297!2d85.33579181506206!3d27.688565432806747!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19954f2e09ab%3A0x7d94d308d87f4fa1!2sShantibinayak%20Marg%2C%20Kathmandu%2044600%2C%20Nepal!5e0!3m2!1sen!2snp!4v1627814296632!5m2!1sen!2snp"
                                width="100%"
                                height="400"
                                style="border:0;"
                                allowfullscreen=""
                                loading="lazy">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.getElementById('contactForm').addEventListener('submit', function(event) {
            var response = grecaptcha.getResponse();
            var recaptchaError = document.getElementById('recaptchaError');
            if (response.length === 0) {
                event.preventDefault();
                recaptchaError.textContent = "Please verify that you are not a robot.";
            } else {
                recaptchaError.textContent = ""; 
            }
        });
    </script>
