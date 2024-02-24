@extends('layout.client.main')

@section('title', 'Trang chủ')

@section('content')
    <!-- home -->
    <section class="home home--bg">
        <div class="container">
            <div class="row">
                @if (session('status'))
                    <div class="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="col-12">
                    <h1 class="home__title"><b>Phim mới</b></h1>

                    <button class="home__nav home__nav--prev" type="button">
                        <i class="icon ion-ios-arrow-round-back"></i>
                    </button>
                    <button class="home__nav home__nav--next" type="button">
                        <i class="icon ion-ios-arrow-round-forward"></i>
                    </button>
                </div>
                <div class="col-12">
                    <div class="owl-carousel home__carousel home__carousel--default">
                        @foreach ($danhSachPhimMoi as $item)
                            <div class="card card--big">
                                <div class="card__cover">
                                    <img src="{{ $item->thumbnail }}" alt="">
                                    <a href="{{ route('xemphim.index', $item) }}" class="card__play">
                                        <i class="icon ion-ios-play"></i>
                                    </a>
                                    <span class="card__rate card__rate--green">{{ $item->averageRating() }}</span>
                                </div>
                                <div class="card__content">
                                    <h3 class="card__title"><a
                                            href="{{ route('xemphim.index', $item) }}">{{ $item->name }}</a></h3>
                                    <span class="card__category">
                                        @foreach ($item->genres as $genre)
                                            <a href="{{ route('mucluc.genres', $genre) }}">{{ $genre->name }}</a>
                                        @endforeach
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end home -->

    <!-- filter -->

    <!-- end filter -->

    <!-- catalog -->
    <div class="catalog">
        <div class="container">
            <div class="row row--grid">

                <!-- card -->
                @foreach ($danhSachPhim as $item)
                    <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                        <div class="card">
                            <div class="card__cover">
                                <img src="{{ $item->thumbnail }}" alt="">
                                <a href="{{ route('xemphim.index', $item) }}" class="card__play">
                                    <i class="icon ion-ios-play"></i>
                                </a>
                                <span class="card__rate card__rate--green">{{ $item->averageRating() }}</span>
                            </div>
                            <div class="card__content">
                                <h3 class="card__title"><a
                                        href="{{ route('xemphim.index', $item) }}">{{ $item->name }}</a></h3>
                                <span class="card__category">
                                    @foreach ($item->genres as $genre)
                                        <a href="{{ route('mucluc.genres', $genre) }}">{{ $genre->name }}</a>
                                    @endforeach
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
                <!-- end card -->

            </div>

            <div class="row">
                <!-- paginator -->
                <div class="col-12">
                    <ul class="paginator">
                        {{ $danhSachPhim->links() }}
                    </ul>
                </div>
                <!-- end paginator -->
            </div>
        </div>
    </div>
    <!-- end catalog -->

    <!-- section -->
    <section class="section section--border">
        <div class="container">
            <div class="row">
                <div class="col-12 col-xl-10">
                    <h2 class="section__title section__title--mb"><b>HotFlix</b> – Nơi xem phim hay nhất</h2>

                    <p class="section__text">Một thực tế đã được chứng minh từ lâu là người đọc sẽ bị phân tâm bởi nội dung
                        có thể đọc được của một trang khi nhìn vào bố cục của nó. Mục đích của việc sử dụng Lorem Ipsum là
                        nó có sự phân bố chữ cái ít nhiều bình thường, trái ngược với việc sử dụng. Nhiều gói xuất bản dành
                        cho máy tính để bàn và trình soạn thảo trang web hiện sử dụng Lorem Ipsum làm văn bản mô hình mặc
                        định và việc tìm kiếm 'lorem ipsum' sẽ phát hiện ra nhiều trang web vẫn còn sơ khai.</p>

                    <p class="section__text">Nội dung ở đây, nội dung ở đây, làm cho nó trông giống như tiếng Anh có thể đọc
                        được . Nhiều gói xuất bản dành cho máy tính để bàn và trình soạn thảo trang web hiện sử dụng Lorem
                        Ipsum làm văn bản mô hình mặc định và việc tìm kiếm 'lorem ipsum' sẽ phát hiện ra nhiều trang web
                        vẫn còn sơ khai. Nhiều phiên bản khác nhau đã phát triển qua nhiều năm, đôi khi do vô tình, đôi khi
                        có chủ ý (thêm sự hài hước và những thứ tương tự).</p>
                </div>
            </div>

            <div class="row row--grid">
                <!-- price -->
                @foreach ($danhSachGoi as $item)
                    @if ($item->powers)
                        <div class="col-12 col-md-6 col-lg-4 order-md-2 order-lg-1">
                            <div class="price {{ $item->price == 0 ? 'price--premium' : false }}">
                                <div class="price__item price__item--first"><span>{{ $item->name }}</span> <span>
                                        @if ($item->price == 0)
                                            Miễn phí
                                        @else
                                            {{ number_format($item->price, 0, '', '.') . ' VNĐ' }}
                                        @endif
                                    </span>
                                </div>
                                <div class="price__item"><span><i class="icon ion-ios-checkmark"></i> {{ $item->duration }}
                                        ngày</span></div>
                                @foreach (json_decode($item->powers) as $value)
                                    <div class="price__item"><span><i class="icon ion-ios-checkmark"></i> Chất lượng
                                            {{ $value }}</span></div>
                                @endforeach
                                @if ($item->price == 0)
                                    <a href="{{ route('thanhtoan.checkout', $item) }}" class="price__btn">Đăng ký</a>
                                @else
                                    <a href="{{ route('thanhtoan.cart', $item) }}" class="price__btn">Mua ngay</a>
                                @endif

                            </div>
                        </div>
                    @endif
                @endforeach
                <!-- end price -->
            </div>
        </div>
    </section>
    <!-- end section -->

@endsection
