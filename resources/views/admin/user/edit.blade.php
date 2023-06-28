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

                <h5 class="card-header">CHỈNH SỬA NGƯỜI DÙNG</h5>
                <div class="card-body">
                    <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Họ và tên</label>
                            <input class="form-control mt-1" type="text" name="name" id="name"
                                value="{{ $user->name }}">
                        </div>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                        <div class="form-group mt-3">
                            <label for="email">Email</label>
                            <input class="form-control mt-1" type="text" name="email" id="email"
                                value="{{ $user->email }}" disabled>
                        </div>
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                        {{-- <div class="form-group mt-3">
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
                        @enderror --}}

                        <div class="form-group mt-3">
                            <label for="">Nhóm quyền</label>
                            @php
                                $selectRoles = $user->roles->pluck('id')->toArray();
                                $options = $roles->pluck('name','id')->toArray();

                            @endphp
                            {{-- {{Form::select('roles[]', $options, $selectRoles, ['id'=>'roles','class'=> 'form-control', 'mutiple'=> true])}} --}}
                            <select class="form-control mt-3" multiple="multiple" name="roles[]" id="roles">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}"
                                        @if (in_array($role->id, $user->roles->pluck('id')->toArray()))
                                            @selected(true)
                                         @endif
                                        >
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>

                        </div>

                        <button type="submit" name="btn-update" value="Cập nhật" class="btn btn-primary mt-3">Cập
                            nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
