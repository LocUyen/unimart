@extends('layouts.admin')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="col-xxl">
            <div class="card mb-4">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <h5 class="card-header">THÊM THÀNH VIÊN</h5>
                <div class="card-body">
                    <form action="{{ url('admin/user/store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Họ và tên</label>
                            <input class="form-control mt-1" type="text" name="name" id="name">
                        </div>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                        <div class="form-group mt-3">
                            <label for="email">Email</label>
                            <input class="form-control mt-1" type="text" name="email" id="email"
                                value="email@gmail.com">
                        </div>
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                        <div class="form-group mt-3">
                            <label for="password">Mật khẩu</label>
                            <input class="form-control mt-1" type="password" name="password" id="password">
                        </div>
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                        <div class="form-group mt-3">
                            <label for="password-confirm">Xác nhận mật khẩu</label>
                            <input class="form-control mt-1" type="password" name="password_confirmation"
                                id="password-confirm">
                        </div>
                        @error('password_confirm')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                        <div class="form-group mt-3">
                            <label for="">Nhóm quyền</label>
                            <select id="" class="form-select mt-1" name="roles[]" multiple="" required>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" >{{ $role->name }}
                                    </option>
                                @endforeach
                            </select>

                        </div>

                        <button type="submit" name="btn-add" value="Thêm mới" class="btn btn-primary mt-3">Thêm
                            mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
