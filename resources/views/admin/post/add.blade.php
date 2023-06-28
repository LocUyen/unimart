@extends('layouts.admin')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.tiny.cloud/1/j640rv83z3f94of43yb3h0ppa7hwklah74vzmm233mrve2gx/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
@endsection
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

                <h5 class="card-header">THÊM BÀI VIẾT</h5>
                <div class="card-body">
                    <form action="{{ url('admin/post/store') }}" method="POST" enctype="multipart/form-data"
                        files='true'>
                        @csrf

                        <div class="form-group mb-3">
                            <label for="title">Tiêu đề bài viết<span class="text-danger">*</span></label>
                            <input class="form-control mt-1" type="text" name="title" id="name"
                                onkeyup="ChangeToSlug();">
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="name">Slug <span class="text-danger">*</span></label>
                            <input class="form-control mt-1" type="text" name="slug" id="slug"
                                value="{{ old('slug') }}">
                        </div>
                        @error('slug')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                        <div class="form-group mt-3">
                            <div class="col-12"><label for="intro">Hình ảnh đại diện <span
                                        class="text-danger">*</span></label></div>
                            <input type='file' name="thumbnail" class="form-control-file mt-1" id="formFileMultiple">
                        </div>
                        @error('thumbnail')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                        <div class="form-group mt-3">
                            <label for="intro">Mô tả ngắn<span class="text-danger">*</span></label>
                            <textarea name="desc" class="form-control mt-1 tinymce" id="intro" cols="30" rows="5">{{ old('desc') }}</textarea>
                        </div>
                        @error('desc')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                        <div class="form-group mt-3">
                            <label for="intro">Nội dung bài viết <span class="text-danger">*</span></label>
                            <textarea name="content" class="form-control mt-1 tinymce" id="intro" cols="30" rows="20">{{ old('content') }}</textarea>
                        </div>
                        @error('content')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                        <div class="form-group mb-3 mt-3">
                            <label for="">Danh mục<span class="text-danger">*</span></label>
                            <select id="parrent_id" name="category_id" class="form-select mt-1 parent-select-choose">
                                <option value="0">Chọn danh mục cha</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ str_repeat('--|', $category->level) . $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('category_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                        <div class="form-group mb-3">
                            <label for="">Trạng thái</label>
                            <div class="form-check mt-1">
                                <input class="form-check-input" name="status" type="radio" name="exampleRadios"
                                    id="exampleRadios1" value="0">
                                <label class="form-check-label" for="exampleRadios1">
                                    Chờ duyệt
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="status" type="radio" name="exampleRadios"
                                    id="exampleRadios2" value="1" checked>
                                <label class="form-check-label" for="exampleRadios2">
                                    Công khai
                                </label>
                            </div>
                        </div>

                        <button type="submit" name="btn-add" value="Thêm mới" class="btn btn-primary mt-3">Thêm
                            mới</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js-addform')
    <script src="{{ asset('js/admin/product/addform.js') }}"></script>
@endsection
