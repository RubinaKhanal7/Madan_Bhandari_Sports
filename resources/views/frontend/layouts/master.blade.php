<!DOCTYPE html>
<html style="font-size: 16px;" lang="en">
    <?php
    use App\Models\Favicon;
        $favicon = Favicon::first();
    ?>
@include('portal.includes.topnav')
@include('portal.includes.head')

<body onload=updateClock();  class="u-body u-xl-mode" data-lang="en">

    {{-- <div id="preloader">
        <div id="loader"></div>
    </div> --}}
    


    @include('portal.includes.navbar')


    @include('portal.includes.breakingnews')

    @yield('content')


    @include('portal.includes.footer')

    <?php


    // if($_SERVER['REQUEST_METHOD']=="POST"){

    //     if(isset($_POST['g-recaptcha-response'])){
    //         $token = $_POST['g-recaptcha-response'];
    //         $url = 'https://www.google.com/recaptcha/api/siteverify';
    //         $data = array(
    //             'secret_key' => '6LcPq34lAAAAAM7d-M8AxKtWjvHlmqYnNDRH5-D-',
    //             'response' => $token
    //         );

    //         $options = array(
    //             'http' => array (
    //                 'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
    //                 'method' => 'POST',
    //                 'content' => http_build_query($data)
    //             )
    //         );

    //         $context  = stream_context_create($options);
    //         $result = file_get_contents($url, false, $context);
    //         $response = json_decode($result);


    //         if ($response->success && $response->score >= 0.5) {
    //             echo json_encode(array('success' => true, "msg"=>"You are not a robot!", "response"=>$response));
    //         } else {

    //             echo json_encode(array('success' => false, "msg"=>"You are a robot!", "response"=>$response));
    //         }
    //     }
    // }

    ?>

    <script src="{{ asset('css/bootstrapjs/bootstrap.min.js') }}"></script>



</body>

</html>





{{-- @endsection --}}
