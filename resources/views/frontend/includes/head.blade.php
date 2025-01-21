<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords"
        content="​Learn to Cook French Classics, Online Cooking Classes, ​Сooking Сlasses, ​A simple &amp;amp; delicious traditional cooking, Why Us">
    <meta name="description" content="">
    <title>National Art Museum Bhaktapur </title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('uploads/favicon/' . $favicon->apple_touch_icon) }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('uploads/favicon/' .$favicon->favicon_thirtyTwo) }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('uploads/favicon/' .$favicon->favicon_sixteen) }}">

    <link rel="manifest" href="{{ asset('uploads/favicon/file'.$favicon->file) }}">

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
    <script src="https://kit.fontawesome.com/160b82d057.js" crossorigin="anonymous"></script> --}}

    <link rel="icon" type="image/png" sizes="128x128" href="{{ asset('favicon.png') }}">

    <link rel="stylesheet" href="{{ asset('css/venobox.min.css') }}" type="text/css" media="screen" />
    {{-- <script class="u-script" type="text/javascript" src="{{ asset('js/jquery.js') }}" defer=""></script> --}}
   



    <script type="application/ld+json">
        {
		"@context": "http://schema.org",
		"@type": "Organization",
		"name": "",
		"logo": "images/vectorstock_28525730.png",
		"sameAs": [
				"https://facebook.com/name",
				"https://twitter.com/name",
				"https://www.instagram.com/name"
		]
    }
    </script>



    {{-- For Contact Form Recaptcha --}}
    {{-- <script>
        functon callbackThen(response){
            response.json().then(function(data){
                console.log(data);
                if(data.success && data.score > 0.5){
                    console.log('valid source');
                }else{
                    document.getElementById('quick_contact').addEventListener('submit', function(event){
                        event.preventDefault();
                        alert('recaptcha error. Stop Form Submission.');
                    });
                }
            });
        }
        function callbackCatch(error){
            console.log('Error: ' +error);
        }
    </script> --}}

    {!!htmlScriptTagJsApi([
        'callback_then' => 'callbackThen',
        'callback_catch' => 'callbackCatch'
    ]) !!}

  
    <!-- Styles -->
    <!--Bootstrap Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/060a077e75.js" crossorigin="anonymous"></script>


    <link href="{{ asset('css/style.css') }}" rel="stylesheet">


</head>
