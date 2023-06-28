@extends('layouts.index')
@section('content')

    <div id="main-content-wp" class="clearfix detail-product-page">
        <div class="wp-inner">
            <div class="secion" id="breadcrumb-wp">
                <div class="secion-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="{{ url('/') }}" title="">Trang chủ</a>
                        </li>
                        @foreach ($categories as $item)
                            @if ($item->id == $same_category->parent_id)
                                <li>
                                    <a href="{{route('product.category', $item->slug )}}">{{ $item->name }}</a>
                                </li>
                            @endif
                        @endforeach
                        <li>
                            <a href="">{{ $same_category->name }}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="main-content fl-right">
                <div class="section" id="detail-product-wp">
                    <div class="section-detail clearfix">
                        <div class="thumb-wp fl-left">
                            <a href="" title="" id="main-thumb">
                                <img id="zoom" src="{{ url($product->feature_image_path) }}"
                                    data-zoom-image="{{ url($product->feature_image_path) }}"
                                    style="position:unset!important;object-fit: contain;" />
                            </a>
                            <div id="list-thumb">
                                @foreach ($product->images as $item)
                                    @if ($item->product_id == $product->id)
                                        <a href="" data-image="{{ url($item->image_path) }}"
                                            data-zoom-image="{{ url($item->image_path) }}">
                                            <img id="zoom" src="{{ url($item->image_path) }}" />
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="thumb-respon-wp fl-left">
                            <img src="{{ url($product->feature_image_path) }}" alt="">
                        </div>
                        <div class="info fl-right">
                            <h3 class="product-name">{{ $product->name }}</h3>

                            <div class="num-product">
                                <span class="title">Sản phẩm: </span>
                                <span class="status">Còn 100 sản phẩm</span>
                            </div>
                            <p class="price">{{ number_format($product->discount) }}đ</p>
                            {{-- <form action="{{ route('cart.add_submit', $product->id) }}" method="GET"> --}}
                            {{-- <form action="" method="GET"> --}}
                            {{-- @csrf --}}
                            <div id="num-order-wp">
                                Số lượng:
                                <a title="" id="minus"><i class="fa fa-minus"></i></a>
                                <input type="text" name="qty" value="1" id="num-order">
                                <a title="" id="plus"><i class="fa fa-plus"></i></a>
                            </div>
                            <a href="{{ route('cart.add', ['id' => $product->id]) }}" title="Thêm giỏ hàng"
                                data-id="{{ $product->id }}" title="" data-url="{{ url('cart/show') }}"
                                class="add-cart add-cart-ajax">Thêm giỏ hàng</a>
                            {{-- <button type="submit" class="btn add-cart add-cart-submit" >Thêm giỏ hàng</button> --}}
                            {{-- </form> --}}

                        </div>
                    </div>
                </div>
                <div class="section " id="post-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">Mô tả sản phẩm</h3>
                    </div>
                    <div class="section-detail" >

                        <div style="overflow-y: scroll;height:700px">
                            <div class="px-2">
                                {!! $product->content !!}
                            </div>
                        </div>

                    </div>
                </div>
                <div class="section" id="same-category-wp">
                    <div class="section-head">
                        <h3 class="section-title">Cùng chuyên mục</h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item">
                            @foreach ($same_category->products as $item)
                                <li>
                                    <a href="{{ route('product.detail', $item->slug) }}" title="" class="thumb">
                                        <img src="{{ url($item->feature_image_path) }}">
                                    </a>
                                    <a href="" title="" class="product-name">{{ $item->name }}</a>
                                    @if ($item->discount != $item->price)
                                        <div class="price">
                                            <span class="new">{{ number_format($item->discount) }}đ</span>
                                            <span class="old">{{ number_format($item->price) }}đ</span>
                                        </div>
                                    @else
                                        <div class="price">
                                            <span class="new text-center">{{ number_format($item->price) }}đ</span>
                                        </div>
                                    @endif
                                    <div class="action clearfix">
                                        <a href="{{ route('cart.add', ['id' => $item->id]) }}"
                                            data-id="{{ $item->id }}" title="" data-url="{{ url('cart/show') }}"
                                            class="add-cart add-cart-ajax fl-left">Thêm giỏ hàng</a>
                                        <a href="{{ route('cart.quick_checkout', ['id' => $item->id]) }}" title=""
                                            class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>

            @include('layouts.components.sidebar')
        </div>
    </div>

@endsection
