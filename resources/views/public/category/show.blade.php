@extends('layouts.index')
@section('content')
    <div class="section" id="breadcrumb-wp">
        <div class="section-detail">
            <ul class="list-item clearfix">
                <li>
                    <a href="{{ url('/') }}" title="">Trang chủ</a>
                </li>
                        <li>
                            {{-- <a href="">{{ $item->name }}</a> --}}
                        </li>
                <li>
                    <a href="" title="">{{ $category->name }}</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-content fl-right">
        <div class="section" id="list-product-wp">
            <div class="section-head clearfix">
                <h3 class="section-title fl-left">{{ $category->name }}</h3>
                <div class="filter-wp fl-right">

                    <p class="desc">Hiển thị {{ $products->count() }} trên {{ $products->count() }} sản phẩm
                    </p>

                    <div class="form-filter">
                        <form>
                            @csrf
                            <select name="sort" id="sort">
                                <option value="">Sắp xếp</option>
                                <option value="{{ Request::url() }}?sort=az">Từ A-Z</option>
                                <option value="{{ Request::url() }}?sort=za">Từ Z-A</option>
                                <option value="{{ Request::url() }}?sort=hl">Giá cao xuống thấp</option>
                                <option value="{{ Request::url() }}?sort=lh">Giá thấp lên cao</option>
                            </select>
                        </form>
                    </div>
                </div>
            </div>
            <div class="section-detail">
                @if ($products->count() > 0)
                    <ul class="list-item clearfix">
                        {{-- @php
                            $count=0;
                        @endphp --}}
                        @foreach ($products as $item)
                                {{-- @php
                                   $count++;
                                @endphp --}}
                                <li>
                                    <a href="{{ route('product.detail', $item->slug) }}" title="" class="thumb">
                                        <img src="{{ url($item->feature_image_path) }}">
                                    </a>
                                    <a href="{{ route('product.detail', $item->slug) }}" title=""
                                        class="product-name">{{ $item->name }}</a>
                                    @if ($item->discount == $item->price)
                                        <div class="price">
                                            <span class="new text-center">{{ number_format($item->price) }}đ</span>
                                        </div>
                                    @else
                                        <div class="price">
                                            <span class="new">{{ number_format($item->discount) }}đ</span>
                                            <span class="old">{{ number_format($item->price) }}đ</span>
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
                @else
                    {{-- @if ($count <= 0) --}}
                    <ul class="messeger-none-product">
                        <div class="messeger">Không tìm thấy sản phẩm nào</div>
                        <img src="{{ asset('assets/img/illustrations/page-misc-error-light.png') }}" alt="">
                    </ul>
                    {{-- @endif --}}

                @endif
            </div>
        </div>
        {{-- {{$data->links()}} --}}
        {{-- <div class="section" id="paging-wp">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">1</a>
                    </li>
                    <li>
                        <a href="" title="">2</a>
                    </li>
                    <li>
                        <a href="" title="">3</a>
                    </li>
                </ul>
            </div>
        </div> --}}
    </div>
    @include('layouts.components.sidebar_category')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#sort').change(function() {
                var url = $(this).val();
                // alert(url);
                if (url) {
                    window.location = url;
                }
                return false;
            });
        });
    </script>
@endsection
