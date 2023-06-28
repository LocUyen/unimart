@extends('layouts.index')
@section('content')
    <div class="main-content fl-right">
        <div class="section" id="slider-wp">
            <div class="section-detail">
                @foreach ($slider_home as $slider)
                    <div class="item">
                        <img href="{{ url($slider->link) }}" src="{{ url($slider->thumbnail) }}" alt="">
                    </div>
                @endforeach
            </div>
        </div>
        <div class="section" id="support-wp">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <div class="thumb">
                            <img src="{{ asset('client/images/icon-1.png') }}">
                        </div>
                        <h3 class="title">Miễn phí vận chuyển</h3>
                        <p class="desc">Tới tận tay khách hàng</p>
                    </li>
                    <li>
                        <div class="thumb">
                            <img src="{{ asset('client/images/icon-2.png') }}">
                        </div>
                        <h3 class="title">Tư vấn 24/7</h3>
                        <p class="desc">1900.9999</p>
                    </li>
                    <li>
                        <div class="thumb">
                            <img src="{{ asset('client/images/icon-3.png') }}">
                        </div>
                        <h3 class="title">Tiết kiệm hơn</h3>
                        <p class="desc">Với nhiều ưu đãi cực lớn</p>
                    </li>
                    <li>
                        <div class="thumb">
                            <img src="{{ asset('client/images/icon-4.png') }}">
                        </div>
                        <h3 class="title">Thanh toán nhanh</h3>
                        <p class="desc">Hỗ trợ nhiều hình thức</p>
                    </li>
                    <li>
                        <div class="thumb">
                            <img src="{{ asset('client/images/icon-5.png') }}">
                        </div>
                        <h3 class="title">Đặt hàng online</h3>
                        <p class="desc">Thao tác đơn giản</p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="section" id="feature-product-wp">
            <div class="section-head">
                <h3 class="section-title">Sản phẩm mới nhất</h3>
            </div>
            <div class="section-detail">
                <ul class="list-item">
                    @foreach ($products as $product)
                        <li>
                            <a href="{{ route('product.detail', $product->slug) }}" title="" class="thumb">
                                <img src="{{ url($product->feature_image_path) }}">
                            </a>
                            <a href="{{ route('product.detail', $product->slug) }}" title=""
                                class="product-name">{{ $product->name }}</a>
                            @if ($product->discount == $product->price)
                                <div class="price">
                                    <span class="new text-center">{{ number_format($product->price) }}đ</span>
                                </div>
                            @else
                                <div class="price">
                                    <span class="new">{{ number_format($product->discount) }}đ</span>
                                    <span class="old">{{ number_format($product->price) }}đ</span>
                                </div>
                            @endif
                            <div class="action clearfix">
                                <a href="{{ route('cart.add', ['id' => $product->id]) }}" data-id="{{ $product->id }}"
                                    title="" data-url="{{ url('cart/show') }}"
                                    class="add-cart add-cart-ajax fl-left">Thêm giỏ hàng</a>
                                <a href="{{ route('cart.quick_checkout', ['id' => $product->id]) }}" title=""
                                    class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="section" id="feature-product-wp">
            <div class="section-head">
                <h3 class="section-title">Sản phẩm nổi bật</h3>
            </div>
            <div id="slider-wp" class="section-detail">
                <ul class="list-item">
                    @foreach ($product_selling as $product)
                        <li>
                            <a href="{{ route('product.detail', $product->slug) }}" title="" class="thumb">
                                <img src="{{ url($product->feature_image_path) }}">
                            </a>
                            <a href="{{ route('product.detail', $product->slug) }}" title=""
                                class="product-name">{{ $product->name }}</a>
                            @if ($product->discount == $product->price)
                                <div class="price">
                                    <span class="new text-center">{{ number_format($product->price) }}đ</span>
                                </div>
                            @else
                                <div class="price">
                                    <span class="new">{{ number_format($product->discount) }}đ</span>
                                    <span class="old">{{ number_format($product->price) }}đ</span>
                                </div>
                            @endif
                            <div class="action clearfix">
                                <a href="{{ route('cart.add', ['id' => $product->id]) }}" data-id="{{ $product->id }}"
                                    title="" data-url="{{ url('cart/show') }}"
                                    class="add-cart add-cart-ajax fl-left">Thêm giỏ hàng</a>
                                <a href="{{ route('cart.quick_checkout', ['id' => $product->id]) }}" title=""
                                    class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                    @endforeach


                </ul>
            </div>
        </div>
        <div class="section" id="list-product-wp">
            @foreach ($categories as $category)
                <div class="section-head">
                    <h3 class="section-title">{{ $category->name }}</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        {{-- @if (!empty($category->CategoryChilren))
                            @foreach ($category->CategoryChilren as $children)
                                @foreach ($children->products as $product)
                                    <li>
                                        <a href="{{ route('product.detail', $product->slug) }}" title=""
                                            class="thumb">
                                            <img src="{{ url($product->feature_image_path) }}">
                                        </a>
                                        <a href="{{ route('product.detail', $product->slug) }}" title=""
                                            class="product-name">{{ $product->name }}</a>
                                        @if ($product->discount == $product->price)
                                            <div class="price">
                                                <span class="new text-center">{{ number_format($product->price) }}đ</span>
                                            </div>
                                        @else
                                            <div class="price">
                                                <span class="new">{{ number_format($product->discount) }}đ</span>
                                                <span class="old">{{ number_format($product->price) }}đ</span>
                                            </div>
                                        @endif

                                        <div class="action clearfix">
                                            <a href="{{ route('cart.add', ['id' => $product->id]) }}" title=""
                                                data-id="{{ $product->id }}" title=""
                                                data-url="{{ url('cart/show') }}"
                                                class="add-cart fl-left add-cart-ajax">Thêm
                                                giỏ hàng</a>
                                            <a href="{{ route('cart.quick_checkout', ['id' => $product->id]) }}"
                                                title="" class="buy-now fl-right">Mua ngay</a>
                                        </div>
                                    </li>
                                @endforeach
                            @endforeach
                        @endif --}}
                        @if (count($category->products) > 0)
                            @foreach ($category->products as $product)
                                <li>
                                    <a href="{{ route('product.detail', $product->slug) }}" title="" class="thumb">
                                        <img src="{{ url($product->feature_image_path) }}">
                                    </a>
                                    <a href="{{ route('product.detail', $product->slug) }}" title=""
                                        class="product-name">{{ $product->name }}</a>
                                    @if ($product->discount == $product->price)
                                        <div class="price">
                                            <span class="new text-center">{{ number_format($product->price) }}đ</span>
                                        </div>
                                    @else
                                        <div class="price">
                                            <span class="new">{{ number_format($product->discount) }}đ</span>
                                            <span class="old">{{ number_format($product->price) }}đ</span>
                                        </div>
                                    @endif

                                    <div class="action clearfix">
                                        <a href="{{ route('cart.add', ['id' => $product->id]) }}" title=""
                                            data-id="{{ $product->id }}" title=""
                                            data-url="{{ url('cart/show') }}" class="add-cart fl-left add-cart-ajax">Thêm
                                            giỏ hàng</a>
                                        <a href="{{ route('cart.quick_checkout', ['id' => $product->id]) }}"
                                            title="" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                            @endforeach
                        @else
                            @foreach ($category->CategoryChilren as $children)
                                @foreach ($children->products as $product)
                                    <li>
                                        <a href="{{ route('product.detail', $product->slug) }}" title=""
                                            class="thumb">
                                            <img src="{{ url($product->feature_image_path) }}">
                                        </a>
                                        <a href="{{ route('product.detail', $product->slug) }}" title=""
                                            class="product-name">{{ $product->name }}</a>
                                        @if ($product->discount == $product->price)
                                            <div class="price">
                                                <span class="new text-center">{{ number_format($product->price) }}đ</span>
                                            </div>
                                        @else
                                            <div class="price">
                                                <span class="new">{{ number_format($product->discount) }}đ</span>
                                                <span class="old">{{ number_format($product->price) }}đ</span>
                                            </div>
                                        @endif

                                        <div class="action clearfix">
                                            <a href="{{ route('cart.add', ['id' => $product->id]) }}" title=""
                                                data-id="{{ $product->id }}" title=""
                                                data-url="{{ url('cart/show') }}"
                                                class="add-cart fl-left add-cart-ajax">Thêm
                                                giỏ hàng</a>
                                            <a href="{{ route('cart.quick_checkout', ['id' => $product->id]) }}"
                                                title="" class="buy-now fl-right">Mua ngay</a>
                                        </div>
                                    </li>
                                @endforeach
                            @endforeach
                        @endif

                    </ul>
                </div>
            @endforeach
        </div>
    </div>
    @include('layouts.components.sidebar')
@endsection
<script type="text/javascript">
    function cart_alert() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        })
    }
</script>
