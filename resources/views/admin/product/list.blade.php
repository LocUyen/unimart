@extends('layouts.admin')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y" id="content">
        {{-- <div id="content" class="container-fluid"> --}}
        <div class="card">
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <div class="d-flex">
                    <h5 class="">DANH SÁCH SẢN PHẨM</h5>
                    <button class="btn btn-primary m-1 ms-3"><a href="{{ url('admin/product/add') }}">Thêm mới</a></button>
                </div>

                <div class="form-search me-5">
                    <form action="#" class=" d-flex">
                        <input type="" name="keyword" class="form-control form-search me-1" placeholder="Tìm kiếm"
                            value="{{ request()->input('keyword') }}">
                        <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="analytic">
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'active']) }}">Kích hoạt<span
                            class="text-muted">({{ $count[0] }})</span></a>
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'trash']) }}" class="text-primary mx-1">Vô hiệu
                        hóa<span class="text-muted">({{ $count[1] }})</span></a>
                </div>
                <form action="{{ url('admin/product/action') }}" method="">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-action form-inline py-3 d-flex col-6">
                                <select name="act" class="form-select placement-dropdown me-1" id="selectPlacement">
                                    <option>Chọn</option>
                                    @foreach ($list_act as $k => $value)
                                        <option value="{{ $k }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                                <input type="submit" name="btn_action" value="Áp dụng" class="btn btn-primary">
                            </div>
                        </div>
                        <div class="col-6">
                            <p class="pt-5 float-end">Có {{ $products->total() }} sản phẩm</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-striped table-checkall">
                                <thead>
                                    <tr>
                                        <th class="p-2">
                                            <input type="checkbox" name="checkall">
                                        </th>
                                        <th scope="col" class="p-2">#</th>
                                        <th scope="col" class="text-center p-2">Ảnh</th>
                                        <th scope="col" class="p-2">Tên sản phẩm</th>
                                        <th scope="col" class="p-2">Giá</th>
                                        <!--<th scope="col" class="p-2">Giảm</th>-->
                                        <th scope="col" class="p-2">Danh mục</th>
                                        <th scope="col" class="p-2">Người tạo-Ngày tạo</th>
                                        <th scope="col" class="p-2">Trạng thái</th>
                                        <th scope="col" class="p-2">Tác vụ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        // dd($products->total());
                                    @endphp
                                    @if ($products->total() > 0)
                                        @php
                                            $t = 0;
                                        @endphp
                                        @foreach ($products as $product)
                                            @php
                                                $t++;
                                            @endphp
                                            <tr>
                                                <td class="p-2">
                                                    <input type="checkbox" name="list_check[]" value="{{ $product->id }}">
                                                </td>
                                                <td class="p-2">{{ $t }}</td>
                                                <td class="p-2"><img src="{{ url($product->feature_image_path) }}"
                                                        class="image_150_100" alt=""></td>
                                                <td class="p-2"><a
                                                        href="{{ route('product.edit', $product->id) }}">{{ $product->name }}</a>
                                                </td>
                                                <td class="p-2">{{ number_format($product->price) . 'đ' }}</td>
                                                <!--<td class="p-2">{{ number_format($product->discount) }}đ</td>-->
                                                <td class="p-2">{{ optional($product->category)->name }}</td>
                                                @foreach ($users as $user)
                                                    @if ($user->id == $product->user_id)
                                                        <td class="p-2">
                                                            {{ $user->name }}<br>{{ $product->created_at }}</td>
                                                    @endif
                                                @endforeach
                                                @if ($product->status == 1)
                                                    <td class="p-2"><span class="badge bg-success">Công khai</span></td>
                                                @else
                                                    <td class="p-2"><span class="badge bg-dark">Chờ duyệt</span></span>
                                                    </td>
                                                @endif

                                                <td class="p-2">
                                                    @canany(['product.edit', 'product.delete'])
                                                        <div class="dropdown">
                                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                                data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                @can('product.edit')
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('product.edit', $product->id) }}"><i
                                                                            class="bx bx-edit-alt me-1"></i>
                                                                        Edit
                                                                    </a>
                                                                @endcan
                                                                @can('product.delete')
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('delete_product', $product->id) }}"><i
                                                                            class="bx bx-trash me-1"
                                                                            onclick="return confirm('Bạn chắc chắn muốn xóa bản ghi này?')"></i>
                                                                        Delete
                                                                    </a>
                                                                @endcan

                                                            </div>
                                                        </div>
                                                    @endcanany
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="p-2" colspan="10">
                                                <div class="alert alert-warning" role="alert">Không tìm thấy bảng ghi
                                                    nào!!!</div>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>

                {{ $products->links() }}

            </div>
        </div>
        {{-- </div> --}}
    </div>
@endsection
