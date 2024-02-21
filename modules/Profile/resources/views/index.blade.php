@extends('layout.admin.main')

@section('title', 'Hồ sơ')


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
                        <h2>Hồ sơ</h2>
                    </div>
                </div>
                <!-- end main title -->

                <!-- content tabs -->
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="1-tab">
                        <div class="col-12">
                            <div class="sign__wrap">
                                <div class="row">
                                    <!-- details form -->
                                    <div class="col-12 col-lg-6">
                                        <form method="POST" action="{{ route('admin.profile.change.info') }}"
                                            class="sign__form sign__form--profile sign__form--first">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12">
                                                    <h4 class="sign__title">Thông tin chi tiết</h4>
                                                </div>

                                                <div class="col-12">
                                                    <div class="sign__group">
                                                        <label class="sign__label" for="name">Họ và tên</label>
                                                        <input id="name" value="{{ $user->name }}" type="text"
                                                            name="name" class="sign__input" placeholder="User123">
                                                        @error('name')
                                                            <span style="color: red">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="sign__group">
                                                        <label class="sign__label" for="email">Email</label>
                                                        <input id="email" value="{{ $user->email }}" type="text"
                                                            name="email" class="sign__input"
                                                            placeholder="email@email.com">
                                                        @error('email')
                                                            <span style="color: red">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="sign__group">
                                                        <label class="sign__label" for="role_id">Nhóm</label>
                                                        <input disabled value="{{ $user->roles->name }}" id="role_id"
                                                            value="{{ $user->role_id }}" type="text" name="role_id"
                                                            class="sign__input">
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <button class="sign__btn" type="submit">Cập nhật</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- end details form -->

                                    <!-- password form -->
                                    <div class="col-12 col-lg-6">
                                        <form method="POST" action="{{ route('admin.profile.change.password') }}"
                                            class="sign__form sign__form--profile">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12">
                                                    <h4 class="sign__title">Thay đổi mật khẩu</h4>
                                                </div>

                                                <div class="col-12">
                                                    <div class="sign__group">
                                                        <label class="sign__label" for="oldpass">Mật khẩu cũ</label>
                                                        <input id="oldpass" type="password" name="oldpass"
                                                            class="sign__input">
                                                        @error('oldpass')
                                                            <span style="color: red">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="sign__group">
                                                        <label class="sign__label" for="newpass">Mật khẩu mới</label>
                                                        <input id="newpass" type="password" name="newpass"
                                                            class="sign__input">
                                                        @error('newpass')
                                                            <span style="color: red">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="sign__group">
                                                        <label class="sign__label" for="confirmpass">Nhập lại mật khẩu
                                                            mới</label>
                                                        <input id="confirmpass" type="password" name="confirmpass"
                                                            class="sign__input">
                                                        @error('confirmpass')
                                                            <span style="color: red">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <button class="sign__btn" type="submit">Thay đổi</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- end password form -->
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- end content tabs -->
            </div>
        </div>
    </main>
@endsection


@section('scripts')
    <script></script>
@endsection
