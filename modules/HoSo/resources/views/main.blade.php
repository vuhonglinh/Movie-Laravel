@extends('layout.client.main')
@section('title', 'Hồ sơ')

@section('content')
    <!-- page title -->
    <section class="section section--first section--bg" data-bg="{{ asset('/client/img/section/section.jpg') }}">
        <div class="container">
            <div class="row">
                @if (session('status'))
                    <div class="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="col-12">
                    <div class="section__wrap">
                        <!-- section title -->
                        <h2 class="section__title">Hồ sơ</h2>
                        <!-- end section title -->

                        <!-- breadcrumb -->
                        <ul class="breadcrumb">
                            <li class="breadcrumb__item"><a href="{{ route('trangchu.index') }}">Trang chủ</a></li>
                            <li class="breadcrumb__item breadcrumb__item--active">Hồ sơ</li>
                        </ul>
                        <!-- end breadcrumb -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end page title -->

    <!-- content -->
    <div class="content content--profile">
        <!-- profile -->
        <div class="profile">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="profile__content">
                            <div class="profile__user">
                                <div class="profile__avatar">
                                    <img src="{{ asset('/client/img/user.svg') }}" alt="">
                                </div>
                                <div class="profile__meta">
                                    <h3>{{ auth('customer')->user()->name }}</h3>
                                    <span>HOTFLIX ID: 78123</span>
                                </div>
                            </div>

                            <!-- content tabs nav -->
                            <ul class="nav nav-tabs content__tabs content__tabs--profile" id="content__tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tab-1" role="tab"
                                        aria-controls="tab-1" aria-selected="true">Hồ sở</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab-2" role="tab"
                                        aria-controls="tab-2" aria-selected="false">Đăng ký</a>
                                </li>
                            </ul>
                            <!-- end content tabs nav -->

                            <!-- content mobile tabs nav -->
                            <div class="content__mobile-tabs content__mobile-tabs--profile" id="content__mobile-tabs">
                                <div class="content__mobile-tabs-btn dropdown-toggle" role="navigation" id="mobile-tabs"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <input type="button" value="Profile">
                                    <span></span>
                                </div>

                                <div class="content__mobile-tabs-menu dropdown-menu" aria-labelledby="mobile-tabs">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item"><a class="nav-link active" id="1-tab" data-toggle="tab"
                                                href="#tab-1" role="tab" aria-controls="tab-1" aria-selected="true">Hồ
                                                sơ</a></li>

                                        <li class="nav-item"><a class="nav-link" id="2-tab" data-toggle="tab"
                                                href="#tab-2" role="tab" aria-controls="tab-2"
                                                aria-selected="false">Đăng ký</a></li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end profile -->

        <div class="container">
            <!-- content tabs -->
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="1-tab">
                    <div class="row row--grid">

                        <!-- stats -->
                        <div class="col-12 col-sm-6 ">
                            <div class="stats">
                                <span>Bình luận của bạn</span>
                                <p><a href="#">{{ auth()->user()->comments->count() }}</a></p>
                                <i class="icon ion-ios-chatbubbles"></i>
                            </div>
                        </div>
                        <!-- end stats -->

                        <!-- stats -->
                        <div class="col-12 col-sm-6">
                            <div class="stats">
                                <span>Đánh giá của bạn</span>
                                <p><a href="#">{{ auth()->user()->reviews->count() }}</a></p>
                                <i class="icon ion-ios-star-half"></i>
                            </div>
                        </div>
                        <!-- end stats -->

                        <!-- dashbox -->
                        <div class="col-12 col-xl-6">

                            <form action="{{ route('hoso.saveInfo') }}" method="POST" class="form form--profile">
                                @csrf
                                <div class="row row--form">
                                    <div class="col-12">
                                        <h4 class="form__title">Thông tin chi tiết</h4>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                        <div class="form__group">
                                            <label class="form__label" for="name">Họ và tên</label>
                                            <input id="name" value="{{ auth('customer')->user()->name }}"
                                                type="text" name="name" class="form__input">
                                            @error('name')
                                                <span style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                        <div class="form__group">
                                            <label class="form__label" for="email">Email</label>
                                            <input id="email" type="text"
                                                value="{{ auth('customer')->user()->email }}" name="email"
                                                class="form__input">
                                            @error('email')
                                                <span style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 ">
                                        <div class="form__group">
                                            <label class="form__label" for="address">Địa chỉ</label>
                                            <input id="address" value="{{ auth('customer')->user()->address }}"
                                                type="text" name="address" class="form__input">
                                            @error('address')
                                                <span style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <button class="form__btn" type="submit">Lưu</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <!-- end dashbox -->

                        <!-- dashbox -->
                        <div class="col-12 col-xl-6">
                            <form action="{{ route('hoso.changePassword') }}" method="POST" class="form form--profile">
                                @csrf
                                <div class="row row--form">
                                    <div class="col-12">
                                        <h4 class="form__title">Thay đổi mật khẩu</h4>
                                    </div>

                                    <div class="col-12">
                                        <div class="form__group">
                                            <label class="form__label" for="oldpass">Mật khẩu cũ</label>
                                            <input id="oldpass" type="password" name="oldpass" class="form__input">
                                            @error('oldpass')
                                                <span style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                        <div class="form__group">
                                            <label class="form__label" for="newpass">Mật khẩu mới</label>
                                            <input id="newpass" type="password" name="newpass" class="form__input">
                                            @error('newpass')
                                                <span style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                        <div class="form__group">
                                            <label class="form__label" for="confirmpass">Xác nhận mật khẩu mới</label>
                                            <input id="confirmpass" type="password" name="confirmpass"
                                                class="form__input">
                                            @error('confirmpass')
                                                <span style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="form__btn" type="submit">Thay đổi</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- end dashbox -->
                    </div>
                </div>

                <div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="2-tab">
                    <div class="row row--grid">
                        <!-- price -->
                        @foreach ($orders as $order)
                            <div class="col-12 col-md-6 col-lg-4 order-md-2 order-lg-1">
                                <div class="price {{ $order->packages->price == 0 ? 'price--premium' : false }}">
                                    <div class="price__item price__item--first"><span>{{ $order->packages->name }}</span>
                                        <span>
                                            @if ($order->total_amount == 0)
                                                Miễn phí
                                            @else
                                                {{ number_format($order->total_amount, 0, '', '.') . ' VNĐ' }}
                                            @endif
                                        </span>
                                    </div>
                                    <div class="price__item"><span><i class="icon ion-ios-checkmark"></i>
                                            {{ $order->packages->duration }}
                                            ngày</span></div>
                                    @foreach (json_decode($order->packages->powers) as $value)
                                        <div class="price__item"><span><i class="icon ion-ios-checkmark"></i> Chất lượng
                                                {{ $value }}</span></div>
                                    @endforeach
                                    <div class="price__item"><span><i class="icon ion-ios-checkmark"></i> Ngày hết hạn:
                                            {{ date('d/m/Y', strtotime($order->expiry_date)) }}</span></div>
                                    @if ($order->status == 0)
                                        <button disabled class="price__btn">Đã sử dụng</button>
                                    @else
                                        <button disabled class="price__btn">Đang sử dụng</button>
                                    @endif

                                </div>
                            </div>
                        @endforeach
                        <!-- end price -->
                    </div>
                </div>


            </div>
            <!-- end content tabs -->
        </div>
    </div>
    <!-- end content -->

@endsection
