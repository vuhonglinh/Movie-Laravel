@extends('layout.admin.auth')
@section('name', 'Đăng nhập')
@section('content')
    <div class="sign section--bg" data-bg="img/bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sign__content">
                        <!-- authorization form -->
                        <form action="{{ route('admin.update.password') }}" method="POST" class="sign__form">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">
                            <a href="index.html" class="sign__logo">
                                <img src="{{ asset('/backend/img/logo.svg') }}" alt="">
                            </a>

                            <div class="sign__group">
                                <input type="email" value="{{ $email ?? old('email') }}" name="email"
                                    class="sign__input" placeholder="Email...">
                                @error('email')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="sign__group">
                                <input type="password" name="password" class="sign__input" placeholder="Mật khẩu...">
                                @error('password')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="sign__group">
                                <input type="password" name="password_confirmation" class="sign__input"
                                    placeholder="Xác nhận mật khẩu...">
                                @error('password_confirmation')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>

                            <button class="sign__btn" type="submit">Lưu</button>
                        </form>
                        <!-- end authorization form -->
                    </div>
                </div>
            </div>
        </div>
    </div>~`
@endsection
