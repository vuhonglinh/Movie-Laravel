<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from hotflix.volkovdesign.com/main/index2.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 18 Dec 2023 15:43:20 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('/client/css/bootstrap-reboot.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/client/css/bootstrap-grid.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/client/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/client/css/jquery.mCustomScrollbar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/client/css/nouislider.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/client/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/client/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('/client/css/plyr.css') }}">
    <link rel="stylesheet" href="{{ asset('/client/css/photoswipe.css') }}">
    <link rel="stylesheet" href="{{ asset('/client/css/default-skin.css') }}">
    <link rel="stylesheet" href="{{ asset('/client/css/main.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Favicons -->
    <link rel="icon" type="image/png" href="{{ asset('/client/icon/favicon-32x32.png') }}" sizes="32x32">
    <link rel="apple-touch-icon" href="icon/favicon-32x32.png">

    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Dmitry Volkov">
    <title>@yield('title')</title>
</head>

<body class="body">
    <!-- header -->
    @include('part.client.header')
    <!-- end header -->

    @yield('content')

    <!-- footer -->
    @include('part.client.footer')
    <!-- end footer -->

    <!-- JS -->
    <script src="{{ asset('/client/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('/client/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/client/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('/client/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('/client/js/jquery.mousewheel.min.js') }}"></script>
    <script src="{{ asset('/client/js/jquery.mCustomScrollbar.min.js') }}"></script>
    <script src="{{ asset('/client/js/wNumb.js') }}"></script>
    <script src="{{ asset('/client/js/nouislider.min.js') }}"></script>
    <script src="{{ asset('/client/js/plyr.min.js') }}"></script>
    <script src="{{ asset('/client/js/photoswipe.min.js') }}"></script>
    <script src="{{ asset('/client/js/photoswipe-ui-default.min.js') }}"></script>
    <script src="{{ asset('/client/js/main.js') }}"></script>
    @yield('scripts')
</body>

<!-- Mirrored from hotflix.volkovdesign.com/main/index2.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 18 Dec 2023 15:43:20 GMT -->

</html>
