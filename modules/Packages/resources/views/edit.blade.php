@extends('layout.admin.main')

@section('title', 'Cập nhật gói phim')


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
                        <h2>Cập nhật gói phim</h2>
                    </div>
                </div>

                <!-- form -->
                <div class="col-12">
                    <form action="" method="POST" class="form">
                        @csrf
                        <div class="col-12 col-md-7 form__content">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form__group">
                                        <input value="{{ old('name') ?? $package->name }}" type="text" name="name"
                                            class="form__input" placeholder="Tên gói...">
                                        @error('name')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form__group">
                                        <input value="{{ old('price') ?? $package->price }}" type="text" name="price"
                                            class="title form__input" placeholder="Giá...">
                                        @error('price')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form__group">
                                        <input type="text" value="{{ old('duration') ?? $package->duration }}"
                                            name="duration" class="form__input" placeholder="Thời gian sử dụng...">
                                        @error('duration')
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
