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
                    <h5 class="m-0 ">SỬA SLIDER</h5>
                </div>
                <form action="{{ route('slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data"
                        files='true'>
                    @csrf
                    <div class="row">
                        <div class="form-group mb-1 mt-3 col-6">
                            <label for="name">Tiêu đề <span class="text-danger">*</span></label>
                            <input class="form-control mt-1" type="text" name="title" id="name" value="{{$slider->title}}">
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-1 mt-3 col-6">
                            <label for="name">Link <span class="text-danger">*</span></label>
                            <input class="form-control mt-1" type="text" name="link" id="link" value="{{$slider->link}}">
                            @error('link')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>

                    <div class="form-group mb-1 mt-3 col-12">
                        <label for="name">Mô tả <span class="text-danger">*</span></label>
                        <input class="form-control mt-1" type="text" name="desc" id="desc" value="{{$slider->desc}}">
                        @error('desc')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="form-group mt-3 col-6">
                            <div class="col-12"><label for="intro">Ảnh <span class="text-danger">*</span></label></div>
                            <input type='file' name="thumbnail" class="form-control-file mt-1" id="formFileMultiple"><br>
                            @error('thumbnail')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mt-3 mt-3 col-2">
                            <label for="">Trạng thái</label>
                            <div class="form-check mt-1">
                                <input class="form-check-input" type="radio" name="status" id="exampleRadios1"
                                    value="1" @if ($slider->status == '1') checked @endif>
                                <label class="form-check-label" for="exampleRadios1">
                                    Công khai
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="exampleRadios2"
                                    value="0" @if ($slider->status == '0') checked @endif>
                                <label class="form-check-label" for="exampleRadios2">
                                    Chờ duyệt
                                </label>
                            </div>
                        </div>
                        <div class="col-2 pt-4">
                            <button type="submit" value="update" class="btn btn-primary mt-3">Cập nhật</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <h5 class="m-0 ">DANH SÁCH SLIDER</h5>
            </div>
            <div class="card-body">
                <div class="row">
                </div>
                <table class="table table-striped table-checkall">
                    <thead>
                        <tr class="fw-bolder">

                            <th scope="col">#</th>
                            <th scope="col" class="mx-2">Ảnh</th>
                            <th scope="col" class="mx-2">Tên slider</th>
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
                        @foreach ($sliders as $slider)
                            @php
                                $t++;
                            @endphp
                            <tr>
                                <th scope="row">{{ $t }}</th>
                                <td><a href="{{route('slider.edit', $slider->id)}}">
                                    <img src="{{ url($slider->thumbnail) }}" class="slider_image" alt="">
                                </a></td>
                                <td><a href="{{route('slider.edit', $slider->id)}}">{{ $slider->title }}</a></td>
                                <td>{{ $slider->link }}</td>
                                @if ($slider->status == 1)
                                    <td><span class="badge bg-success">Công khai</span></td>
                                @else
                                    <td><span class="badge bg-dark">Chờ duyệt</span></td>
                                @endif
                                @foreach ($users as $user)
                                    @if ($user->id == $slider->user_id)
                                        <td>{{ $user->name }}</td>
                                    @endif
                                @endforeach
                                <td>{{ $slider->created_at }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{route('slider.edit', $slider->id)}}"><i class="bx bx-edit-alt me-1"></i>
                                                Sửa</a>
                                            <a class="dropdown-item" href="{{route('delete_slider', $slider->id)}}"><i class="bx bx-trash me-1" onclick="return confirm('Bạn chắc chắn muốn xóa bản ghi này?')"></i>
                                                Xóa</a>
                                        </div>
                                    </div>
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
