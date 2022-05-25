<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    {!! SEO::generate(true) !!}

    <!-- Custom CSS -->
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">

    <!-- Custom Color Option -->
    <link href="{{ asset('assets/css/colors.css') }}" rel="stylesheet">

</head>

<body class="blue-skin">
<div id="preloader">
    <div class="preloader"><span></span><span></span></div>
</div>

<div id="main-wrapper">
    <!-- Start Navigation -->
    <div class="top-header">
        <div class="container">
            <div class="row">

                <div class="col-lg-6 col-md-6">
                    <div class="cn-info">
                        <ul>
                            <li><i class="lni-phone-handset"></i>91 256 584 5748</li>
                            <li><i class="ti-email"></i>support@nextdeals.rw</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <ul class="top-social">
                        <li><a href="#"><i class="lni-facebook"></i></a></li>
                        <li><a href="#"><i class="lni-linkedin"></i></a></li>
                        <li><a href="#"><i class="lni-instagram"></i></a></li>
                        <li><a href="#"><i class="lni-twitter"></i></a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <x-navigation-component></x-navigation-component>
    <div class="clearfix"></div>

    @yield('content')

</div>
<x-footer-component></x-footer-component>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/rangeslider.js') }}"></script>
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/typed.min.js')}}"></script>
<script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('assets/js/slick.js') }}"></script>
<script src="{{ asset('assets/js/slider-bg.js') }}"></script>
<script src="{{ asset('assets/js/lightbox.js') }}"></script>
<script src="{{ asset('assets/js/imagesloaded.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>

</body>
</html>
