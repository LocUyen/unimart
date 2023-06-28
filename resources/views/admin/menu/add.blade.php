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
        <div class="card">
            <div class="card-body">
                <div class="">
                    <h5 class="m-0 ">THÊM MENU</h5>
                </div>
                <form action="{{ url('admin/menu/store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group mb-1 mt-3 col-6">
                            <label for="name">Tên menu</label>
                            <input class="form-control mt-1" type="text" name="name" id="name"
                                onkeyup="ChangeToSlug();">

                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>


                        <div class="form-group mb-1 mt-3 col-6">
                            <label for="name">Link</label>
                            <input class="form-control mt-1" type="text" name="link" id="slug">
                            @error('link')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>

                    <div class="row">
                        <div class="form-group mb-1 mt-3 col-6">
                            <label for="">Danh mục cha</label>
                            <select id="defaultSelect" class="form-select mt-1" name="parent_id">
                                <option value="0">Chọn danh mục cha</option>
                                @foreach ($menus as $menu)
                                    <option value='{{ $menu->id }}'>
                                        {{ str_repeat('---|', $menu->level) . $menu->name }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="form-group mt-3 mt-3 col-2">
                            <label for="">Trạng thái</label>
                            <div class="form-check mt-1">
                                <input class="form-check-input" type="radio" name="status" id="exampleRadios1"
                                    value="1" checked>
                                <label class="form-check-label" for="exampleRadios1">
                                    Công khai
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="exampleRadios2"
                                    value="0">
                                <label class="form-check-label" for="exampleRadios2">
                                    Chờ duyệt
                                </label>
                            </div>
                        </div>
                        <div class="col-2 pt-4">
                            <button type="submit" value="add" class="btn btn-primary mt-3">Thêm mới</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <h5 class="m-0 ">DANH SÁCH MENU</h5>
            </div>
            <div class="card-body">
                <div class="row">
                </div>
                <table class="table table-striped table-checkall">
                    <thead>
                        <tr class="fw-bolder">

                            <th scope="col">#</th>
                            <th scope="col" class="mx-2">Tên menu</th>
                            <th scope="col" class="mx-5">Link</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col" class="">Người tạo</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col" class="w-2">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $t = 0;
                        @endphp
                        @foreach ($menus as $menu)
                            @php
                                $t++;
                            @endphp
                            <tr>
                                <th scope="row">{{ $t }}</th>
                                <td><a
                                        href="{{ route('menu.edit', $menu->id) }}">{{ str_repeat('---|', $menu->level) . $menu->name }}</a>
                                </td>
                                <td>{{ $menu->link }}</td>
                                @if ($menu->status == 1)
                                    <td><span class="badge bg-success">Công khai</span></td>
                                @else
                                    <td><span class="badge bg-dark">Chờ duyệt</span></td>
                                @endif
                                @foreach ($users as $user)
                                    @if ($user->id == $menu->user_id)
                                        <td>{{ $user->name }}</td>
                                    @endif
                                @endforeach
                                <td>{{ $menu->created_at }}</td>
                                <td>
                                    @canany(['menu.edit', 'menu.delete'])
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                @can('menu.edit')
                                                    <a href="{{ route('menu.edit', $menu->id) }}" class="dropdown-item"
                                                        href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                                @endcan
                                                @can('menu.delete')
                                                    <a href="{{ route('delete_menu', $menu->id) }}"
                                                        onclick="return confirm('Bạn chắc chắn muốn xóa bản ghi này?')"
                                                        class="dropdown-item"><i
                                                            class="bx bx-trash me-1"></i> Delete</a>
                                                @endcan
                                            </div>
                                        </div>
                                    @endcanany

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{-- </div> --}}
    </div>
@endsection
