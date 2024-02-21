@extends('layout.client.main')

@section('title', 'Trang chủ')

@section('content')
    <!-- home -->
    <section class="home home--bg">
        <div class="container">
            <div class="row">
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
                                    <span class="card__rate card__rate--green">{{$item->averageRating()}}</span>
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
    <div class="filter">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="filter__content">
                        <div class="filter__items">
                            <!-- filter item -->
                            <div class="filter__item" id="filter__genre">
                                <span class="filter__item-label">GENRE:</span>

                                <div class="filter__item-btn dropdown-toggle" role="navigation" id="filter-genre"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <input type="button" value="Action/Adventure">
                                    <span></span>
                                </div>

                                <ul class="filter__item-menu dropdown-menu scrollbar-dropdown"
                                    aria-labelledby="filter-genre">
                                    <li>Action/Adventure</li>
                                    <li>Animals</li>
                                    <li>Animation</li>
                                    <li>Biography</li>
                                    <li>Comedy</li>
                                    <li>Cooking</li>
                                    <li>Dance</li>
                                    <li>Documentary</li>
                                    <li>Drama</li>
                                    <li>Education</li>
                                    <li>Entertainment</li>
                                    <li>Family</li>
                                    <li>Fantasy</li>
                                    <li>History</li>
                                    <li>Horror</li>
                                    <li>Independent</li>
                                    <li>International</li>
                                    <li>Kids</li>
                                    <li>Kids & Family</li>
                                    <li>Medical</li>
                                    <li>Military/War</li>
                                    <li>Music</li>
                                    <li>Musical</li>
                                    <li>Mystery/Crime</li>
                                    <li>Nature</li>
                                    <li>Paranormal</li>
                                    <li>Politics</li>
                                    <li>Racing</li>
                                    <li>Romance</li>
                                    <li>Sci-Fi/Horror</li>
                                    <li>Science</li>
                                    <li>Science Fiction</li>
                                    <li>Science/Nature</li>
                                    <li>Spanish</li>
                                    <li>Travel</li>
                                    <li>Western</li>
                                </ul>
                            </div>
                            <!-- end filter item -->

                            <!-- filter item -->
                            <div class="filter__item" id="filter__quality">
                                <span class="filter__item-label">QUALITY:</span>

                                <div class="filter__item-btn dropdown-toggle" role="navigation" id="filter-quality"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <input type="button" value="HD 1080">
                                    <span></span>
                                </div>

                                <ul class="filter__item-menu dropdown-menu scrollbar-dropdown"
                                    aria-labelledby="filter-quality">
                                    <li>HD 1080</li>
                                    <li>HD 720</li>
                                    <li>DVD</li>
                                    <li>TS</li>
                                </ul>
                            </div>
                            <!-- end filter item -->

                            <!-- filter item -->
                            <div class="filter__item" id="filter__rate">
                                <span class="filter__item-label">RATING:</span>

                                <div class="filter__item-btn dropdown-toggle" role="button" id="filter-rate"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="filter__range">
                                        <div id="filter__imbd-start"></div>
                                        <div id="filter__imbd-end"></div>
                                    </div>
                                    <span></span>
                                </div>

                                <div class="filter__item-menu filter__item-menu--range dropdown-menu"
                                    aria-labelledby="filter-rate">
                                    <div id="filter__imbd"></div>
                                </div>
                            </div>
                            <!-- end filter item -->

                            <!-- filter item -->
                            <div class="filter__item" id="filter__year">
                                <span class="filter__item-label">RELEASE YEAR:</span>

                                <div class="filter__item-btn dropdown-toggle" role="button" id="filter-year"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="filter__range">
                                        <div id="filter__years-start"></div>
                                        <div id="filter__years-end"></div>
                                    </div>
                                    <span></span>
                                </div>

                                <div class="filter__item-menu filter__item-menu--range dropdown-menu"
                                    aria-labelledby="filter-year">
                                    <div id="filter__years"></div>
                                </div>
                            </div>
                            <!-- end filter item -->
                        </div>

                        <!-- filter btn -->
                        <button class="filter__btn" type="button">apply filter</button>
                        <!-- end filter btn -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end filter -->

    <!-- catalog -->
    <div class="catalog">
        <div class="container">
            <div class="row row--grid">
                <!-- card -->
                <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                    <div class="card">
                        <div class="card__cover">
                            <img src="img/covers/cover.jpg" alt="">
                            <a href="details.html" class="card__play">
                                <i class="icon ion-ios-play"></i>
                            </a>
                            <span class="card__rate card__rate--green">8.4</span>
                        </div>
                        <div class="card__content">
                            <h3 class="card__title"><a href="details.html">I Dream in Another Language</a></h3>
                            <span class="card__category">
                                <a href="#">Action</a>
                                <a href="#">Triler</a>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- end card -->

                <!-- card -->
                <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                    <div class="card">
                        <div class="card__cover">
                            <img src="img/covers/cover2.jpg" alt="">
                            <a href="details.html" class="card__play">
                                <i class="icon ion-ios-play"></i>
                            </a>
                            <span class="card__rate card__rate--green">7.1</span>
                        </div>
                        <div class="card__content">
                            <h3 class="card__title"><a href="details.html">Benched</a></h3>
                            <span class="card__category">
                                <a href="#">Comedy</a>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- end card -->

                <!-- card -->
                <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                    <div class="card">
                        <div class="card__cover">
                            <img src="img/covers/cover3.jpg" alt="">
                            <a href="details.html" class="card__play">
                                <i class="icon ion-ios-play"></i>
                            </a>
                            <span class="card__rate card__rate--red">6.3</span>
                        </div>
                        <div class="card__content">
                            <h3 class="card__title"><a href="details.html">Whitney</a></h3>
                            <span class="card__category">
                                <a href="#">Romance</a>
                                <a href="#">Drama</a>
                                <a href="#">Music</a>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- end card -->

                <!-- card -->
                <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                    <div class="card">
                        <div class="card__cover">
                            <img src="img/covers/cover4.jpg" alt="">
                            <a href="details.html" class="card__play">
                                <i class="icon ion-ios-play"></i>
                            </a>
                            <span class="card__rate card__rate--yellow">6.9</span>
                        </div>
                        <div class="card__content">
                            <h3 class="card__title"><a href="details.html">Blindspotting</a></h3>
                            <span class="card__category">
                                <a href="#">Comedy</a>
                                <a href="#">Drama</a>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- end card -->

                <!-- card -->
                <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                    <div class="card">
                        <div class="card__cover">
                            <img src="img/covers/cover5.jpg" alt="">
                            <a href="details.html" class="card__play">
                                <i class="icon ion-ios-play"></i>
                            </a>
                            <span class="card__rate card__rate--green">8.4</span>
                        </div>
                        <div class="card__content">
                            <h3 class="card__title"><a href="details.html">I Dream in Another Language</a></h3>
                            <span class="card__category">
                                <a href="#">Action</a>
                                <a href="#">Triler</a>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- end card -->

                <!-- card -->
                <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                    <div class="card">
                        <div class="card__cover">
                            <img src="img/covers/cover6.jpg" alt="">
                            <a href="details.html" class="card__play">
                                <i class="icon ion-ios-play"></i>
                            </a>
                            <span class="card__rate card__rate--green">7.1</span>
                        </div>
                        <div class="card__content">
                            <h3 class="card__title"><a href="details.html">Benched</a></h3>
                            <span class="card__category">
                                <a href="#">Comedy</a>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- end card -->

                <!-- card -->
                <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                    <div class="card">
                        <div class="card__cover">
                            <img src="img/covers/cover7.jpg" alt="">
                            <a href="details.html" class="card__play">
                                <i class="icon ion-ios-play"></i>
                            </a>
                            <span class="card__rate card__rate--green">7.1</span>
                        </div>
                        <div class="card__content">
                            <h3 class="card__title"><a href="details.html">Benched</a></h3>
                            <span class="card__category">
                                <a href="#">Comedy</a>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- end card -->

                <!-- card -->
                <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                    <div class="card">
                        <div class="card__cover">
                            <img src="img/covers/cover8.jpg" alt="">
                            <a href="details.html" class="card__play">
                                <i class="icon ion-ios-play"></i>
                            </a>
                            <span class="card__rate card__rate--red">5.5</span>
                        </div>
                        <div class="card__content">
                            <h3 class="card__title"><a href="details.html">I Dream in Another Language</a></h3>
                            <span class="card__category">
                                <a href="#">Action</a>
                                <a href="#">Triler</a>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- end card -->

                <!-- card -->
                <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                    <div class="card">
                        <div class="card__cover">
                            <img src="img/covers/cover9.jpg" alt="">
                            <a href="details.html" class="card__play">
                                <i class="icon ion-ios-play"></i>
                            </a>
                            <span class="card__rate card__rate--yellow">6.7</span>
                        </div>
                        <div class="card__content">
                            <h3 class="card__title"><a href="details.html">Blindspotting</a></h3>
                            <span class="card__category">
                                <a href="#">Comedy</a>
                                <a href="#">Drama</a>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- end card -->

                <!-- card -->
                <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                    <div class="card">
                        <div class="card__cover">
                            <img src="img/covers/cover10.jpg" alt="">
                            <a href="details.html" class="card__play">
                                <i class="icon ion-ios-play"></i>
                            </a>
                            <span class="card__rate card__rate--red">5.6</span>
                        </div>
                        <div class="card__content">
                            <h3 class="card__title"><a href="details.html">Whitney</a></h3>
                            <span class="card__category">
                                <a href="#">Romance</a>
                                <a href="#">Drama</a>
                                <a href="#">Music</a>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- end card -->

                <!-- card -->
                <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                    <div class="card">
                        <div class="card__cover">
                            <img src="img/covers/cover11.jpg" alt="">
                            <a href="details.html" class="card__play">
                                <i class="icon ion-ios-play"></i>
                            </a>
                            <span class="card__rate card__rate--green">9.2</span>
                        </div>
                        <div class="card__content">
                            <h3 class="card__title"><a href="details.html">Benched</a></h3>
                            <span class="card__category">
                                <a href="#">Comedy</a>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- end card -->

                <!-- card -->
                <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                    <div class="card">
                        <div class="card__cover">
                            <img src="img/covers/cover12.jpg" alt="">
                            <a href="details.html" class="card__play">
                                <i class="icon ion-ios-play"></i>
                            </a>
                            <span class="card__rate card__rate--green">8.4</span>
                        </div>
                        <div class="card__content">
                            <h3 class="card__title"><a href="details.html">I Dream in Another Language</a></h3>
                            <span class="card__category">
                                <a href="#">Action</a>
                                <a href="#">Triler</a>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- end card -->

                <!-- card -->
                <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                    <div class="card">
                        <div class="card__cover">
                            <img src="img/covers/cover13.jpg" alt="">
                            <a href="details.html" class="card__play">
                                <i class="icon ion-ios-play"></i>
                            </a>
                            <span class="card__rate card__rate--green">8.0</span>
                        </div>
                        <div class="card__content">
                            <h3 class="card__title"><a href="details.html">I Dream in Another Language</a></h3>
                            <span class="card__category">
                                <a href="#">Action</a>
                                <a href="#">Triler</a>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- end card -->

                <!-- card -->
                <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                    <div class="card">
                        <div class="card__cover">
                            <img src="img/covers/cover14.jpg" alt="">
                            <a href="details.html" class="card__play">
                                <i class="icon ion-ios-play"></i>
                            </a>
                            <span class="card__rate card__rate--green">7.2</span>
                        </div>
                        <div class="card__content">
                            <h3 class="card__title"><a href="details.html">Benched</a></h3>
                            <span class="card__category">
                                <a href="#">Comedy</a>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- end card -->

                <!-- card -->
                <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                    <div class="card">
                        <div class="card__cover">
                            <img src="img/covers/cover15.jpg" alt="">
                            <a href="details.html" class="card__play">
                                <i class="icon ion-ios-play"></i>
                            </a>
                            <span class="card__rate card__rate--yellow">5.9</span>
                        </div>
                        <div class="card__content">
                            <h3 class="card__title"><a href="details.html">Whitney</a></h3>
                            <span class="card__category">
                                <a href="#">Romance</a>
                                <a href="#">Drama</a>
                                <a href="#">Music</a>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- end card -->

                <!-- card -->
                <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                    <div class="card">
                        <div class="card__cover">
                            <img src="img/covers/cover16.jpg" alt="">
                            <a href="details.html" class="card__play">
                                <i class="icon ion-ios-play"></i>
                            </a>
                            <span class="card__rate card__rate--green">8.3</span>
                        </div>
                        <div class="card__content">
                            <h3 class="card__title"><a href="details.html">Blindspotting</a></h3>
                            <span class="card__category">
                                <a href="#">Comedy</a>
                                <a href="#">Drama</a>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- end card -->

                <!-- card -->
                <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                    <div class="card">
                        <div class="card__cover">
                            <img src="img/covers/cover17.jpg" alt="">
                            <a href="details.html" class="card__play">
                                <i class="icon ion-ios-play"></i>
                            </a>
                            <span class="card__rate card__rate--green">8.0</span>
                        </div>
                        <div class="card__content">
                            <h3 class="card__title"><a href="details.html">I Dream in Another Language</a></h3>
                            <span class="card__category">
                                <a href="#">Action</a>
                                <a href="#">Triler</a>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- end card -->

                <!-- card -->
                <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                    <div class="card">
                        <div class="card__cover">
                            <img src="img/covers/cover18.jpg" alt="">
                            <a href="details.html" class="card__play">
                                <i class="icon ion-ios-play"></i>
                            </a>
                            <span class="card__rate card__rate--green">7.1</span>
                        </div>
                        <div class="card__content">
                            <h3 class="card__title"><a href="details.html">Benched</a></h3>
                            <span class="card__category">
                                <a href="#">Comedy</a>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- end card -->
            </div>

            <div class="row">
                <!-- paginator -->
                <div class="col-12">
                    <ul class="paginator">
                        <li class="paginator__item paginator__item--prev">
                            <a href="#"><i class="icon ion-ios-arrow-back"></i></a>
                        </li>
                        <li class="paginator__item"><a href="#">1</a></li>
                        <li class="paginator__item paginator__item--active"><a href="#">2</a></li>
                        <li class="paginator__item"><a href="#">3</a></li>
                        <li class="paginator__item"><a href="#">4</a></li>
                        <li class="paginator__item paginator__item--next">
                            <a href="#"><i class="icon ion-ios-arrow-forward"></i></a>
                        </li>
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
                <!-- section title -->
                <div class="col-12">
                    <div class="section__title-wrap">
                        <h2 class="section__title">Expected premiere</h2>

                        <div class="section__nav-wrap">
                            <a href="catalog.html" class="section__view">View All</a>

                            <button class="section__nav section__nav--prev" type="button" data-nav="#carousel1">
                                <i class="icon ion-ios-arrow-back"></i>
                            </button>

                            <button class="section__nav section__nav--next" type="button" data-nav="#carousel1">
                                <i class="icon ion-ios-arrow-forward"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- end section title -->

                <!-- carousel -->
                <div class="col-12">
                    <div class="owl-carousel section__carousel" id="carousel1">
                        <div class="card">
                            <div class="card__cover">
                                <img src="img/covers/cover.jpg" alt="">
                                <a href="details.html" class="card__play">
                                    <i class="icon ion-ios-play"></i>
                                </a>
                                <span class="card__rate card__rate--green">8.4</span>
                            </div>
                            <div class="card__content">
                                <h3 class="card__title"><a href="details.html">I Dream in Another Language</a></h3>
                                <span class="card__category">
                                    <a href="#">Action</a>
                                    <a href="#">Triler</a>
                                </span>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card__cover">
                                <img src="img/covers/cover2.jpg" alt="">
                                <a href="details.html" class="card__play">
                                    <i class="icon ion-ios-play"></i>
                                </a>
                                <span class="card__rate card__rate--green">7.1</span>
                            </div>
                            <div class="card__content">
                                <h3 class="card__title"><a href="details.html">Benched</a></h3>
                                <span class="card__category">
                                    <a href="#">Comedy</a>
                                </span>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card__cover">
                                <img src="img/covers/cover3.jpg" alt="">
                                <a href="details.html" class="card__play">
                                    <i class="icon ion-ios-play"></i>
                                </a>
                                <span class="card__rate card__rate--red">6.3</span>
                            </div>
                            <div class="card__content">
                                <h3 class="card__title"><a href="details.html">Whitney</a></h3>
                                <span class="card__category">
                                    <a href="#">Romance</a>
                                    <a href="#">Drama</a>
                                    <a href="#">Music</a>
                                </span>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card__cover">
                                <img src="img/covers/cover4.jpg" alt="">
                                <a href="details.html" class="card__play">
                                    <i class="icon ion-ios-play"></i>
                                </a>
                                <span class="card__rate card__rate--yellow">6.9</span>
                            </div>
                            <div class="card__content">
                                <h3 class="card__title"><a href="details.html">Blindspotting</a></h3>
                                <span class="card__category">
                                    <a href="#">Comedy</a>
                                    <a href="#">Drama</a>
                                </span>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card__cover">
                                <img src="img/covers/cover5.jpg" alt="">
                                <a href="details.html" class="card__play">
                                    <i class="icon ion-ios-play"></i>
                                </a>
                                <span class="card__rate card__rate--green">8.4</span>
                            </div>
                            <div class="card__content">
                                <h3 class="card__title"><a href="details.html">I Dream in Another Language</a></h3>
                                <span class="card__category">
                                    <a href="#">Action</a>
                                    <a href="#">Triler</a>
                                </span>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card__cover">
                                <img src="img/covers/cover6.jpg" alt="">
                                <a href="details.html" class="card__play">
                                    <i class="icon ion-ios-play"></i>
                                </a>
                                <span class="card__rate card__rate--green">7.1</span>
                            </div>
                            <div class="card__content">
                                <h3 class="card__title"><a href="details.html">Benched</a></h3>
                                <span class="card__category">
                                    <a href="#">Comedy</a>
                                </span>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card__cover">
                                <img src="img/covers/cover7.jpg" alt="">
                                <a href="details.html" class="card__play">
                                    <i class="icon ion-ios-play"></i>
                                </a>
                                <span class="card__rate card__rate--green">7.1</span>
                            </div>
                            <div class="card__content">
                                <h3 class="card__title"><a href="details.html">Benched</a></h3>
                                <span class="card__category">
                                    <a href="#">Comedy</a>
                                </span>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card__cover">
                                <img src="img/covers/cover8.jpg" alt="">
                                <a href="details.html" class="card__play">
                                    <i class="icon ion-ios-play"></i>
                                </a>
                                <span class="card__rate card__rate--red">5.5</span>
                            </div>
                            <div class="card__content">
                                <h3 class="card__title"><a href="details.html">I Dream in Another Language</a></h3>
                                <span class="card__category">
                                    <a href="#">Action</a>
                                    <a href="#">Triler</a>
                                </span>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card__cover">
                                <img src="img/covers/cover9.jpg" alt="">
                                <a href="details.html" class="card__play">
                                    <i class="icon ion-ios-play"></i>
                                </a>
                                <span class="card__rate card__rate--yellow">6.7</span>
                            </div>
                            <div class="card__content">
                                <h3 class="card__title"><a href="details.html">Blindspotting</a></h3>
                                <span class="card__category">
                                    <a href="#">Comedy</a>
                                    <a href="#">Drama</a>
                                </span>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card__cover">
                                <img src="img/covers/cover10.jpg" alt="">
                                <a href="details.html" class="card__play">
                                    <i class="icon ion-ios-play"></i>
                                </a>
                                <span class="card__rate card__rate--red">5.6</span>
                            </div>
                            <div class="card__content">
                                <h3 class="card__title"><a href="details.html">Whitney</a></h3>
                                <span class="card__category">
                                    <a href="#">Romance</a>
                                    <a href="#">Drama</a>
                                    <a href="#">Music</a>
                                </span>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card__cover">
                                <img src="img/covers/cover11.jpg" alt="">
                                <a href="details.html" class="card__play">
                                    <i class="icon ion-ios-play"></i>
                                </a>
                                <span class="card__rate card__rate--green">9.2</span>
                            </div>
                            <div class="card__content">
                                <h3 class="card__title"><a href="details.html">Benched</a></h3>
                                <span class="card__category">
                                    <a href="#">Comedy</a>
                                </span>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card__cover">
                                <img src="img/covers/cover12.jpg" alt="">
                                <a href="details.html" class="card__play">
                                    <i class="icon ion-ios-play"></i>
                                </a>
                                <span class="card__rate card__rate--green">8.4</span>
                            </div>
                            <div class="card__content">
                                <h3 class="card__title"><a href="details.html">I Dream in Another Language</a></h3>
                                <span class="card__category">
                                    <a href="#">Action</a>
                                    <a href="#">Triler</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- carousel -->
            </div>
        </div>
    </section>
    <!-- end section -->

    <!-- section -->
    <section class="section section--border">
        <div class="container">
            <div class="row">
                <div class="col-12 col-xl-10">
                    <h2 class="section__title section__title--mb"><b>HotFlix</b> – Best Place for Movies</h2>

                    <p class="section__text">It is a long established fact that a reader will be distracted by the
                        readable content of a page when looking at its layout. The point of <b>using Lorem</b> Ipsum is
                        that it has a more-or-less normal distribution of letters, as opposed to using. Many desktop
                        publishing packages and web page editors now use Lorem Ipsum as their default model text, and a
                        search for 'lorem ipsum' will uncover many web sites still in their infancy.</p>

                    <p class="section__text">Content here, content here, making it look like <a
                            href="#">readable</a> English. Many desktop publishing packages and web page editors
                        now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover
                        many web sites still in their infancy. Various versions have evolved over the years, sometimes
                        by accident, sometimes on purpose (injected humour and the like).</p>
                </div>
            </div>

            <div class="row row--grid">
                <!-- price -->
                <div class="col-12 col-md-6 col-lg-4 order-md-2 order-lg-1">
                    <div class="price">
                        <div class="price__item price__item--first"><span>Basic</span> <span>Free</span></div>
                        <div class="price__item"><span><i class="icon ion-ios-checkmark"></i> 7 days</span></div>
                        <div class="price__item"><span><i class="icon ion-ios-checkmark"></i> 720p Resolution</span>
                        </div>
                        <div class="price__item price__item--none"><span><i class="icon ion-ios-close"></i> Limited
                                Availability</span></div>
                        <div class="price__item price__item--none"><span><i class="icon ion-ios-close"></i> Desktop
                                Only</span></div>
                        <div class="price__item price__item--none"><span><i class="icon ion-ios-close"></i> Limited
                                Support</span></div>
                        <a href="#" class="price__btn">Choose Plan</a>
                    </div>
                </div>
                <!-- end price -->

                <!-- price -->
                <div class="col-12 col-md-12 col-lg-4 order-md-1 order-lg-2">
                    <div class="price price--premium">
                        <div class="price__item price__item--first"><span>Premium</span> <span>$34.99 <sub>/
                                    month</sub></span></div>
                        <div class="price__item"><span><i class="icon ion-ios-checkmark"></i> 1 Month</span></div>
                        <div class="price__item"><span><i class="icon ion-ios-checkmark"></i> Full HD</span></div>
                        <div class="price__item"><span><i class="icon ion-ios-checkmark"></i> Lifetime
                                Availability</span></div>
                        <div class="price__item price__item--none"><span><i class="icon ion-ios-close"></i> TV &
                                Desktop</span></div>
                        <div class="price__item price__item--none"><span><i class="icon ion-ios-close"></i> 24/7
                                Support</span></div>
                        <a href="#" class="price__btn">Choose Plan</a>
                    </div>
                </div>
                <!-- end price -->

                <!-- price -->
                <div class="col-12 col-md-6 col-lg-4 order-md-3">
                    <div class="price">
                        <div class="price__item price__item--first"><span>Cinematic</span> <span>$49.99 <sub>/
                                    month</sub></span></div>
                        <div class="price__item"><span><i class="icon ion-ios-checkmark"></i> 2 Months</span></div>
                        <div class="price__item"><span><i class="icon ion-ios-checkmark"></i> Ultra HD</span></div>
                        <div class="price__item"><span><i class="icon ion-ios-checkmark"></i> Lifetime
                                Availability</span></div>
                        <div class="price__item"><span><i class="icon ion-ios-checkmark"></i> Any Device</span></div>
                        <div class="price__item"><span><i class="icon ion-ios-checkmark"></i> 24/7 Support</span>
                        </div>
                        <a href="#" class="price__btn">Choose Plan</a>
                    </div>
                </div>
                <!-- end price -->
            </div>
        </div>
    </section>
    <!-- end section -->

@endsection
