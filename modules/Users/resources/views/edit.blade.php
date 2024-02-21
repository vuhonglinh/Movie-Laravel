@extends('layout.admin.main')

@section('title', 'Cập nhật quản trị viên')


@section('content')
    <main class="main">
        <div class="container-fluid">
            <div class="row">
                @if (session('mess'))
                    <div class="alert">
                        {{ session('mess') }}
                    </div>
                @endif
                <!-- main title -->
                <div class="col-12">
                    <div class="main__title">
                        <h2>Cập nhật quản trị viên</h2>
                    </div>
                </div>
                <!-- end main title -->

                <!-- form -->
                <div class="col-12">
                    <form action="" method="POST" class="form">
                        @csrf
                        <div class="col-12 col-md-7 form__content">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form__group">
                                        <input value="{{ old('name') ?? $user->name }}" type="text" name="name"
                                            class="form__input" placeholder="Họ và tên...">
                                        @error('name')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form__group">
                                        <input type="email" value="{{ old('email') ?? $user->email }}" name="email"
                                            class="form__input" placeholder="Email...">
                                        @error('email')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form__group">
                                        <input type="password" value="{{ old('password') }}" name="password"
                                            class="form__input" placeholder="Mật khẩu...">
                                        @error('password')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form__group">
                                        <select class="js-example-basic-multiple" name="role_id" id="country">
                                            @foreach ($roles as $item)
                                                <option
                                                    {{ old('role_id') ?? $user->role_id == $item->id ? 'selected' : false }}
                                                    value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('role_id')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="form__btn">Thêm mới</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                <!-- end form -->
            </div>
        </div>
    </main>
@endsection
