<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from flixtv.volkovdesign.com/admin/404.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 14 Dec 2023 08:06:27 GMT -->

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
    <title>Trang không tồn tại</title>

</head>

<body>
    <!-- page 404 -->
    <div class="page-404 section--bg" data-bg="img/bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Bạn đã đặt hàng thành công</h1>
                    <p>Tổng tiền: {{ number_format($order['total_amount'], 0, '', '.') . ' VNĐ' }}</p>
                    <p>Người đặt: {{ $order['customer->name'] }}</p>
                </div>
            </div>
        </div>
    </div>
    <!-- end page 404 -->

    <!-- JS -->
    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/smooth-scrollbar.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/admin.js') }}"></script>
</body>

<!-- Mirrored from flixtv.volkovdesign.com/admin/404.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 14 Dec 2023 08:06:27 GMT -->

</html>
