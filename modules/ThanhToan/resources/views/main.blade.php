@extends('layout.client.main')
@section('title', 'Thanh toán')
@section('content')
    <!-- page title -->
    <section class="section section--first section--bg" data-bg="img/section/section.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section__wrap">
                        <!-- section title -->
                        <h2 class="section__title">Thanh toán</h2>
                        <!-- end section title -->

                        <!-- breadcrumb -->
                        <ul class="breadcrumb">
                            <li class="breadcrumb__item"><a href="{{ route('trangchu.index') }}">Trang chủ</a></li>
                            <li class="breadcrumb__item breadcrumb__item--active">Thanh toán</li>
                        </ul>
                        <!-- end breadcrumb -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end page title -->

    <!-- contacts -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <!-- section title -->
                        <div class="col-12">
                            <h2 class="section__title section__title--mb">Thông tín gói</h2>
                        </div>
                        <!-- end section title -->
                        <div class="col-12">
                            <p class="section__text">Tên gói: {{ $package->name }}</p>
                            <p class="section__text">Giá: {{ number_format($package->price, 0, '', '.') . ' VNĐ' }}</p>
                            @foreach (json_decode($package->powers) as $value)
                                <div class="price__item">
                                    <p><i class="icon ion-ios-checkmark"></i> Chất lượng
                                        {{ $value }}</p>
                                </div>
                            @endforeach
                            <p class="section__text">Hạn sử dụng: {{ $package->duration }} ngày</p>
                        </div>
                        <div class="col-12 my-3">
                            <form action="{{ route('thanhtoan.vnpay.payment', $package) }}" method="POST">
                                @csrf
                                <button class="form__btn" name="redirect" type="submit">Thanh toán VNPAY</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end contacts -->
@endsection
