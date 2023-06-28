@extends('layouts.index')
@section('content')
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?page=home" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Đặt hàng thành công</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <div class="section" id="info-cart-wp">
            <div class="section-detail table-responsive">
                <div class="row">
                    <div class="col-12">
                        <p class="text-success text-center fw-bold h3 "><i class="fa-solid fa-check"></i></p>
                    </div>
                    <div class="col-12">
                        <h1 class="text-success text-center fw-bold h4">Đặt hàng thành công!!</h1>
                    </div>
                    <div class="col-12">
                        <p class="text-center h6">Cảm ơn quý khách đã đặt hàng tại ismart của chúng tôi</p>
                        <p class="text-center h6">Đội ngũ chăm sóc khách hàng sẽ liên hệ sớm nhất có thể để xác nhận đơn hàng</p>
                    </div>
                        <div class="col-12">
                            <div class="h6 fw-bold">Mã đơn hàng: DH_{{$order_id}}</div>
                        </div>
                        <div class="col-12">
                            <div class="col-12 h6 text-primary "><i class="fa-solid fa-circle-info"></i> Thông tin khách hàng</div>
                            <table class="table border border-3">
                                <thead>
                                  <tr class="text-center border-bottom">
                                    <th>Tên khách hàng</th>
                                    <th>Địa chỉ</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>{{$customer->name}}</td>
                                    <td>{{$customer->address}}, Tỉnh {{$customer->province->name}}, {{$customer->district->name}}, {{$customer->wards->name}}</td>
                                    <td>{{$customer->email}}</td>
                                    <td>{{$customer->phone}}</td>
                                  </tr>

                                </tbody>
                              </table>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="col-12 h6 text-primary "><i class="fa-solid fa-circle-info"></i> Thông tin khách hàng</div>
                            <table class="table table-bordered border border-3">
                                <thead>
                                  <tr class="text-center border-bottom">
                                    <th>Ảnh</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order_product as $row)
                                        <tr class="border-bottom">
                                            <td>
                                                <a href="" class="thumb">
                                                    <img class="m-0" src="{{url($row->options->thumbnail)}}" alt="" >

                                                </a>
                                            </td>
                                            <td>{{$row->name}}</td>
                                            <td>{{number_format($row->price, 0, ',','.')}}đ</td>
                                            <td>{{$row->qty}}</td>
                                            <td>{{number_format($row->total, 0, ',','.')}}đ</td>

                                        </tr>

                                    @endforeach
                                    <tr>
                                        <th class="text-end text-danger" colspan="10">Tổng: {{number_format($order_total, 0, ',','.')}}đ</th>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center mt-3">
                                <button class="btn btn-danger"><a href="{{url('/')}}" class="" style="color:aliceblue;">Về Trang Chủ</a></button>
                            </div>
                        </div>
                </div>

            </div>


        </div>

    </div>

@php

@endphp

@endsection

