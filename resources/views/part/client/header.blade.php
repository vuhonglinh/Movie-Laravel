<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="header__content">
                    <!-- header logo -->
                    <a href="{{ route('trangchu.index') }}" class="header__logo">
                        <img src="{{ asset('/client/img/logo.svg') }}" alt="">
                    </a>
                    <!-- end header logo -->

                    <!-- header nav -->
                    <ul class="header__nav">

                        <li class="header__nav-item">
                            <a href="{{ route('trangchu.index') }}" class="header__nav-link">Trang chủ</a>
                        </li>


                        <li class="header__nav-item">
                            <a class="dropdown-toggle header__nav-link" href="#" role="button"
                                id="dropdownMenuCatalog" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">Danh mục<i class="icon ion-ios-arrow-down"></i></a>

                            <ul class="dropdown-menu header__dropdown-menu" aria-labelledby="dropdownMenuCatalog">
                                @foreach ($categories as $item)
                                    <li><a href="{{ route('mucluc.categories', $item) }}">{{ $item->name }}</a></li>
                                @endforeach
                            </ul>
                        </li>

                        <li class="header__nav-item">
                            <a class="dropdown-toggle header__nav-link" href="#" role="button"
                                id="dropdownMenuCatalog" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">Thể loại<i class="icon ion-ios-arrow-down"></i></a>

                            <ul class="dropdown-menu header__dropdown-menu" aria-labelledby="dropdownMenuCatalog">
                                @foreach ($genres as $item)
                                    <li><a href="{{ route('mucluc.genres', $item) }}">{{ $item->name }}</a></li>
                                @endforeach
                            </ul>
                        </li>

                        <li class="header__nav-item">
                            <a class="dropdown-toggle header__nav-link" href="#" role="button"
                                id="dropdownMenuCatalog" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">Quốc gia<i class="icon ion-ios-arrow-down"></i></a>

                            <ul class="dropdown-menu header__dropdown-menu" aria-labelledby="dropdownMenuCatalog">
                                @foreach ($countries as $item)
                                    <li><a href="{{ route('mucluc.countries', $item) }}">{{ $item->name }}</a></li>
                                @endforeach
                            </ul>
                        </li>

                        <li class="dropdown header__nav-item">
                            <a class="dropdown-toggle header__nav-link header__nav-link--more" href="#"
                                role="button" id="dropdownMenuMore" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false"><i class="icon ion-ios-more"></i></a>

                            <ul class="dropdown-menu header__dropdown-menu scrollbar-dropdown"
                                aria-labelledby="dropdownMenuMore">    
                                <li><a href="{{ route('hoso.index') }}">Hồ sơ</a></li>
                            </ul>
                        </li>
                        <!-- end dropdown -->
                    </ul>
                    <!-- end header nav -->

                    <!-- header auth -->
                    <div class="header__auth">
                        <form action="{{ route('timkiem.index') }}" method="GET" class="header__search">
                            @csrf
                            <input class="header__search-input" name="name" required type="text"
                                placeholder="Tìm kiếm phim...">
                            <button class="header__search-button" type="submit">
                                <i class="icon ion-ios-search"></i>
                            </button>
                            <button class="header__search-close" type="button">
                                <i class="icon ion-md-close"></i>
                            </button>
                        </form>
                        <button class="header__search-btn" type="submit">
                            <i class="icon ion-ios-search"></i>
                        </button>

                        @if (auth('customer')->check())
                            <a href="{{ route('xacthuc.logout') }}" class="header__sign-in">
                                <i class="icon ion-ios-log-in"></i>
                                <span>Đăng xuất</span>
                            </a>
                        @else
                            <a href="{{ route('xacthuc.login') }}" class="header__sign-in">
                                <i class="icon ion-ios-log-in"></i>
                                <span>Đăng nhập</span>
                            </a>
                        @endif


                    </div>
                    <!-- end header auth -->

                    <!-- header menu btn -->
                    <button class="header__btn" type="button">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <!-- end header menu btn -->
                </div>
            </div>
        </div>
    </div>
</header>
