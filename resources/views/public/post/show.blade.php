@extends('layouts.index')
<style>

</style>
@section('content')
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="{{url('/')}}" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">24h công nghệ</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title h3">24h công nghệ</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        @foreach ($posts as $post)
                            <li class="clearfix">
                                <a href="{{route('post.detail', $post->slug)}}" title="" class="thumb fl-left">
                                    <img src="{{url($post->thumbnail)}}" alt="">
                                </a>
                                <div class="info fl-right">
                                    <a href="{{route('post.detail', $post->slug)}}" title="" class="title">{{$post->title}}</a>
                                    <span class="create-date">{{$post->created_at}}</span>
                                    <div class="desc">{!!$post->desc!!}</div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
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
            {{-- {{$posts->links()}} --}}
        </div>
        @include('layouts.components.sidebar')

@endsection
