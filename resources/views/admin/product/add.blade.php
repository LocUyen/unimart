@extends('layouts.admin')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.tiny.cloud/1/wy9enqw2oodlgakk1121ufodunrohc6o5s661hyzhohaz9en/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdn.tiny.cloud/1/j640rv83z3f94of43yb3h0ppa7hwklah74vzmm233mrve2gx/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="col-xxl">
    <div class="card mb-4">
      @if (session('status'))
        <div class="alert alert-success alert-dismissible" role="alert">
          {{session('status')}}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      <h5 class="card-header">THÊM SẢN PHẨM</h5>
      <div class="card-body">
        <form action="{{url('admin/product/store')}}" method="POST" enctype="multipart/form-data" files = 'true' >
            @csrf

            <div class="row">
              <div class="col-6">
                  <div class="form-group mt-3">
                      <label for="name">Tên sản phẩm <span class="text-danger">*</span></label>
                      <input class="form-control mt-1" type="text" name="name" id="name" onkeyup="ChangeToSlug();" value="{{old('name')}}">
                  </div>
                  @error('name')
                    <small class="text-danger">{{$message}}</small>
                  @enderror
                  <div class="form-group mt-3">
                      <label for="name">Slug <span class="text-danger">*</span></label>
                      <input class="form-control mt-1" type="text" name="slug" id="slug" value="{{old('slug')}}">
                  </div>
                  @error('slug')
                    <small class="text-danger">{{$message}}</small>
                  @enderror
              </div>
              <div class="col-6">
                <div class="form-group mt-3">
                    <label for="name">Giá <span class="text-danger">*</span></label>
                    <input class="form-control mt-1" type="text" name="price" id="price" value="{{old('price')}}">
                </div>
                @error('price')
                    <small class="text-danger">{{$message}}</small>
                @enderror
                <div class="form-group mt-3">
                    <label for="name">Giá giảm<span class="text-danger">*</span></label></label>
                    <input class="form-control mt-1" type="text" name="discount" id="discount" value="{{old('discount')}}">
                </div>
                @error('discount')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
          </div>

          <div class="form-group mt-3">
            <label for="">Danh mục cha <span class="text-danger">*</span></label>
            <select id="parrent_id" name="category_id" class="form-select mt-1 parent-select-choose" >
                <option value="0">Chọn danh mục cha</option>
                @foreach ($categories as $category)
                  <option value="{{$category->id}}">{{str_repeat('--|', $category->level).$category->name}}</option>
                @endforeach

            </select>
            @error('category_id')
                <small class="text-danger">{{$message}}</small>
            @enderror
          </div>

          <div class="form-group mt-3">
            <label for="">Tag <span class="text-danger">*</span></label>
            <select name="tags[]" class="form-select tag-select-choose" multiple="multiple" >

            </select>
            @error('tags')
                <small class="text-danger">{{$message}}</small>
            @enderror
          </div>

          <div class="form-group mt-3">
            <div class="col-12"><label for="intro">Hình ảnh đại diện <span class="text-danger">*</span></label></div>
            <input type='file' name="feature_image_path" class="form-control-file mt-1" id="formFileMultiple">
          </div>
          @error('feature_image_path')
              <small class="text-danger">{{$message}}</small>
          @enderror

          <div class="form-group mt-3">
            <div class="col-12"><label for="intro">Chi tiết hình ảnh</label></div>
            <input type='file' multiple="multiple" name="image_path[]" class="form-control-file mt-1" id="formFileMultiple">
          </div>

          <div class="form-group mt-3">
              <label for="intro">Chi tiết sản phẩm <span class="text-danger">*</span></label>
              <textarea name="content" class="form-control mt-1 tinymce" id="intro" cols="30" rows="25">{{old('content')}}</textarea>
          </div>
          @error('content')
              <small class="text-danger">{{$message}}</small>
          @enderror

          <div class="form-group mt-3 mt-3">
            <label for="">Trạng thái</label>
            <div class="form-check mt-1">
                <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="1" >
                <label class="form-check-label" for="exampleRadios1">
                    Công khai
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="0" checked>
                <label class="form-check-label" for="exampleRadios2">
                    Chờ duyệt
                </label>
            </div>
          </div>
          <button type="submit" value="btn-add" class="btn btn-primary mt-2">Thêm mới</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
@section('js-addform')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{asset('js/admin/product/addform.js')}}"></script>

@endsection

