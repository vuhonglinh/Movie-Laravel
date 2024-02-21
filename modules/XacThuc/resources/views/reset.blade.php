@extends('layout.client.auth')

@section('title', 'Đăng ký')

@section('content')
    <div class="sign section--bg" data-bg="{{ asset('/client/img/section/section.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sign__content">
                        <!-- authorization form -->
                        <form action="{{route('xacthuc.reset.password')}}" method="POST" class="sign__form">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <a href="{{ route('trangchu.index') }}" class="sign__logo">
                                <img src="{{ asset('/client/img/logo.svg') }}" alt="">
                            </a>

                            <div class="sign__group">
                                <input type="text" name="email" value="{{ $email ?? old('email') }}"
                                    class="sign__input" placeholder="Email">
                                @error('email')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="sign__group">
                                <input type="password" name="password" autocomplete="new-password" class="sign__input"
                                    placeholder="Mật khẩu mới">
                                @error('password')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="sign__group">
                                <input type="password" name="password_confirmation" autocomplete="new-password"
                                    class="sign__input" placeholder="Xác nhận lại mật khẩu">
                                @error('password_confirmation')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>

                            <button class="sign__btn" type="submit">Lưu</button>

                            @if (session('status'))
                                <span class="sign__text">{{ session('status') }}</span>
                            @endif
                        </form>
                        <!-- end authorization form -->
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
