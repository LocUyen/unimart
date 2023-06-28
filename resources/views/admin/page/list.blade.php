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
        <div class="card mt-3">
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <h5 class="m-0 ">DANH SÁCH TRANG</h5>
            </div>
            <div class="card-body">
                <div class="row">
                </div>
                <table class="table table-striped table-checkall">
                    <thead>
                        <tr class="fw-bolder">

                            <th scope="col">#</th>
                            <th scope="col">Tiêu đề</th>
                            <th class="w-25" scope="col">Link</th>
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
                        @foreach ($pages as $page)
                            @php
                                $t++;
                            @endphp
                            <tr>
                                <th scope="row">{{ $t }}</th>
                                <td><a href="{{ route('page.edit', $page->id) }}">{{ $page->title }}</a></td>

                                <td>{{ $page->link }}</td>
                                @if ($page->status == 1)
                                    <td><span class="badge bg-success">Công khai</span></td>
                                @else
                                    <td><span class="badge bg-dark">Chờ duyệt</span></td>
                                @endif
                                @foreach ($users as $user)
                                    @if ($user->id == $page->user_id)
                                        <td>{{ $user->name }}</td>
                                    @endif
                                @endforeach
                                <td>{{ $page->created_at }}</td>
                                <td>
                                    @canany(['page.delete', 'page.edit'])
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                @can('page.edit')
                                                    <a href="{{ route('page.edit', $page->id) }}" class="dropdown-item"
                                                        href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i>
                                                        Edit
                                                    </a>
                                                @endcan
                                                @can('page.delete')
                                                    <a href="{{ route('delete_page', $page->id) }}"
                                                        onclick="return confirm('Bạn chắc chắn muốn xóa bản ghi này?')"
                                                        class="dropdown-item"><i
                                                            class="bx bx-trash me-1"></i>
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
            </div>
        </div>
        {{-- </div> --}}
    </div>
@endsection
