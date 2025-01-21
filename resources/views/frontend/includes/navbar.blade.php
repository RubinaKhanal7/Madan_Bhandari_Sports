
{{-- <nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="toggler-icon">
                <i class="fas fa-bars"></i>
            </span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home') }}">{{ __('Home') }}</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownAbout" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ __('About Us') }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownAbout">
                        <li><a class="dropdown-item" href="{{ route('About') }}">Introduction</a></li>
                        <li><a class="dropdown-item" href="{{ route('Orgchart') }}">Our Structure</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('Team') }}">{{ __('Employee Details') }}</a>
                </li>
              
                @foreach ($contextnav as $context )
                    
              
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('information_page', $context->id) }}">{{ __($context->title) }}</a>
                </li>

                @endforeach

                <li class="nav-item dropdown {{ request()->is('videos', 'gallery') ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle {{ request()->is('videos', 'gallery') ? 'active' : '' }}" href="#" id="navbarDropdownGallery" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ __('Gallery') }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownGallery">
                        <li><a class="dropdown-item {{ request()->is('gallery') ? 'active' : '' }}" href="{{ route('Images') }}">Photo Gallery</a></li>
                        <li><a class="dropdown-item {{ request()->is('videos') ? 'active' : '' }}" href="{{ route('Videos') }}">Video Gallery</a></li>
                    </ul>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('Contact') }}">{{ __('Contact') }}</a>
                </li>
            </ul>
        </div>
    </div>
</nav> --}}



<nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="toggler-icon">
                <i class="fas fa-bars"></i>
            </span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home') }}">{{ __('Home') }}</a>
                </li>
                <li class="nav-item dropdown {{ request()->is('about', 'orgchart') ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle {{ request()->is('about', 'orgchart') ? 'active' : '' }}" href="#" id="navbarDropdownAbout" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ __('About Us') }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownAbout">
                        <li><a class="dropdown-item {{ request()->is('about') ? 'active' : '' }}" href="{{ route('About') }}">{{ __('Introduction') }}</a></li>
                        <li><a class="dropdown-item {{ request()->is('orgchart') ? 'active' : '' }}" href="{{ route('Orgchart') }}">{{ __('Organizational Chart') }}</a></li>
                    </ul>
                </li>
                <li class="nav-item {{ request()->is('team') ? 'active' : '' }}">
                    <a class="nav-link {{ request()->is('team') ? 'active' : '' }}" href="{{ route('Team') }}">{{ __('Employee Details') }}</a>
                </li>
                @foreach ($contextnav as $context)
                <li class="nav-item {{ request()->is('information_page/' . $context->id) ? 'active' : '' }}">
                    <a class="nav-link {{ request()->is('information_page/' . $context->id) ? 'active' : '' }}" href="{{ route('information_page', $context->id) }}">{{ __($context->title) }}</a>
                </li>
                @endforeach
            
            
                <li class="nav-item dropdown {{ request()->is('gallery', 'videos') ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle {{ request()->is('gallery', 'videos') ? 'active' : '' }}" href="#" id="navbarDropdownGallery" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ __('Gallery') }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownGallery">
                        <li><a class="dropdown-item {{ request()->is('gallery') ? 'active' : '' }}" href="{{ route('Images') }}">Photo Gallery</a></li>
                        <li><a class="dropdown-item {{ request()->is('videos') ? 'active' : '' }}" href="{{ route('Videos') }}">Video Gallery</a></li>
                    </ul>
                </li>
                
                <li class="nav-item {{ request()->is('contact_page') ? 'active' : '' }}">
                    <a class="nav-link {{ request()->is('contact_page') ? 'active' : '' }}" href="{{ route('Contact') }}">{{ __('Contact') }}</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
  $(document).ready(function() {
        $('.navbar-toggler').click(function() {
            $('.navbar-collapse').collapse('toggle');
        });

        $('.nav-link').click(function() {
            $('.nav-link').removeClass('active');
            $(this).addClass('active');
            $('.navbar-collapse').collapse('hide');
        });

        $('.navbar-nav>li>a').on('click', function(){
            $('.navbar-collapse').collapse('hide');
        });
    });
</script>
