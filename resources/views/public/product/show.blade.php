@extends('layouts.index')
@section('content')
    <div class="main-content fl-right">
        <div class="section" id="list-product-wp">
            @foreach ($categories as $category)
                <div class="section-head">
                    <h3 class="section-title">{{ $category->name }}</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        @foreach ($data as $product)
                            @if ($category->id == $product->parent_id || $category->id == $product->category_id)
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
                                        <a href="{{ route('cart.add', ['id' => $product->id]) }}" data-id="{{$product->id}}" title="" data-url = "{{url('cart/show')}}"
                                            class="add-cart fl-left add-cart-ajax">Thêm giỏ hàng</a>
                                        <a href="{{ route('cart.quick_checkout', ['id' => $product->id]) }}" title="" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            @endforeach

        </div>
    </div>
    @include('layouts.components.sidebar')
@endsection
