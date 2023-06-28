@extends('layouts.admin')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y" id="content">
        {{-- <div id="content" class="container-fluid"> --}}
        <div class="card">
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <div class="d-flex">
                    <h5 class="">DANH SÁCH BÀI VIẾT</h5>
                    @if (auth()->user()->can('Bài viết | Thêm'))
                        <button class="btn btn-primary m-1 ms-3"><a href="{{ url('admin/post/add') }}">Thêm mới</a></button>
                    @endif
                </div>
                <div class="form-search me-5">
                    <form action="#" class=" d-flex">
                        <input type="" name="keyword" class="form-control form-search me-1" placeholder="Tìm kiếm"
                            value="{{ request()->input('keyword') }}">
                        <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="analytic">
                    <a class="text-primary" href="{{ request()->fullUrlWithQuery(['status' => 'active']) }}">Kích hoạt<span
                            class="text-primary text-muted">({{ $count[0] }})</span></a>
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'trash']) }}" class=" mx-1">Vô hiệu hóa<span
                            class="text-muted">({{ $count[1] }})</span></a>
                </div>
                <form action="{{ url('admin/product/action') }}" method="">
                    <div class="form-action form-inline py-3 col-3 ">
                        <div class="form-action form-inline py-3 d-flex">
                            <select name="act" class="form-select placement-dropdown me-1" id="selectPlacement">
                                <option>Chọn</option>
                                @foreach ($list_act as $k => $value)
                                    <option value="{{ $k }}">{{ $value }}</option>
                                @endforeach
                            </select>
                            <input type="submit" name="btn_action" value="Áp dụng" class="btn btn-primary">
                        </div>
                    </div>
                    <table class="table table-striped table-checkall">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" name="checkall">
                                </th>
                                <th scope="col">#</th>
                                <th scope="col">Ảnh</th>
                                <th scope="col">Tiêu đề</th>
                                <th scope="col">Danh mục</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Người tạo-Ngày tạo</th>
                                <th scope="col" class="w-2">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $t = 0;
                            @endphp
                            @foreach ($posts as $post)
                                @php
                                    $t++;
                                @endphp
                                <tr>
                                    <td>
                                        <input type="checkbox" name="list_check" value="{{ $post->id }}">
                                    </td>
                                    <th scope="row">{{ $t }}</th>
                                    <td><img src="{{ url($post->thumbnail) }}" class="image_150_100" alt=""></td>
                                    <td><a href="{{ route('post.edit', $post->id) }}">{{ $post->title }}</a></td>
                                    <td>{{ $post->post_cat->name }}</td>
                                    @if ($post->status == 1)
                                        <td><span class="badge bg-success">Công khai</span></td>
                                    @else
                                        <td><span class="badge bg-dark">Chờ duyệt</span></span></td>
                                    @endif
                                    @foreach ($users as $user)
                                        @if ($user->id == $post->user_id)
                                            <td>{{ $user->name }}<br>{{ $post->created_at }}</td>
                                        @endif
                                    @endforeach
                                    <td>
                                        @canany(['post.edit', 'post.delete'])
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    @can('post.edit')
                                                        <a class="dropdown-item" href="{{ route('post.edit', $post->id) }}"><i
                                                                class="bx bx-edit-alt me-1"></i>
                                                            Edit
                                                        </a>
                                                    @endcan
                                                    @can('post.delete')
                                                        <a class="dropdown-item" href="{{ route('delete_post', $post->id) }}"><i
                                                                class="bx bx-trash me-1"
                                                                onclick="return confirm('Bạn chắc chắn muốn xóa bản ghi này?')"></i>
                                                            Delete
                                                        </a>
                                                    @endcan

                                                </div>
                                            </div>
                                        @endcanany

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </form>
                {{ $posts->links() }}
            </div>
        </div>
        {{-- </div> --}}
    </div>
@endsection
