<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from flixtv.volkovdesign.com/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 14 Dec 2023 08:06:17 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('/backend/css/bootstrap-reboot.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap-grid.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/admin.css') }}">

    <!-- Favicons -->
    <link rel="icon" type="image/png" href="{{ asset('backend/icon/favicon-32x32.png" sizes="32x32') }}">
    <link rel="apple-touch-icon" href="{{ asset('backend/icon/favicon-32x32.png') }}">

    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Dmitry Volkov">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- header -->
    @include('part.admin.header')
    <!-- end header -->

    <!-- sidebar -->
    @include('part.admin.sidebar')
    <!-- end sidebar -->

    <!-- main content -->
    @yield('content')
    <!-- end main content -->

    <!-- JS -->
    <script src="{{ asset('/backend/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('/backend/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('/backend/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/backend/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('/backend/js/smooth-scrollbar.js') }}"></script>
    <script src="{{ asset('/backend/js/select2.min.js') }}"></script>
    <script src="{{ asset('/backend/js/admin.js') }}"></script>
    <script src="{{ asset('/backend/js/index.js') }}"></script>
    <script src="{{ asset('/plugins/ckeditor/ckeditor.js') }}"></script>
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
    @yield('scripts')
    <script>
        CKEDITOR.replace('editor');
        let table = new DataTable("#myTable");

        $('#lfm').filemanager('image');
        $('#lfm-video').filemanager('videos');
        $('#lfm-trailer').filemanager('trailers');
    </script>

</body>

<!-- Mirrored from flixtv.volkovdesign.com/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 14 Dec 2023 08:06:25 GMT -->

</html>
