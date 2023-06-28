@extends('layouts.admin')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y" id="content">
        {{-- <div id="content" class="container-fluid"> --}}
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card">
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <h5 class="">DANH SÁCH ĐƠN HÀNG</h5>

                <div class="form-search me-5">
                    <form action="#" class=" d-flex">
                        <input type="text" name="keyword" value="{{ request()->input('keyword') }}"
                            class="form-control form-search  me-1" placeholder="Tìm kiếm">
                        <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="analytic">
                    <a href="{{ url('admin/order/list') }}" class="text-primary mx-1">Tất cả<span
                            class="text-muted">({{ $order_count }})</span></a>
                    <a href="{{ request()->fullUrlWithQuery(['status' => '1']) }}" class="text-primary mx-1">Đang xử lý<span
                            class="text-muted">({{ $status_1 }})</span></a>
                    <a href="{{ request()->fullUrlWithQuery(['status' => '2']) }}" class="text-primary mx-1">Đang vận
                        chuyển<span class="text-muted">({{ $status_2 }})</span></a>
                    <a href="{{ request()->fullUrlWithQuery(['status' => '3']) }}" class="text-primary mx-1">Thành công<span
                            class="text-muted">({{ $status_3 }})</span></a>
                    <a href="{{ request()->fullUrlWithQuery(['status' => '4']) }}" class="text-primary mx-1">Hủy đơn<span
                            class="text-muted">({{ $status_4 }})</span></a>
                    <a class="text-primary mx-1">Doanh số<span
                            class="text-muted">({{ number_format($sum) . 'đ' }})</span></a>
                </div>
                <form action="{{ url('admin/order/action') }}" method="POST">
                    <div class="form-action form-inline py-3 col-3 ">
                        @csrf
                        <div class="form-action form-inline py-3 d-flex">
                            <select name="act" class="form-select placement-dropdown me-1" id="selectPlacement">
                                <option>Chọn</option>
                                <option value="delete">Xóa vĩnh viễn</option>
                            </select>
                            <input type="submit" name="btn_action" value="Áp dụng" class="btn btn-primary"
                                onclick="return confirm('Bạn chắc chắn muốn xóa vĩnh viễn đơn hàng??')">
                        </div>
                    </div>
                    <div class="col-12">
                        <table class="table table-striped table-checkall">
                            <thead>
                                <tr>
                                    <th class="p-2">
                                        <input type="checkbox" name="checkall">
                                    </th>
                                    <th class="p-2" scope="col">#</th>
                                    <th class="p-2" scope="col">Mã đơn</th>
                                    <th class="p-2" scope="col">Khách hàng</th>
                                    <th class="p-2" scope="col">Tổng tiền</th>
                                    <th class="p-2" scope="col">Số lượng</th>
                                    <th class="p-2" scope="col">Trạng thái</th>
                                    <th class="p-2" scope="col">Thời gian</th>
                                    <th class="p-2" scope="col" class="w-2">Tác vụ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $t = 0;
                                @endphp
                                @foreach ($orders as $order)
                                    @php
                                        $t++;
                                    @endphp
                                    <tr>
                                        <td class="p-2">
                                            <input type="checkbox" name="list_check[]" value="{{ $order->id }}">
                                        </td>
                                        <td class="p-2">{{ $t }}</td>
                                        <td class="p-2"><a
                                                href="{{ route('order.edit', $order->id) }}">DH_{{ $order->id }}</a>
                                        </td>
                                        <td class="p-2">
                                            <a href="{{ route('order.edit', $order->id) }}">
                                                {{ $order->name }}<br>
                                                {{ $order->phone }}
                                            </a>
                                        </td>
                                        {{-- <td class="p-2">1</td> --}}
                                        <td class="p-2">{{ number_format($order->total) . 'đ' }}</td>
                                        <td class="p-2" class="text-center">{{ $order->total_qty }}</td>
                                        @if ($order->status_id == '1')
                                            <td class="p-2"><a href="{{ route('order.edit', $order->id) }}"><span
                                                        class="badge bg-primary">{{ $order->status }}</span></a></td>
                                        @endif
                                        @if ($order->status_id == 2)
                                            <td class="p-2"><a href="{{ route('order.edit', $order->id) }}"><span
                                                        class="badge bg-warning">{{ $order->status }}</span></a></td>
                                        @endif
                                        @if ($order->status_id == 3)
                                            <td class="p-2"><a href="{{ route('order.edit', $order->id) }}"><span
                                                        class="badge bg-success">{{ $order->status }}</span></a></td>
                                        @endif
                                        @if ($order->status_id == 4)
                                            <td class="p-2"><a href="{{ route('order.edit', $order->id) }}"><span
                                                        class="badge bg-danger">{{ $order->status }}</span></a></td>
                                        @endif


                                        <td class="p-2">{{ $order->created_at }}</td>
                                        <td class="p-2" class="">
                                            <div class="d-flex ">
                                                @can('order.edit')
                                                    <button type="button" class="btn btn-success rounded me-1 border-0 p-1">
                                                        <a class="py-3 ps-2 pe-1"
                                                            href="{{ route('order.edit', $order->id) }}"><i
                                                                class="bx bx-edit-alt me-1"></i></a>
                                                    </button>
                                                @endcan
                                                @can('order.delete')
                                                    <button type="button" class="btn btn-danger rounded border-0 p-1">
                                                        <a class="py-3 ps-2 pe-1"
                                                            href="{{ route('delete_order', $order->id) }}"
                                                            onclick="return confirm('Bạn thực sự muốn xóa đơn hàng, đơn sẽ bị xóa vĩnh viễn?')"><i
                                                                class="bx bx-trash me-1"></i></a>
                                                    </button>
                                                @endcan

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </form>
                {{ $orders->links() }}
            </div>
        </div>
        {{-- </div> --}}
    </div>
@endsection
