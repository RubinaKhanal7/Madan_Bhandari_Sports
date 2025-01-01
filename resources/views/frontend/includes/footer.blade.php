{{-- <footer class="footer-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                
                <h3>{{ $sitesetting->office_name }}</h3>

                <div class="single-cta">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                    <div class="cta-text">
                        <h4>
                       
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
                       
                    </h4> 
                    </div>
                </div>


                <div class="single-cta">
                    <i class="fa fa-phone" aria-hidden="true"></i>
                    <div class="cta-text">
                        <h4>
                       
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
                        </h4>
                    </div>
                </div>


                <div class="single-cta">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    <div class="cta-text">
                        <h4>
                        
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
                        </h4>
                    </div>
                </div>


            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
             
                <div class="footer-social-icon">
                    <h4>Follow Us</h4>
                    <div class="social-buttons">
                        <a href="{{ $sitesetting->facebook_link ?? '#' }}"
                            class="social-buttons__button social-button social-button--facebook" aria-label="Facebook">
                            <span class="social-button__inner">
                                <i class="fab fa-facebook-f"></i>
                            </span>
                        </a>
                        <a href="{{ $sitesetting->linkedin_link ?? '#' }}"
                            class="social-buttons__button social-button social-button--linkedin" aria-label="LinkedIn">
                            <span class="social-button__inner">
                                <i class="fab fa-linkedin-in"></i>
                            </span>
                        </a>
                        <a href="{{ $sitesetting->instagram_link ?? '#' }}" target="_blank"
                            class="social-buttons__button social-button social-button--instagram" aria-label="Instagram">
                            <span class="social-button__inner">
                                <i class="fab fa-instagram"></i>
                            </span>
                        </a>
                        <a href="{{ $sitesetting->snapchat_link ?? '#' }}" target="_blank"
                            class="social-buttons__button social-button social-button--snapchat" aria-label="Snapchat">
                            <span class="social-button__inner">
                                <i class="fa-brands fa-snapchat"></i>
                            </span>
                        </a>
                        <a href="{{ $sitesetting->youtube_link ?? '#' }}" target="_blank"
                            class="social-buttons__button social-button social-button--youtube" aria-label="YouTube">
                            <span class="social-button__inner">
                                <i class="fab fa-youtube"></i>
                            </span>
                        </a>
                        <a href="{{ $sitesetting->twitter_link ?? '#' }}" target="_blank"
                            class="social-buttons__button social-button social-button--twitter" aria-label="Twitter">
                            <span class="social-button__inner">
                                <i class="fa-brands fa-x-twitter"></i>
                            </span>
                        </a>
                        <a href="{{ $sitesetting->tiktok_link ?? '#' }}" target="_blank"
                            class="social-buttons__button social-button social-button--linkedin" aria-label="Tiktok">
                            <span class="social-button__inner">
                                <i class="fa-brands fa-tiktok"></i>
                            </span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</footer>

<div class="copyright-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="copyright-text text-center">
                    <p>Copyright &copy; 2024, All Right Reserved {{ $sitesetting->office_name ?? 'Your Company Name' }}
                        <br>
                        <span>Developed by <a href="https://aashatech.com">Aasha Tech</a></span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div> --}}



<footer id="footer" class="footer light-background">
    <div class="container">
      <h3 class="sitename">{{ $sitesetting->office_name }}</h3>
      <p>{{ $sitesetting->slogan }}</p>
      <div class="social-links d-flex justify-content-center">
        <a href="{{ $sitesetting->twitter_link }}"><i class="bi bi-twitter-x"></i></a>
        <a href="{{ $sitesetting->facebook_link }}"><i class="bi bi-facebook"></i></a>
        <a href="{{ $sitesetting->instagram_link }}"><i class="bi bi-instagram"></i></a>
        <a href="{{ $sitesetting->linkedin_link }}"><i class="bi bi-linkedin"></i></a>
        <a href="{{ $sitesetting->linkedin_link }}"><i class="bi bi-tiktok"></i></a>
        <a href="{{ $sitesetting->linkedin_link }}"><i class="bi bi-youtube"></i></a>

      </div>
      <!-- <div class="container">
        <div class="copyright">
          <span>Copyright</span> <strong class="px-1 sitename">Folio</strong> <span>All Rights Reserved</span>
        </div>
        <div class="credits">
      
          Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
      </div> -->
    </div>
  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  {{-- <div id="preloader"></div> --}}





  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/vendor/typed.js/typed.umd.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>



  
  <!-- Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>


<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/share-buttons.js') }}"></script>

{{-- 
<script type="application/json" class="swiper-config">
    {
      "loop": true,
      "speed": 600,
      "autoplay": {
        "delay": 5000
      },
      "slidesPerView": "auto",
      "pagination": {
        "el": ".swiper-pagination",
        "type": "bullets",
        "clickable": true
      }
    }
  </script> --}}
