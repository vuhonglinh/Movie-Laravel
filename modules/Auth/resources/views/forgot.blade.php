@extends('layout.admin.auth')
@section('name', 'Đăng nhập')
@section('content')
    <div class="sign section--bg" data-bg="img/bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sign__content">
                        <!-- authorization form -->
                        <form action="" method="POST" class="sign__form">
                            @csrf
                            <a href="{{route('admin.login')}}" class="sign__logo">
                                <img src="{{ asset('/backend/img/logo.svg') }}" alt="">
                            </a>

                            <div class="sign__group">
                                <input type="email" value="{{ old('email') }}" name="email" class="sign__input"
                                    placeholder="Email...">
                                @error('email')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                            <button class="sign__btn" type="submit">Gửi</button>
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
