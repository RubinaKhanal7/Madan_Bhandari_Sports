<head>
    <?php
    use App\Models\Favicon;
    $favicon = Favicon::first();
    ?>

    <!-- Basic Page Needs -->
    {{-- <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Trademark Education Consultancy">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">

    <link rel="stylesheet" href="{{ asset('adminassets/assets/bootstrap/dist/css/bootstrap.min.css') }}" />

    <link rel="icon" type="image/png" href="{{ asset('uploads/favicon/' . ($favicon->favicon_ico ?? 'default-favicon.ico')) }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('uploads/favicon/' . ($favicon->apple_touch_icon ?? 'default-apple-touch-icon.png')) }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('uploads/favicon/' . ($favicon->favicon_thirtyTwo ?? 'default-favicon-32x32.png')) }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('uploads/favicon/' . ($favicon->favicon_sixteen ?? 'default-favicon-16x16.png')) }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('uploads/favicon/' . ($favicon->favicon_ico ?? 'default-favicon.ico')) }}">
    <link rel="manifest" href="{{ asset('uploads/favicon/file' . ($favicon->file ?? 'default-manifest.json')) }}">
    <link rel="manifest" href="{{ asset('uploads/favicon/file' . ($favicon->site_webmanifest ?? 'default-site-webmanifest.json')) }}">

    <meta name="msapplication-TileImage" content="{{ asset('adminassets/assets/img/favicons/mstile-150x150.png') }}">
    <meta name="theme-color" content="#ffffff">
    <script src="{{ asset('adminassets/assets/js/config.js') }}"></script>
    <script src="{{ asset('adminassets/vendors/overlayscrollbars/OverlayScrollbars.min.js') }}"></script>

    <meta name="author" content="BibekGuragain">
    <meta name="generator" content="Trademark Education Consultancy">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}"> --}}



    {{-- Nother Thingo --}}

    {{-- <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BP Wagle</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
   
    <link rel="icon" type="image/png" href="{{ asset('uploads/favicon/' . ($favicon->favicon_ico ?? 'default-favicon.ico')) }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('uploads/favicon/' . ($favicon->apple_touch_icon ?? 'default-apple-touch-icon.png')) }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('uploads/favicon/' . ($favicon->favicon_thirtyTwo ?? 'default-favicon-32x32.png')) }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('uploads/favicon/' . ($favicon->favicon_sixteen ?? 'default-favicon-16x16.png')) }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('uploads/favicon/' . ($favicon->favicon_ico ?? 'default-favicon.ico')) }}">
    <link rel="manifest" href="{{ asset('uploads/favicon/file' . ($favicon->file ?? 'default-manifest.json')) }}">
    <link rel="manifest" href="{{ asset('uploads/favicon/file' . ($favicon->site_webmanifest ?? 'default-site-webmanifest.json')) }}">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}" /> --}}


    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>BP Wagle</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
  
    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  
    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css" rel="stylesheet')}}">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  
  
  
    <link rel="stylesheet" href="css/owl.carousel.min.css">
      <link rel="stylesheet" href="css/owl.theme.default.min.css">
  
  
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
  
    <link rel="stylesheet" href="{{ asset('css/share-buttons.css') }}">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


    <link rel="stylesheet" href="{{ asset('css/style-old.css') }}" /> 

    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">


</head>
