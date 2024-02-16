@extends('layout.admin.main')

@section('title', 'Cập nhật tập phim')


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
                        <h2>Cập nhật tập phim: {{ $movie->name }}</h2>
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
                                        <input value="{{ old('name') ?? $episode->name }}" type="text" name="name"
                                            class="title form__input" placeholder="Tên tập phim...">
                                        @error('name')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-6">
                                    <div class="form__group">
                                        <input type="text" value="{{ old('slug') ?? $episode->slug }}" name="slug"
                                            class="slug form__input" placeholder="Slug...">
                                        @error('slug')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="sign__label" for="number">Thứ tự tập phim</label>
                                    <div class="form__group">
                                        <select class="js-example-basic-multiple" name="number" id="number">
                                            @for ($i = 1; $i <= max($episodes); $i++)
                                                <option
                                                    {{ in_array($i, $episodes) && $i !== $episode->number ? 'disabled' : false }}
                                                    value="{{ $i }}">
                                                    {{ $i }}</option>
                                            @endfor
                                        </select>
                                        @error('number')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="form__group">
                                        <label style="color: white" for="editor">Mô tả</label>
                                        <textarea id="editor" name="description" class="form__textarea editor" placeholder="Mô tả...">{{ old('description') ?? $episode->description }}</textarea>
                                        @error('description')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form__group">
                                        <input type="text" value="{{ old('movie_url') ?? $episode->movie_url }}"
                                            name="movie_url" class="form__input" placeholder="Đường dẫn phim...">
                                        @error('movie_url')
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
