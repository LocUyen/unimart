@extends('layouts.admin')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y" id="content">
        <div class="row">
            @if (session('status'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-4">
                <div class="card">

                    <div class="card-header font-weight-bold">
                        Thêm danh mục bài viết
                    </div>
                    <div class="card-body">
                        <form action="{{ url('admin/post/cat/store') }}" method="POST">
                            @csrf

                            <div class="form-group mb-1 mt-3">
                                <label for="name">Tên danh mục bài viết</label>
                                <input class="form-control mt-1" type="text" name="name" id="name"
                                    onkeyup="ChangeToSlug();">
                            </div>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                            <div class="form-group mb-1 mt-3">
                                <label for="name">Tên slug</label>
                                <input class="form-control mt-1" type="text" name="slug" id="slug">
                            </div>
                            @error('slug')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                            <div class="form-group mb-1 mt-3">
                                <label for="">Danh mục cha</label>
                                <select id="defaultSelect" class="form-select mt-1" name="parent_id">
                                    <option value="0">Chọn danh mục cha</option>
                                    @foreach ($post_cats as $category)
                                        <option value='{{ $category->id }}'>
                                            {{ str_repeat('---|', $category->level) . $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('parrent_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="form-group mt-3 mt-3">
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
                            <button type="submit" value="add" class="btn btn-primary mt-3">Thêm mới</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-header font-weight-bold">
                        Danh mục bài viết
                    </div>
                    <div class="card-body">
                        <div class="col-12">
                            <table class="table table-striped">
                                <thead>
                                    <tr class="fw-bolder">
                                        <th scope="col">#</th>
                                        <th scope="col">Tên danh mục</th>
                                        <th scope="col">Slug</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Người tạo-Ngày tạo</th>
                                        <th scope="col">Tác vụ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $t = 0;
                                    @endphp
                                    @foreach ($post_cats as $category)
                                        @php
                                            $t++;
                                        @endphp
                                        <tr>
                                            <th scope="row">{{ $t }}</th>
                                            <td><a
                                                    href="{{ route('postcat.edit', $category->id) }}">{{ str_repeat('---|', $category->level) . $category->name }}</a>
                                            </td>
                                            <td>{{ $category->slug }}</td>
                                            @if ($category->status == 1)
                                                <td class="p-2"><span class="badge bg-success">Công khai</span></td>
                                            @else
                                                <td class="p-2"><span class="badge bg-dark">Chờ duyệt</span></td>
                                            @endif

                                            @foreach ($users as $user)
                                                @if ($user->id == $category->user_id)
                                                    <td>{{ $user->name }}<br>{{ $category->created_at }}</td>
                                                @endif
                                            @endforeach

                                            <td>
                                                @canany(['postcat.edit', 'postcat.delete'])
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            @can('postcat.edit')
                                                                <a class="dropdown-item"
                                                                    href="{{ route('postcat.edit', $category->id) }}"><i
                                                                        class="bx bx-edit-alt me-1"></i> Edit</a>
                                                            @endcan
                                                            @can('postcat.edit')
                                                                <a class="dropdown-item"
                                                                    href="{{ route('delete_postcat', $category->id) }}"
                                                                    onclick="return confirm('Bạn chắc chắn muốn xóa bản ghi này?')"><i
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
                </div>
            </div>
        </div>
    </div>
@endsection
