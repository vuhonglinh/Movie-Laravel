@extends('layout.admin.main')

@section('title', 'Thêm mới phim')


@section('content')
    <main class="main">
        <div class="container-fluid">
            <div class="row">
                <!-- main title -->
                <div class="col-12">
                    <div class="main__title">
                        <h2>Thêm mới phim</h2>
                    </div>
                </div>
                <!-- end main title -->

                <!-- form -->
                <div class="col-12">
                    <form action="" method="POST" class="form">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-md-5 form__cover">
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-12">
                                        <div class="form__img">
                                            <div id="holder">
                                                <img src="{{ old('thumbnail') }}" alt="">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="form__group">
                                                    <input type="text" value="{{ old('thumbnail') }}" id="thumbnail"
                                                        name="thumbnail" class="form__input" placeholder="Đường dẫn ảnh...">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form__group">
                                                    <button id="lfm" data-input="thumbnail" data-preview="holder"
                                                        class="form__btn_primary">Chọn</button>
                                                </div>
                                            </div>
                                            @error('thumbnail')
                                                <span style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-7 form__content">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form__group">
                                            <input type="text" value="{{ old('name') }}" name="name"
                                                class="title form__input" placeholder="Tên phim...">
                                            @error('name')
                                                <span style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form__group">
                                            <input type="text" value="{{ old('slug') }}" name="slug"
                                                class="slug form__input" placeholder="Slug...">
                                            @error('slug')
                                                <span style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form__group">
                                            <label style="color: white" for="editor">Mô tả</label>
                                            <textarea id="editor" name="description" class="editor form__textarea" placeholder="Description">{{ old('description') }}</textarea>
                                            @error('description')
                                                <span style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <label style="color: white" for="editor">Thời gian ra mắt</label>
                                <div class="form__group">
                                    <input type="date" value="{{ old('release_date') }}" name="release_date"
                                        class="form__input" placeholder="Release year">
                                    @error('release_date')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>



                            <div class="col-12 col-sm-6">
                                <label id="gallery1" for="form__gallery-upload">Đạo diễn</label>
                                <div class="form__group">
                                    <input type="text" value="{{ old('directors') }}" name="directors"
                                        class="form__input" placeholder="Tên đạo diễn">
                                    @error('directors')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-12">
                                <div class="form__group">
                                    <select class="js-example-basic-multiple" name="country_id[]" id="country"
                                        multiple="multiple">
                                        @foreach ($countries as $item)
                                            <option {{ in_array($item->id, old('country_id') ?? []) ? 'selected' : false }}
                                                value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('country_id')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form__group">
                                    <select class="js-example-basic-multiple" name="category_id[]" id="category"
                                        multiple="multiple">
                                        @foreach ($categories as $item)
                                            <option {{ in_array($item->id, old('category_id') ?? []) ? 'selected' : false }}
                                                value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form__group">
                                    <select class="js-example-basic-single" name="genre_id[]" id="genre"
                                        multiple="multiple">
                                        @foreach ($genres as $item)
                                            <option {{ in_array($item->id, old('genre_id') ?? []) ? 'selected' : false }}
                                                value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('genre_id')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <ul class="form__radio">
                                    <li>
                                        <span>Chất lượng:</span>
                                    </li>
                                    <li>
                                        <input id="Full HD" value="FULL HD" type="radio"
                                            {{ old('quality') == 'FULL HD' ? 'checked' : false }} name="quality">
                                        <label for="Full HD">Full HD</label>
                                    </li>
                                    <li>
                                        <input id="HD" value="HD" type="radio"
                                            {{ old('quality') == 'HD' ? 'checked' : false }} name="quality">
                                        <label for="HD">HD</label>
                                    </li>
                                    <li>
                                        <input id="SD" value="SD" type="radio"
                                            {{ old('quality') == 'SD' ? 'checked' : false }} name="quality">
                                        <label for="SD">SD</label>
                                    </li>
                                </ul>
                                @error('quality')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-10">
                                    <div class="form__group">
                                        <input value="{{ old('trailer_url') }}" type="text" id="trailer"
                                            name="trailer_url" class="title form__input"
                                            placeholder="Đường dẫn Trailer...">
                                        @error('trailer_url')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form__group">
                                        <button id="lfm-trailer" data-input="trailer"
                                            class="form__btn_primary">Chọn</button>
                                    </div>
                                </div>
                            </div>
                            <label id="gallery1" for="form__gallery-upload">*Lưu ý: Nếu đây là phim bộ vui lòng bỏ qua
                                trường dưới</label>
                            <div class="row" id="movie">
                                <div class="col-10">
                                    <div class="form__group">
                                        <input value="{{ old('movie_url') }}" type="text" id="videos"
                                            name="movie_url" class="title form__input" placeholder="Đường dẫn phim...">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form__group">
                                        <button id="lfm-video" data-input="videos"
                                            class="form__btn_primary">Chọn</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="form__btn">Thêm mới</button>
                        </div>
                    </form>
                </div>
                <!-- end form -->
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script></script>
@endsection
