@extends('layouts.index')
@section('content')
<div class="secion" id="breadcrumb-wp">
    <div class="secion-detail">
        <ul class="list-item clearfix">
            <li>
                <a href="" title="">Trang chủ</a>
            </li>
            <li>
                <a href="" title="">24h công nghệ</a>
            </li>
            <li>
                <a href="" title="">{{$post->post_cat->name}}</a>
            </li>
        </ul>
    </div>
</div>
<div class="main-content fl-right">
    <div class="section" id="detail-blog-wp">
        <div class="section-head clearfix">
            <h3 class="section-title">{{$post->title}}</h3>
        </div>
        <div class="section-detail">
            <span class="create-date">{{$post->created_at}}</span>
            <div class="detail">
                {!!$post->content!!}
            </div>
        </div>
    </div>
    <div class="section" id="social-wp">
        <div class="section-detail">
            <div class="fb-like" data-href="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
            <div class="g-plusone-wp">
                <div class="g-plusone" data-size="medium"></div>
            </div>
            <div class="fb-comments" id="fb-comment" data-href="" data-numposts="5"></div>
        </div>
    </div>
</div>
<div class="sidebar fl-left">
    <div class="section" id="selling-wp">
        <div class="section-head">
            <h3 class="section-title">Sản phẩm bán chạy</h3>
        </div>
        <div class="section-detail">
            <ul class="list-item">
                <li class="clearfix">
                    <a href="?page=detail_product" title="" class="thumb fl-left">
                        <img src="public/images/img-pro-13.png" alt="">
                    </a>
                    <div class="info fl-right">
                        <a href="?page=detail_product" title="" class="product-name">Laptop Asus A540UP I5</a>
                        <div class="price">
                            <span class="new">5.190.000đ</span>
                            <span class="old">7.190.000đ</span>
                        </div>
                        <a href="" title="" class="buy-now">Mua ngay</a>
                    </div>
                </li>
                <li class="clearfix">
                    <a href="?page=detail_product" title="" class="thumb fl-left">
                        <img src="public/images/img-pro-11.png" alt="">
                    </a>
                    <div class="info fl-right">
                        <a href="?page=detail_product" title="" class="product-name">Iphone X Plus</a>
                        <div class="price">
                            <span class="new">15.190.000đ</span>
                            <span class="old">17.190.000đ</span>
                        </div>
                        <a href="" title="" class="buy-now">Mua ngay</a>
                    </div>
                </li>
                <li class="clearfix">
                    <a href="?page=detail_product" title="" class="thumb fl-left">
                        <img src="public/images/img-pro-12.png" alt="">
                    </a>
                    <div class="info fl-right">
                        <a href="?page=detail_product" title="" class="product-name">Iphone X Plus</a>
                        <div class="price">
                            <span class="new">15.190.000đ</span>
                            <span class="old">17.190.000đ</span>
                        </div>
                        <a href="" title="" class="buy-now">Mua ngay</a>
                    </div>
                </li>
                <li class="clearfix">
                    <a href="?page=detail_product" title="" class="thumb fl-left">
                        <img src="public/images/img-pro-05.png" alt="">
                    </a>
                    <div class="info fl-right">
                        <a href="?page=detail_product" title="" class="product-name">Iphone X Plus</a>
                        <div class="price">
                            <span class="new">15.190.000đ</span>
                            <span class="old">17.190.000đ</span>
                        </div>
                        <a href="" title="" class="buy-now">Mua ngay</a>
                    </div>
                </li>
                <li class="clearfix">
                    <a href="?page=detail_product" title="" class="thumb fl-left">
                        <img src="public/images/img-pro-22.png" alt="">
                    </a>
                    <div class="info fl-right">
                        <a href="?page=detail_product" title="" class="product-name">Iphone X Plus</a>
                        <div class="price">
                            <span class="new">15.190.000đ</span>
                            <span class="old">17.190.000đ</span>
                        </div>
                        <a href="" title="" class="buy-now">Mua ngay</a>
                    </div>
                </li>
                <li class="clearfix">
                    <a href="?page=detail_product" title="" class="thumb fl-left">
                        <img src="public/images/img-pro-23.png" alt="">
                    </a>
                    <div class="info fl-right">
                        <a href="?page=detail_product" title="" class="product-name">Iphone X Plus</a>
                        <div class="price">
                            <span class="new">15.190.000đ</span>
                            <span class="old">17.190.000đ</span>
                        </div>
                        <a href="" title="" class="buy-now">Mua ngay</a>
                    </div>
                </li>
                <li class="clearfix">
                    <a href="?page=detail_product" title="" class="thumb fl-left">
                        <img src="public/images/img-pro-18.png" alt="">
                    </a>
                    <div class="info fl-right">
                        <a href="?page=detail_product" title="" class="product-name">Iphone X Plus</a>
                        <div class="price">
                            <span class="new">15.190.000đ</span>
                            <span class="old">17.190.000đ</span>
                        </div>
                        <a href="" title="" class="buy-now">Mua ngay</a>
                    </div>
                </li>
                <li class="clearfix">
                    <a href="?page=detail_product" title="" class="thumb fl-left">
                        <img src="public/images/img-pro-15.png" alt="">
                    </a>
                    <div class="info fl-right">
                        <a href="?page=detail_product" title="" class="product-name">Iphone X Plus</a>
                        <div class="price">
                            <span class="new">15.190.000đ</span>
                            <span class="old">17.190.000đ</span>
                        </div>
                        <a href="" title="" class="buy-now">Mua ngay</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="section" id="banner-wp">
        <div class="section-detail">
            <a href="?page=detail_product" title="" class="thumb">
                <img src="public/images/banner.png" alt="">
            </a>
        </div>
    </div>
</div>
@endsection
