@extends('layouts.index')
@section('content')
    <div id="main-content-wp" class="cart-page">
        <div class="section" id="breadcrumb-wp">
            <div class="wp-inner">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="{{ url('/') }}" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a href="" title="">Giỏ hàng</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="wrapper" class="wp-inner clearfix">
            <div class="section" id="info-cart-wp">
                <form action="{{ route('cart.update') }}" method="POST">
                    {{-- <form action="" method="POST"> --}}
                    @csrf
                    <div class="section-detail table-responsive" id="table_delete">
                        @if (Cart::count() > 0)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>STT</td>
                                        <td>Ảnh sản phẩm</td>
                                        <td>Tên sản phẩm</td>
                                        <td>Giá sản phẩm</td>
                                        <td>Số lượng</td>
                                        <td>Thành tiền</td>
                                        <td>Xóa</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $t = 0;
                                    @endphp
                                    @foreach (Cart::content() as $row)
                                        @php
                                            $t++;
                                        @endphp
                                        <tr>
                                            <td>{{ $t }}</td>
                                            {{-- <td>{{$row->options->thumbnail}}</td> --}}
                                            <td>
                                                <a href="{{ route('product.detail', Str::slug($row->name)) }}"
                                                    title="" class="thumb">
                                                    <img src="{{ url($row->options->thumbnail) }}" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('product.detail', Str::slug($row->name)) }}"
                                                    title="" class="name-product">{{ $row->name }}</a>
                                            </td>
                                            <td>{{ number_format($row->price, 0, ',', '.') }}đ</td>
                                            <td>
                                                <input type="number" data-id="{{ $row->rowId }}"
                                                    data-price="{{ $row->price }}" name="qty[{{ $row->rowId }}]"
                                                    min="1" max="100" value="{{ $row->qty }}" class="num-order w-25">
                                            </td>
                                            <td><span
                                                    id="sub_total_{{ $row->rowId }}">{{ number_format($row->total, 0, ',', '.') }}</span>đ
                                            </td>
                                            <td>
                                                <a href="{{ route('cart.remove', $row->rowId) }}"
                                                    data-id="{{ $row->rowId }}" title=""
                                                    class="del-product text-danger h5 action_delete"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="7">
                                            <div class="clearfix">
                                                <p id="total-price" class="fl-right">Tổng giá:
                                                    <span
                                                        id="total">{{ number_format(Cart::total(), 0, ',', '.') }}</span><span>đ</span>
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="7">
                                            <div class="clearfix">
                                                <div class="fl-right">
                                                    <a href="" title="" id="update-cart"
                                                        class="action_alldelete">Xóa tất cả sản phẩm</a>
                                                    {{-- <input type="submit" value="Cập nhật giỏ hàng" id="update-cart"> --}}
                                                    <a href="{{ route('order.checkout') }}" title=""
                                                        id="checkout-cart">Thanh toán</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        @else
                            <p>Có 0 sản phẩm trong giỏ hàng</p>
                        @endif

                    </div>
                </form>
                <p id="delete_allcart"></p>
            </div>
            <div class="section" id="action-cart-wp">
                <div class="section-detail">
                    <p class="title">Click vào <span>“Cập nhật giỏ hàng”</span> để cập nhật số lượng. Nhập vào số lượng
                        <span>0</span> để xóa sản phẩm khỏi giỏ hàng. Nhấn vào thanh toán để hoàn tất mua hàng.
                    </p>
                    <a href="{{ url('/') }}" title="" id="buy-more">Mua tiếp</a><br />
                    {{-- <a href="" title="" id="delete-cart"
                        class="action_delete">Xóa tất cả sản phẩm trong giỏ hàng</a> --}}
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            //cập nhật sp
            $('.num-order').change(function() {
                var qty = $(this).val();
                var rowId = $(this).attr('data-id');
                var price = $(this).attr('data-price');
                // console.log(price);

                $.ajax({
                    url: '{{ route('cart.update_ajax') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        qty: qty,
                        rowId: rowId,
                        price: price,
                    },
                    dataType: 'json', //html,json, text
                    success: function(data) {
                        
                        $("#sub_total_" + rowId).text(data.sub_total);
                        $("#total").text(data.total);
                    }
                });
            })
            // xóa tất cả sp
            $(document).on('click', '.action_alldelete', function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Bạn muốn xóa sản phẩm?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Tôi muốn xóa'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('cart.destroy') }}',
                            method: 'GET',
                            success: function(data) {
                                // alert(data);
                                if (data == 'success') {
                                    Swal.fire(
                                        'Xóa thành công',
                                        'Sản phẩm đã bị xóa',
                                        'success'
                                    );
                                    location.reload(true);
                                }
                            }
                        });
                    }
                })
            })


        });
    </script>
    @if (Session::has('message'))
        <script>
            Swal.fire({
                    icon: 'success',
                    title: '{{Session::get('message')}}',
                    showConfirmButton: false,
                    timer: 1500
                });
        </script>
    @endif
@endsection
