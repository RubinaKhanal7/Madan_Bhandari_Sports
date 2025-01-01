<header id="header" class="header d-flex align-items-center fixed-top">
  <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

    <a href="{{ route('index') }}" class="logo d-flex align-items-center">
      <!-- Uncomment the line below if you also wish to use an image logo -->
       <img src="{{ asset('uploads/sitesetting/'. $sitesetting->main_logo) }}" alt="">
      <h1 class="sitename">{{ $sitesetting->office_name }}</h1>
    </a>

    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="{{ route('index') }}" class="{{ Request::routeIs('index') ? 'active' : '' }}">Home</a></li>
        <li><a href="{{ route('About') }}" class="{{ Request::routeIs('About') ? 'active' : '' }}">Introduction</a></li>
        <li><a href="{{ route('Service') }}" class="{{ Request::routeIs('Service') ? 'active' : '' }}">Awards & Achievements</a></li>
        <li class="dropdown">
          <a href="#" class="{{ Request::routeIs('Gallery') || Request::routeIs('Video') ? 'active' : '' }}">
            <span>Gallery</span> <i class="bi bi-chevron-down toggle-dropdown"></i>
          </a>
          <ul>
            <li><a href="{{ route('Gallery') }}" class="{{ Request::routeIs('Gallery') ? 'active' : '' }}">Photo Gallery</a></li>
            <li><a href="{{ route('Video') }}" class="{{ Request::routeIs('Video') ? 'active' : '' }}">Video Gallery</a></li>
          </ul>
        </li>
        <li><a href="{{ route('NewsandEvents') }}" class="{{ Request::routeIs('NewsandEvents') ? 'active' : '' }}">News & Events</a></li>
        {{-- <li><a href="{{ route('Blogpostcategory') }}" class="{{ Request::routeIs('Blogpostcategory') ? 'active' : '' }}">Articles</a></li> --}}
        <li><a href="{{ route('Contact') }}" class="{{ Request::routeIs('Contact') ? 'active' : '' }}">Contact</a></li>
      </ul>
      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>

  </div>
</header>
