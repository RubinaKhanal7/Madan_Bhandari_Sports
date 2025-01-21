@extends('portal.layouts.master')

@section('content')

<section class="contact_form">
    <div class="container">
        <h1 class="cat_title">
            {{ __('Contact') }}
        </h1>
        <div class="row mt-3">
            <div class="col-md-6 cform_left">
                <iframe src="{{ $sitesetting->google_map }}" width="600" height="450" style="border:0;"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

            <div class="col-md-6 cform_right">
                <form id="quick_contact" class="form-horizontal" method="POST" role="form" action="">
                    @csrf
                    <div class="form-group">

                        <input type="text" class="form-control" id="name" placeholder="NAME" name="name"
                            value="" required>

                    </div>

                    <div class="form-group">

                        <input type="email" class="form-control" id="email" placeholder="EMAIL"
                            name="email" value="" required>

                    </div>

                    <div class="form-group">


                        <input type="phone" name="phone" class="form-control" id="phone"
                            placeholder="Phone No." required>


                    </div>

                    <textarea class="form-control" rows="10" placeholder="MESSAGE" name="message" required></textarea>

                    <div class="card-footer">
                        <button type="submit" class="btn-style-one">Submit</button>
                    </div>

                    {{-- <div class="g-recaptcha" data-sitekey="your_site_key"></div> --}}




                    {{-- <button class="btn send-button g-recaptcha" id="submit" type="submit" value="SEND" data-sitekey="{{ config('services.recaptcha.site_key') }}"
                data-callback='onSubmit'
                data-action='submit'>
                    <div class="alt-send-button">
                        <i class="fa fa-paper-plane"></i><span class="send-text">Let's Connect</span>
                    </div>

                </button> --}}




                </form>
                <script>
                    function onSubmit(token) {
                        document.getElementById("quick_contact").submit();
                    }
                </script>
            </div>
        </div>
    </div>
</section>

@endsection
