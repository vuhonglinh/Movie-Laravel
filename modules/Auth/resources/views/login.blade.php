@extends('layout.admin.auth')
@section('name', 'Đăng nhập')
@section('content')
    <div class="sign section--bg" data-bg="{{ asset('/backend/img/bg.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sign__content">
                        <!-- authorization form -->
                        <form action="" method="POST" class="sign__form">
                            @csrf
                            <a href="index.html" class="sign__logo">
                                <img src="{{ asset('/backend/img/logo.svg') }}" alt="">
                            </a>

                            <div class="sign__group">
                                <input type="text" value="{{ old('email') }}" name="email" class="sign__input"
                                    placeholder="Email">
                                @error('email')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="sign__group">
                                <input type="password" name="password" class="sign__input" placeholder="Mật khẩu">
                                @error('password')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                            <button class="sign__btn" type="submit">Đăng nhập</button>
                            <span class="sign__text"><a href="{{ route('admin.forgot') }}">Quên mật khẩu?</a></span>
                        </form>
                        <!-- end authorization form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
