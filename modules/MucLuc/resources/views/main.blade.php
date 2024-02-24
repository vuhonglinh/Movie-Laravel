@extends('layout.client.main')
@section('title', $titlePage)
@section('content')
    <!-- page title -->
    <section class="section section--first section--bg" data-bg="{{ asset('/client/img/section/section.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section__wrap">
                        <!-- section title -->
                        <h1 class="section__title">{{ $titlePage }}</h1>
                        <!-- end section title -->

                        <!-- breadcrumb -->
                        <ul class="breadcrumb">
                            <li class="breadcrumb__item"><a href="{{ route('trangchu.index') }}">Trang chủ</a></li>
                            <li class="breadcrumb__item breadcrumb__item--active">{{ $titlePage }}</li>
                        </ul>
                        <!-- end breadcrumb -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end page title -->

    <div>
        <!-- filter (fixed position) -->
        @include('part.client.filter')
        <!-- end filter (fixed position) -->

        <!-- catalog -->
        <div class="catalog">
            <div class="container" style="min-height: 395px">
                @if ($movies->count() > 0)
                    <div class="row row--grid">
                        <!-- card -->
                        @foreach ($movies as $item)
                            <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                                <div class="card">
                                    <div class="card__cover">
                                        <img src="{{ $item->thumbnail }}" alt="">
                                        <a href="{{ route('xemphim.index', $item) }}" class="card__play">
                                            <i class="icon ion-ios-play"></i>
                                        </a>
                                        <span
                                            class="card__rate card__rate--green">{{ number_format($item->averageRating(), 1) }}</span>
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
                                {{ $movies->links() }}
                            </ul>
                        </div>
                        <!-- end paginator -->
                    </div>
                @else
                    <h1 class="section__title">Không tìm thấy phim nào :(</h1>
                @endif
            </div>
        </div>
        <!-- end catalog -->
    </div>
@endsection
