<li class="sidebar__nav-item ">
    <a class="sidebar__nav-link {{ routeActive($name) ? 'collapsed' : false }}" data-toggle="collapse"
        href="#{{ $name }}" role="button" aria-expanded="{{ routeActive($name) ? 'true' : 'false' }}"
        aria-controls="{{ $name }}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path
                d="M19,5.5H12.72l-.32-1a3,3,0,0,0-2.84-2H5a3,3,0,0,0-3,3v13a3,3,0,0,0,3,3H19a3,3,0,0,0,3-3V8.5A3,3,0,0,0,19,5.5Zm1,13a1,1,0,0,1-1,1H5a1,1,0,0,1-1-1V5.5a1,1,0,0,1,1-1H9.56a1,1,0,0,1,.95.68l.54,1.64A1,1,0,0,0,12,7.5h7a1,1,0,0,1,1,1Z" />
        </svg> <span>{{ $tilte }}</span> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path
                d="M17,9.17a1,1,0,0,0-1.41,0L12,12.71,8.46,9.17a1,1,0,0,0-1.41,0,1,1,0,0,0,0,1.42l4.24,4.24a1,1,0,0,0,1.42,0L17,10.59A1,1,0,0,0,17,9.17Z" />
        </svg></a>

    <ul class="collapse sidebar__menu {{ routeActive($name) ? 'show' : false }}" id="{{ $name }}">
        <li><a href="{{ route('admin.' . $name . '.index') }}" class="{{ menuActive('admin/'.$name)? 'active':false }}">Danh sách</a></li>
        <li><a href="{{ route('admin.' . $name . '.add') }}" class="{{ menuActive('admin/'.$name.'/add')? 'active' :false }}">Thêm mới</a></li>
    </ul>
</li>
