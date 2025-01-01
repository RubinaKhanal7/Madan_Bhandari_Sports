@extends('frontend.layouts.master')
@section('content')
    <div class="page-title dark-background">
        <div class="container position-relative">
            <h1>Contact</h1>
            <p>Stay updated with the latest news, upcoming performances, and events in my musical journey.</p>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="">Home</a></li>
                    <li class="current">Contact</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->



    <section class="contact section">

        <!-- Section Title -->


        <div class="container" data-aos="fade-up" data-aos-delay="100">

          <div class="info-wrap" data-aos="fade-up" data-aos-delay="200">
              <div class="row gy-5">
  
                  <div class="col-lg-4">
                      <div class="info-item d-flex align-items-center">
                          <i class="bi bi-geo-alt flex-shrink-0"></i>
                          <div>
                              <h3>Meet Me</h3>
                              <p>
                                  @if (!empty($sitesetting->office_address))
                                      @php
                                          $officeAddresses = json_decode($sitesetting->office_address, true);
                                      @endphp
                                      @if (is_array($officeAddresses))
                                          @foreach ($officeAddresses as $address)
                                              {{ $address }} <br>
                                          @endforeach
                                      @else
                                          @if (app()->getLocale() == 'ne')
                                              {{ $sitesetting->office_address_ne }}
                                          @else
                                              {{ $sitesetting->office_address }}
                                          @endif
                                      @endif
                                  @endif
  
                              </p>
                          </div>
                      </div>
                  </div><!-- End Info Item -->
  
                  <div class="col-lg-4">
                      <div class="info-item d-flex align-items-center">
                          <i class="bi bi-telephone flex-shrink-0"></i>
                          <div>
                              <h3>Reach Me<br></h3>
                              <p>
                                  @if (!empty($sitesetting->office_contact))
                                      @php
                                          $officeContacts = json_decode($sitesetting->office_contact, true);
                                      @endphp
                                      @if (is_array($officeContacts))
                                          @foreach ($officeContacts as $contact)
                                              {{ $contact }} <br>
                                          @endforeach
                                      @else
                                          @if (app()->getLocale() == 'ne')
                                              {{ $sitesetting->office_contact_ne }}
                                          @else
                                              {{ $sitesetting->office_contact }}
                                          @endif
                                      @endif
                                  @endif
                              </p>
                          </div>
                      </div>
                  </div><!-- End Info Item -->
  
                  <div class="col-lg-4">
                      <div class="info-item d-flex align-items-center">
                          <i class="bi bi-envelope flex-shrink-0"></i>
                          <div>
                              <h3>Email Me</h3>
                              <p>
                                  @if (!empty($sitesetting->office_email))
                                      @php
                                          $officeEmails = json_decode($sitesetting->office_email, true);
                                      @endphp
                                      @if (is_array($officeEmails))
                                          @foreach ($officeEmails as $email)
                                              {{ $email }} <br>
                                          @endforeach
                                      @else
                                          {{ $sitesetting->office_email }} <br>
                                      @endif
                                  @endif
                              </p>
                          </div>
                      </div>
                  </div><!-- End Info Item -->
  
              </div>
          </div>
          <form id="contactForm" class="form-horizontal row" method="POST" action="{{ route('Contact.store') }}">
              @csrf
              <div class="customconnectwithus-innersection-left_inputcontainer col-md-4">
                  <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                      placeholder="NAME" name="name" value="{{ old('name') }}" required>
                  @error('name')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
              <div class="customconnectwithus-innersection-left_inputcontainer col-md-4">
                  <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                      placeholder="EMAIL" name="email" value="{{ old('email') }}" required>
                  @error('email')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
              <div class="customconnectwithus-innersection-left_inputcontainer col-md-4">
                  <input type="tel" class="form-control @error('phone_no') is-invalid @enderror" id="phone_no"
                      placeholder="Phone No." name="phone_no" value="{{ old('phone_no') }}" required>
                  @error('phone_no')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
              <div class="customconnectwithus-innersection-left_inputcontainer col-md-12">
                  <textarea class="form-control message-box @error('message') is-invalid @enderror" rows="4" placeholder="MESSAGE"
                      name="message" required>{{ old('message') }}</textarea>
                  @error('message')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
              </div>
              <div class="customconnectwithus-innersection-left_inputcontainer d-flex flex-column my-1">
                  <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                  <div id="recaptchaError" class="text-danger mt-2"></div>
              </div>
              <div class="php-email-form text-center">
                  <button type="submit">Submit</button>
              </div>
          </form>
  
      </div>

    </section><!-- /Contact Section -->
@endsection
