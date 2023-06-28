@extends('layouts.index')
@section('content')
<div class="secion" id="breadcrumb-wp">
    <div class="secion-detail">
        <ul class="list-item clearfix">
            <li>
                <a href="" title="">Trang chủ</a>
            </li>
            <li>
                <a href="" title="">Thông tin</a>
            </li>
            <li>
                <a href="" title="">{{$page->title}}</a>
            </li>
        </ul>
    </div>
</div>
<div class="main-content fl-right">
    <div class="section" id="detail-blog-wp">
        <div class="section-head clearfix">
            <h3 class="section-title">{{$page->title}}</h3>
        </div>
        <div class="section-detail">
            <span class="create-date">{{$page->created_at}}</span>
            <div class="detail">
                {!!$page->desc!!}
            </div>
        </div>
    </div>
</div>
@include('layouts.components.sidebar')

@endsection
