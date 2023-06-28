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
                        <a href="" title="">Thanh toán</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <form method="POST" action="{{ route('order.store') }}" name="form-checkout">
    @csrf
        <div id="wrapper" class="wp-inner clearfix row">
            @if (session('status'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="section " id="customer-info-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin khách hàng</h1>
                </div>
                <div class="section-detail">
                    <div class="row">
                        <div class="col-6">
                            <label for="fullname" class="form-label fw-bold">Họ tên<span
                                    class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control rounded-0 " id="fullname"
                                value="{{ old('name') }}">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>


                        <div class="col-6">
                            <label for="email" class="form-label fw-bold">Email<span class="text-danger">*</span></label>
                            <input type="text" name="email" class="form-control rounded-0" id="email"
                                placeholder="abc@gmail.com" value="{{ old('email') }}">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <label for="phone" class="form-label fw-bold">Số điện thoại<span
                                    class="text-danger">*</span></label>
                            <input type="tel" name="phone" class="form-control rounded-0" id="phone"
                                value="{{ old('phone') }}">
                            @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-6">
                            <label for="address" class="form-label fw-bold">Tỉnh thành<span
                                    class="text-danger">*</span></label>
                            <select class="form-select rounded-0 choose province" id="province" name="province"
                                aria-label=".form-select-sm">
                                <option value="" selected>Chọn tỉnh thành</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->province_id }}">{{ $province->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">

                        <div class="col-6">
                            <label for="address" class="form-label fw-bold">TP / quận huyện<span
                                    class="text-danger">*</span></label>
                            <select class="form-select rounded-0 choose district" id="district" name="district"
                                aria-label=".form-select-sm">
                                <option selectsed>Chọn quận huyện</option>
                                {{-- @foreach ($districts as $district)
                                    <option value="{{ $district->district_id }}">{{ $district->name }}</option>
                                @endforeach --}}
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="address" class="form-label fw-bold">Phường xã<span
                                    class="text-danger">*</span></label>
                            <select class="form-select rounded-0 wards" id="wards" name="wards"
                                aria-label=".form-select-sm">
                                <option selectsed>Chọn phường xã</option>
                                {{-- @foreach ($wards as $ward)
                                    <option value="{{ $ward->ward_id }}">{{ $ward->name }}</option>
                                @endforeach --}}
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <label for="address" class="form-label fw-bold">Địa chỉ<span
                                    class="text-danger">*</span></label>
                            <input type="text" name="address" class="form-control rounded-0" id="address"
                                value="{{ old('address') }}">
                            @error('address')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row mt-3">
                        <label for="notes">Ghi chú</label>
                        <textarea name="note" class="form-control rounded-0" placeholder="Nếu có" rows="4" id="comment"
                            name="text" value="{{ old('note') }}"></textarea>
                    </div>
                </div>
            </div>
            <div class="section " id="order-review-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin đơn hàng</h1>
                </div>
                <div class="section-detail">
                    <table class="shop-table">
                        <thead>
                            <tr>
                                <td>Sản phẩm</td>
                                <td>Tổng</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (Cart::content() as $row)
                                <tr class="cart-item">
                                    <td class="product-name">{{ $row->name }}<strong
                                            class="product-quantity text-danger">x{{ $row->qty }}</strong></td>
                                    <td class="product-total">{{ number_format($row->price, 0, ',', '.') }}đ</td>
                                </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr class="order-total">
                                <td>Tổng đơn hàng:</td>
                                <td><strong class="total-price">{{ number_format(Cart::total(), 0, ',', '.') }}đ</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                    <div id="payment-checkout-wp">
                        <ul id="payment_methods">
                            @foreach ($payments as $payment)
                                <li>
                                    <input type="radio" id="direct-payment" name="payment-method" value="{{ $payment->id }}"
                                        checked>
                                    <label for="direct-payment">{{ $payment->name }}</label>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="place-order-wp clearfix">
                        <input type="submit" id="order-now" value="Đặt hàng">
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.choose').change(function() {
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                // alert(action);
                // alert(ma_id);
                var result = '';
                if (action == 'province') {
                    result = 'district';
                } else {
                    result = 'wards';
                }
                $.ajax({
                    url: '{{ route('order.address_ajax') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        action: action,
                        ma_id: ma_id,
                    },
                    dataType: 'html',
                    success: function(data) {
                        $('#' + result).html(data);
                        // alert('Success');
                    }
                });
            })
        });
    </script>
@endsection
