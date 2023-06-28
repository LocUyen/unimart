@extends('layouts.admin')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-uppercase">THÊM QUYỀN</h5>
                        <form action="{{ route('permission.store') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label class="pb-1" for="name">Tên quyền</label>
                                <input class="form-control" type="text" name="name" value="{{ old('name') }}"
                                    id="name">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="pb-1" for="slug">Slug</label><br>
                                <small class="form-text text-muted pb-2">Ví dụ: post.add</small>
                                <input class="form-control" type="text" name="slug" id="slug"
                                    value="{{ old('slug') }}">
                                @error('slug')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="pb-1" for="description">Mô tả</label>
                                <textarea class="form-control" type="text" name="description" id="description" value=""> {{ old('description') }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" value="Thêm mới">Thêm mới</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card ">
                    <div class="card-body ">
                        <h5 class="text-uppercase">DANH SÁCH QUYỀN</h5>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên quyền</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Tác vụ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $t = 1;
                                @endphp
                                @foreach ($permissions as $moduleName => $modulePermissions)
                                    <tr>
                                        <td scope="row"></td>
                                        <td><strong>{{ ucfirst($moduleName) }}</strong></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    @foreach ($modulePermissions as $permission)
                                        <tr>
                                            <td scope="row">{{ $t++ }}</td>
                                            <td><a
                                                    href="{{ route('permission.edit', $permission->id) }}">|---{{ $permission->name }}</a>
                                            </td>
                                            <td>{{ $permission->slug }}</td>
                                            <td>
                                                @canany(['permission.edit', 'permission.delete'])
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            @can('permission.edit')
                                                                <a href="{{ route('permission.edit', $permission->id) }}" class="dropdown-item"
                                                                    href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i>
                                                                    Edit</a>
                                                            @endcan
                                                            @can('permission.delete')
                                                                <a href="{{ route('permission.delete', $permission->id) }}"
                                                                    onclick="return confirm('Bạn chắc chắn muốn xóa bản ghi này?')"
                                                                    class="dropdown-item">
                                                                    <i class="bx bx-trash me-1"></i> Delete</a>
                                                            @endcan
                                                        </div>
                                                    </div>
                                                @endcanany


                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
