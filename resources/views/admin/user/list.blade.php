@extends('layouts.admin')
@section('content')
    <style>
        .pagination {
            margin-top: 15px;
            float: right;
        }
    </style>
    <div class="container-xxl flex-grow-1 container-p-y" id="content">
        {{-- <div id="content" class="container-fluid"> --}}
        @if (session('status'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card">
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <h5 class="m-0 ">DANH SÁCH THÀNH VIÊN</h5>
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
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'active']) }}" class="text-primary mx-1">Kích
                        hoạt<span class="text-muted"> ({{ $count[0] }})</span></a>
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'trash']) }}" class="text-primary mx-1">Vô hiệu
                        hóa<span class="text-muted"> ({{ $count[1] }})</span></a>
                </div>

                <form action="{{ url('admin/user/action') }}" method="">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-action form-inline py-3 d-flex col-6">
                                <select name="act" class="form-select placement-dropdown me-1" id="selectPlacement">
                                    <option>Chọn</option>
                                    @foreach ($list_act as $k => $act)
                                        <option value="{{ $k }}">{{ $act }}</option>
                                    @endforeach
                                </select>
                                <input type="submit" name="btn_action" value="Áp dụng" class="btn btn-primary">
                            </div>
                        </div>
                        <div class="col-6">
                            <p class="pt-5 float-end">Có {{ $users->total() }} thành viên</p>
                        </div>
                    </div>

                    <table class="table table-striped table-checkall">
                        <thead>
                            <tr class="fw-bolder">
                                <th>
                                    <input type="checkbox" name="checkall">
                                </th>
                                <th scope="col">#</th>
                                <th scope="col">Họ tên</th>
                                <th scope="col">Email</th>
                                <th scope="col">Quyền</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col" class="w-2">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>

                            {{-- @if ($users->total() > 0) --}}
                            @php
                                $t = 0;
                            @endphp
                            @foreach ($users as $user)
                                @php
                                    $t++;
                                @endphp
                                <tr>
                                    <td>
                                        <input type="checkbox" name="list_check[]" value="{{ $user->id }}">
                                    </td>
                                    <th scope="row">{{ $t }}</th>
                                    <td>
                                        <a href="{{ route('user.edit', $user->id) }}">{{ $user->name }}</a>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td class="p-2">
                                        <a href="{{ route('user.edit', $user->id) }}" class="">
                                            @foreach ($user->roles as $role)
                                                <span class="badge rounded-pill bg-label-primary">{{ $role->name }}</span>
                                            @endforeach
                                        </a>
                                    </td>

                                    <td>{{ $user->created_at }}</td>
                                    <td>
                                        @canany(['user.edit', 'user.delete'])
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    @can('user.edit')
                                                        <a href="{{ route('user.edit', $user->id) }}" class="dropdown-item"
                                                            href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                    @endcan
                                                    @can('user.delete')
                                                        @if (Auth::id() != $user->id && $status == 'active')
                                                            <a href="{{ route('user.delete', $user->id) }}"
                                                                onclick="return confirm('Bạn chắc chắn muốn xóa bản ghi này?')"
                                                                class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="bx bx-trash me-1"></i> Delete</a>
                                                        @endif
                                                    @endcan

                                                </div>
                                            </div>
                                        @endcanany

                                    </td>
                                </tr>
                            @endforeach
                            {{-- @else
                          <tr>
                            <td colspan="7">
                              <div class="alert alert-warning" role="alert">Không tìm thấy bảng ghi nào!!!</div>
                            </td>
                          </tr>
                        @endif --}}

                        </tbody>
                    </table>
                </form>
                {{ $users->links() }}
            </div>
        </div>

    </div>
@endsection
