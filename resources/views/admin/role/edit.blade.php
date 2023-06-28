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
                <h5 class="card-header">CHỈNH SỬA VAI TRÒ</h5>
                <div class="card-body">
                    <form method="POST" action="{{route('role.update', $role->id)}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="text-strong pb-1" for="name">Tên vai trò</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{$role->name}}">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="text-strong pb-1" for="description">Mô tả</label>
                            <textarea class="form-control" type="text" name="description" id="description">{{$role->description}}</textarea>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mt-5">
                            <strong class="mt-2">Vai trò này có quyền gì?</strong><br>
                            <small class="form-text text-muted">Check vào module hoặc các hành động bên dưới để chọn quyền.</small>
                        </div>
                        <!-- List Permission  -->
                        @foreach ($permissions as $moduleName => $modulePermissions)
                        <div class="card my-4 border">
                            <div class="card-header bg-light">
                                <input type="checkbox" class="check-all form-check-input me-1" name="" id="{{ $moduleName }}">
                                <label for="{{ $moduleName }}" class="m-0 text-uppercase">Module {{ ucfirst($moduleName) }}</label>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($modulePermissions as $permission)
                                    <div class="col-md-3">
                                        <input type="checkbox" class="permission form-check-input me-1" value="{{$permission->id}}"
                                         name="permission_id[]" id="{{$permission->slug}}"
                                         @if (in_array($permission->id, $role->permissions->pluck('id')->toArray()))
                                            @checked(true)
                                         @endif
                                         >
                                        <label for="{{$permission->slug}}">{{$permission->name}}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                        @endforeach
                        <input type="submit" name="btn-update" class="btn btn-primary" value="Cập nhật">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.check-all').click(function () {
          $(this).closest('.card').find('.permission').prop('checked', this.checked)
        })
    </script>
@endsection

