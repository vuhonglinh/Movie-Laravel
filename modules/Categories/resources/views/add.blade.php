@extends('layout.admin.main')

@section('title', 'Thêm mới danh mục')


@section('content')
    <main class="main">
        <div class="container-fluid">
            <div class="row">
                <!-- main title -->
                <div class="col-12">
                    <div class="main__title">
                        <h2>Thêm mới danh mục</h2>
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
                                        <input value="{{ old('name') }}" type="text" name="name"
                                            class="title form__input" placeholder="Tên danh mục...">
                                        @error('name')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-6">
                                    <div class="form__group">
                                        <input type="text" value="{{ old('slug') }}" name="slug" class="slug form__input" placeholder="Slug...">
                                        @error('slug')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form__group">
                                        <label style="color: white" for="editor">Mô tả</label>
                                        <textarea id="editor" name="description" class="form__textarea editor" placeholder="Mô tả...">{{ old('description') }}</textarea>
                                        @error('description')
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
