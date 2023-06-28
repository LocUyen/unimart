<div class="sidebar fl-left">
    <div class="section" id="category-product-wp">
        <div class="section-head">
            <h3 class="section-title">Danh mục sản phẩm</h3>
        </div>
        <div class="secion-detail">
            <ul class="list-item">
                @foreach ($categories_sidebar as $category)
                    <li>
                        <a href="{{ route('product.category', $category->slug) }}" title="">{{ $category->name }}</a>

                        @if ($category->CategoryChilren->count())
                            <i class="fa fa-angle-right arrow" aria-hidden="true"></i>

                            <ul class="sub-menu">
                                @foreach ($category->CategoryChilren as $categoryChilren)
                                    <li>
                                        <a href="{{ route('product.category',$categoryChilren->slug) }}"
                                            title="">{{ $categoryChilren->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="section" id="selling-wp">
        <div class="section-head">
            <h3 class="section-title">Sản phẩm bán chạy</h3>
        </div>
        <div class="section-detail">
            <ul class="list-item">
                @foreach ($product_selling as $product)
                    @foreach ($category_sidebar as $category)
                        @if ($product->category_id == $category->id)
                            <li class="clearfix">
                                <a href="{{ route('product.detail', $product->slug) }}" title=""
                                    class="thumb fl-left">
                                    <img src="{{ url($product->feature_image_path) }}" alt="">
                                </a>
                                <div class="info fl-right">
                                    <a href="{{ route('product.detail', $product->slug) }}" title=""
                                        class="product-name">{{ $product->name }}</a>
                                    @if ($product->discount == $product->price)
                                        <div class="price">
                                            <span class="">{{ number_format($product->price) }}đ</span>
                                        </div>
                                    @else
                                        <div class="price">
                                            <span class="new">{{ number_format($product->discount) }}đ</span>
                                            <span class="old">{{ number_format($product->price) }}đ</span>
                                        </div>
                                    @endif
                                    <a href="{{ route('product.detail', $product->slug) }}" title=""
                                        class="buy-now">Xem chi tiết</a>
                                </div>
                            </li>
                        @endif
                    @endforeach
                @endforeach


            </ul>
        </div>
    </div>
    <div class="section" id="banner-wp">
        <div class="section-detail">
            <a href="" title="" class="thumb">
                <img src="{{ asset('client/images/banner.png') }}" alt="">
            </a>
        </div>
    </div>
</div>
