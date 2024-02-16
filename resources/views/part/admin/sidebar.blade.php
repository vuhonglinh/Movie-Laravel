<div class="sidebar">
    <!-- sidebar logo -->
    <a href="index.html" class="sidebar__logo">
        <img src="img/logo.svg" alt="">
    </a>
    <!-- end sidebar logo -->

    <!-- sidebar user -->
    <div class="sidebar__user">
        <div class="sidebar__user-title">
            <a href="">
                <span>{{ auth()->user()->name }}</span>
            </a>
        </div>

        <a class="sidebar__user-btn" href="{{ route('admin.logout') }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path
                    d="M4,12a1,1,0,0,0,1,1h7.59l-2.3,2.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0l4-4a1,1,0,0,0,.21-.33,1,1,0,0,0,0-.76,1,1,0,0,0-.21-.33l-4-4a1,1,0,1,0-1.42,1.42L12.59,11H5A1,1,0,0,0,4,12ZM17,2H7A3,3,0,0,0,4,5V8A1,1,0,0,0,6,8V5A1,1,0,0,1,7,4H17a1,1,0,0,1,1,1V19a1,1,0,0,1-1,1H7a1,1,0,0,1-1-1V16a1,1,0,0,0-2,0v3a3,3,0,0,0,3,3H17a3,3,0,0,0,3-3V5A3,3,0,0,0,17,2Z" />
            </svg>
        </a>
    </div>
    <!-- end sidebar user -->

    <!-- sidebar nav -->
    <ul class="sidebar__nav">
        <li class="sidebar__nav-item">
            <a href="{{ route('admin.dashboard.index') }}" class="sidebar__nav-link "><svg
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path
                        d="M20,8h0L14,2.74a3,3,0,0,0-4,0L4,8a3,3,0,0,0-1,2.26V19a3,3,0,0,0,3,3H18a3,3,0,0,0,3-3V10.25A3,3,0,0,0,20,8ZM14,20H10V15a1,1,0,0,1,1-1h2a1,1,0,0,1,1,1Zm5-1a1,1,0,0,1-1,1H16V15a3,3,0,0,0-3-3H11a3,3,0,0,0-3,3v5H6a1,1,0,0,1-1-1V10.25a1,1,0,0,1,.34-.75l6-5.25a1,1,0,0,1,1.32,0l6,5.25a1,1,0,0,1,.34.75Z" />
                </svg> <span>Điều khiển</span></a>
        </li>


        <!-- collapse -->
        @include('part.admin.item_menu', ['name' => 'categories', 'tilte' => 'Danh mục'])
        @include('part.admin.item_menu', ['name' => 'genres', 'tilte' => 'Thể loại'])
        @include('part.admin.item_menu', ['name' => 'countries', 'tilte' => 'Quốc gia'])
        @include('part.admin.item_menu', ['name' => 'movies', 'tilte' => 'Phim'])
        @include('part.admin.item_menu', ['name' => 'users', 'tilte' => 'Quản trị viên'])
        <!-- end collapse -->
    </ul>
    <!-- end sidebar nav -->

    <!-- sidebar copyright -->
    <div class="sidebar__copyright">© FlixTV.template, 2021. <br>Create by <a
            href="https://themeforest.net/user/dmitryvolkov/portfolio" target="_blank">Dmitry Volkov</a></div>
    <!-- end sidebar copyright -->
</div>
