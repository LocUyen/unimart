@extends('layouts.admin')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y" id="content">
        {{-- <div id="content" class="container-fluid"> --}}
        @if (session('status'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card mt-3">
            <div class="card-header font-weight-bold ">

                <div class="row">
                    <div class="font-weight-bold d-flex justify-content-between align-items-center">
                        <div class="d-flex">
                            <h5 class="">DANH SÁCH QUYỀN</h5>

                        </div>

                        <div class="form-search">
                            <button class="btn btn-primary m-1 ms-3 float-end"><a href="{{ route('role.add') }}">Thêm
                                    mới</a></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-checkall">
                    <thead>
                        <tr class="fw-bolder">
                            <th class="p-2">
                                <input type="checkbox" name="checkall">
                            </th>
                            <th scope="col">#</th>
                            <th scope="col">Tên vai trò</th>
                            <th scope="col">Mô tả vai trò</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col" class="w-2">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $t = 0;
                        @endphp
                        @forelse ($roles as $role)
                            @php
                                $t++;
                            @endphp
                            <tr>
                                <td class="p-2">
                                    <input type="checkbox" name="list_check[]" value="">
                                </td>
                                <th scope="row">{{ $t }}</th>
                                <td>
                                    <a href="{{ route('role.edit', $role->id) }}">{{ $role->name }}</a>
                                </td>
                                <td>{{ $role->description }}</td>
                                <td>{{ $role->created_at }}</td>
                                <td>
                                    @canany(['role.edit', 'role.delete'])
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                @can('role.edit')
                                                    <a href="{{ route('role.edit', $role->id) }}" class="dropdown-item"
                                                        href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                @endcan
                                                @can('role.delete')
                                                    <a href="{{ route('role.delete', $role->id) }}"
                                                        onclick="return confirm('Bạn chắc chắn muốn xóa bản ghi này?')"
                                                        class="dropdown-item"><i class="bx bx-trash me-1"></i> Delete</a>
                                                @endcan

                                            </div>
                                        </div>
                                    @endcanany

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <p>Không có dữ liệu</p>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
                {{-- {{$roles->links()}} --}}
            </div>
        </div>
        {{-- </div> --}}
    </div>
@endsection
