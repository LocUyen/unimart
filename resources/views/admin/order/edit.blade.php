@extends('layouts.admin')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y" id="content">
        {{-- <div id="content" class="container-fluid"> --}}

        <div class="card">
            <div class="card-header font-weight-bold d-flex justify-content-between align-products-center">
                <h5 class="m-0 ">CHI TIẾT ĐƠN HÀNG #DH_{{ $order->id }}</h5>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <div class="card shadow-lg">
                            <div class="p-4">
                                <div class="h5 text-primary"><i class="fa-solid fa-circle-info"></i> Thông tin khách hàng
                                </div>
                                <p>
                                <div><span class="fw-bold">HỌ TÊN </span></div>
                                <div>{{ $customer->name }}</div>
                                </p>
                                <p>
                                <div><span class="fw-bold">SĐT</span></div>
                                <div>{{ $customer->phone }}</div>
                                </p>
                                <p>
                                <div><span class="fw-bold">EMAIL</span></div>
                                <div>{{ $customer->email }}</div>
                                </p>
                                <p>
                                <div class="fw-bold">ĐỊA CHỈ</div>
                                <div>{{ $customer->address }} , Tỉnh {{$customer->province->name}}, {{$customer->district->name}}, {{$customer->wards->name}}</div>
                                </p>
                                <p>
                                <div class="fw-bold">NGÀY ĐẶT HÀNG</div>
                                <div>{{ $order->created_at }}</div>
                                </p>
                                <p>
                                <div class="fw-bold">GHI CHÚ</div>
                                <div>{{ $order->note }}</div>
                                </p>

                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div>
                            <div class=" text-primary fs-5">
                                <i class="fa-sharp fa-solid fa-money-check"></i> Phương thức thanh toán

                            </div>
                            <div class="ps-3">Thanh toán tại nhà</div>
                        </div>

                        <div class="h5 text-primary mt-4">
                            <i class="fa-solid fa-signal"></i> Trạng thái đơn hàng
                        </div>
                        <div class="form-action form-inline  col-6">
                            <form action="{{route('order.update', $order->id)}}" method="POST" class="d-flex">
                                @csrf
                                <select name="status" class="form-select placement-dropdown me-1" id="selectPlacement">
                                    @foreach ($status as $statuss)

                                            <option value="{{ $statuss->id }}"
                                                @if ($order->status_id == $statuss->id)
                                                 selected
                                                @endif
                                            >{{ $statuss->status }}</option>

                                    @endforeach
                                </select>
                                <input type="submit" name="btn_update" value="Cập nhật" class="btn btn-primary">
                            </form>
                        </div>

                        <div class="fs-5 text-primary mt-4">
                            <i class="fa-solid fa-circle-info"></i> Thông tin sản phẩm
                        </div>
                        <table class="table table-striped table-checkall">
                            <thead>
                                <tr>
                                    <th class="p-2">
                                        <input type="checkbox" name="checkall">
                                    </th>
                                    <th class="p-2" scope="col">#</th>
                                    <th class="p-2" scope="col">Ảnh</th>
                                    <th class="p-2" scope="col">Tên sản phẩm</th>
                                    {{-- <th class="p-2" scope="col">Số lượng</th> --}}
                                    <th class="p-2" scope="col">Giá</th>
                                    <th class="p-2" scope="col">Số lượng</th>
                                    <th class="p-2" scope="col">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $t = 0;
                                @endphp
                                @foreach ($order->products as $product)
                                    @foreach ($order_products as $item)
                                        @if ($product->id == $item->product_id)
                                            @php
                                                $t++;
                                            @endphp
                                            <tr>
                                                <td class="p-2">
                                                    <input type="checkbox">
                                                </td>
                                                <td class="p-2">{{ $t }}</td>
                                                <td class="p-2"><img src="{{ url($product->feature_image_path) }}" class="image_100_100"
                                                        alt=""></td>
                                                <td class="p-2"><span style="overflow-wrap: break-word;">{{ $product->name }}</span></td>
                                                <td class="p-2">{{ number_format($product->price) . 'đ' }}</td>
                                                <td class="p-2 text-center">{{ $item->quantity }}</td>
                                                <td class="p-2">{{ number_format($product->price * $item->quantity) . 'đ' }}</td>

                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                                <tr>
                                    <th colspan="5" class="p-2 text-end text-danger">Tổng</th>
                                    <th class="text-danger p-2 text-center">{{$order->total_qty}}</th>
                                    <th class="text-danger p-2">{{ number_format($order->total) . 'đ' }}</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- {{$orders->links()}} --}}
            </div>
        </div>
        {{-- </div> --}}
    </div>
@endsection
