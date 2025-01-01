<div class="header">
    <nav class="navbar navbar-expand-lg" id="navbar">
        <div class="container">
            <!-- Logo Section -->
            <a class="navbar-brand" href="{{ route('index') }}">
                <div class="image">
                    @if (!empty($sitesetting->main_logo))
                        <img src="{{ asset('uploads/sitesetting/' . $sitesetting->main_logo) }}" alt="Main Logo" height="75">
                    @else
                        <img src="{{ asset('image/header-image.png') }}" alt="Default Logo" height="75">
                    @endif
                </div>
            </a>

            <!-- Toggler for mobile view -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu Section -->
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav ms-auto navbar-nav-scroll" style="--bs-scroll-height: 500px;">
                    <li class="nav-item">
                        <a class="nav-link text-primary {{ Route::is('index') ? 'active' : '' }}" href="{{ route('index') }}">Home</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link text-primary {{ Route::is('About') ? 'active' : '' }}" href="{{ route('About') }}">Introduction</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-primary {{ Route::is('Team') ? 'active' : '' }}" href="{{ route('Team') }}">Teams</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link text-primary {{ Route::is('NewsandEvents') ? 'active' : '' }}" href="{{ route('NewsandEvents') }}">News and Events</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-primary {{ Request::is('Gallery*') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Gallery
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item {{ Route::is('Gallery') ? 'active' : '' }}" href="{{ route('Gallery') }}">Images</a></li>
                            <li><a class="dropdown-item {{ Route::is('Video') ? 'active' : '' }}" href="{{ route('Video') }}">Videos</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-primary {{ Route::is('Blogpostcategory') ? 'active' : '' }}" href="{{ route('Blogpostcategory') }}">Blogs</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-primary {{ Route::is('Contact') ? 'active' : '' }}" href="{{ route('Contact') }}">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
