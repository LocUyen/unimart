<div id="menu-respon">
    <a href="{{ url('/') }}" title="" class="logo">ISMART</a>
    <div id="menu-respon-wp">
        <ul class="" id="main-menu-respon">
            <li>
                <a href="{{ url('/') }}" title>Trang chủ</a>
            </li>
            @foreach ($categories_sidebar as $category)
                <li>
                    <a href="{{ route('product.category', $category->slug) }}" title="">{{ $category->name }}</a>

                    @if ($category->CategoryChilren->count())
                        <i class="fa fa-angle-right arrow" aria-hidden="true"></i>

                        <ul class="sub-menu">
                            @foreach ($category->CategoryChilren as $categoryChilren)
                                <li>
                                    <a href="{{ route('product.category', $categoryChilren->slug) }}"
                                        title="">{{ $categoryChilren->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
            @foreach ($menu_header as $menu)
                <li>
                    @if ($menu->link == 'bai-viet' )
                        <a href="{{ url($menu->link) }}">{{ $menu->name }}</a>
                    @endif
                </li>
            @endforeach
            @foreach ($menu_header as $menu)
                <li>
                    @if ($menu->link == 'gioi-thieu' || $menu->link == 'lien-he' )
                        <a href="{{ route('home.page', $menu->link) }}">{{ $menu->name }}</a>
                    @endif
                </li>
            @endforeach

        </ul>
    </div>
</div>
