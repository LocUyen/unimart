<div id="header-wp">
    <div id="head-top" class="clearfix">
        <div class="wp-inner">
            <a href="" title="" id="payment-link" class="fl-left">Hình thức thanh toán</a>
            <div id="main-menu-wp" class="fl-right">
                <ul id="main-menu" class="clearfix">
                    @foreach ($menu_header as $menu)
                        <li>
                            @if ($menu->link == 'gioi-thieu' || $menu->link == 'lien-he')
                                <a href="{{ route('home.page', $menu->link) }}">{{ $menu->name }}</a>
                            @else
                                <a href="{{ url($menu->link) }}">{{ $menu->name }}</a>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div id="head-body" class="clearfix">
        <div class="wp-inner">
            <a href="{{ url('/') }}" title="" id="logo" class="fl-left"><img
                    src="{{ asset('client/images/logo.png') }}" /></a>
            <div id="search-wp" class="fl-left">
                <form action="{{ route('search') }}">
                    @csrf
                    <input type="text" name="keyword" id="s" autocomplete="off"
                        placeholder="Nhập sản phẩm muốn tìm kiếm tại đây!">
                    <button type="submit" id="sm-s" value="tìm kiếm">Tìm kiếm</button>
                    <div id="list_product"></div>

                </form>

            </div>
            <div id="action-wp" class="fl-right">
                <div id="advisory-wp" class="fl-left">
                    <span class="title">Tư vấn</span>
                    <span class="phone">0987.654.321</span>
                </div>
                <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i></div>
                <a href="{{url('cart/show')}}" title="giỏ hàng" id="cart-respon-wp" class="fl-right">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    <span id="num">2</span>
                </a>
                <div id="cart-wp" class="fl-right">
                    <div id="btn-cart">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        <span id="num">{{ Cart::count() }}</span>
                    </div>
                    <div id="dropdown">
                        <p class="desc">Có <span>{{ Cart::count() }} sản phẩm</span> trong giỏ hàng</p>
                        <ul class="list-cart">
                            @foreach (Cart::content() as $row)
                                <li class="clearfix">
                                    <a href="" title="" class="thumb fl-left">
                                        <img src="{{ url($row->options->thumbnail) }}" alt="">
                                    </a>
                                    <div class="info fl-right">
                                        <a href="" title="" class="product-name">{{ $row->name }}</a>
                                        <p class="price">{{ number_format($row->price, 0, ',', '.') }}đ
                                        </p>
                                        <p class="qty">Số lượng: <span>{{ $row->qty }}</span></p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <div class="total-price clearfix">
                            <p class="title fl-left">Tổng:</p>
                            <p class="price fl-right">{{ number_format(Cart::total()) }}đ</p>
                        </div>
                        <div class="action-cart clearfix">
                            <a href="{{ url('cart/show') }}" title="Giỏ hàng" class="view-cart fl-left">Giỏ hàng</a>
                            <a href="{{ route('order.checkout') }}" title="Thanh toán" class="checkout fl-right">Thanh
                                toán</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

        $('#s').keyup(function() { //bắt sự kiện keyup khi người dùng gõ từ khóa tim kiếm
            var keyword = $(this).val(); //lấy gía trị ng dùng gõ
            // console.log(query);
            if (keyword != '') //kiểm tra khác rỗng thì thực hiện đoạn lệnh bên dưới
            {
                // var _token = $('input[name="_token"]').val(); // token để mã hóa dữ liệu
                $.ajax({
                    url: "{{ route('search.auto') }}", // đường dẫn khi gửi dữ liệu đi 'search' là tên route mình đặt bạn mở route lên xem là hiểu nó là cái j.
                    method: "POST", // phương thức gửi dữ liệu.
                    data: {
                        keyword: keyword,
                        _token: '{{csrf_token()}}'
                    },
                    success: function(data) { //dữ liệu nhận về
                        // console.log('ks');

                        $('#list_product').fadeIn();
                        $('#list_product').html(data); //nhận dữ liệu dạng html và gán vào cặp thẻ có id là list_product
                    }
                });
            } else {
                $('#list_product').fadeOut();
            }
        });

        $(document).on('click', '.li_search', function() {
            $('#s').val($(this).text());
            $('#list_product').fadeOut();
        });
        $(document).click(function(){
            $('ul.dropdown-menu').removeClass('d-block');
        });


    });
</script>
