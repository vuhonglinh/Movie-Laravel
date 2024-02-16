<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from flixtv.volkovdesign.com/admin/signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 14 Dec 2023 08:06:26 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('/backend/css/bootstrap-reboot.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/backend/css/bootstrap-grid.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/backend/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('/backend/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/backend/css/admin.css') }}">

    <!-- Favicons -->
    <link rel="icon" type="image/png" href="{{ asset('/backend/icon/favicon-32x32.png') }}" sizes="32x32">
    <link rel="apple-touch-icon" href="{{ asset('/backend/icon/favicon-32x32.png') }}">

    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Dmitry Volkov">
    <title>@yield('title')</title>

</head>

<body>
    <!-- sign in -->
     @yield('content')
    <!-- end sign in -->

    <!-- JS -->
    <script src="{{ asset('/backend/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('/backend/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/backend/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('/backend/js/smooth-scrollbar.js') }}"></script>
    <script src="{{ asset('/backend/js/select2.min.js') }}"></script>
    <script src="{{ asset('/backend/js/admin.js') }}"></script>
</body>

<!-- Mirrored from flixtv.volkovdesign.com/admin/signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 14 Dec 2023 08:06:27 GMT -->

</html>
