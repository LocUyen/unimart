@extends('layouts.admin')
@section('content')
<style>
  .pagination{
    margin-top: 15px;
    float: right;
  }
</style>
<div class="container-xxl flex-grow-1 container-p-y" id="content">
    {{-- <div id="content" class="container-fluid"> --}}
        @if (session('status'))
          <div class="alert alert-success alert-dismissible" role="alert">
            {{session('status')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        <div class="card">
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <h5 class="m-0 ">DANH SÁCH KHÁCH HÀNG</h5>
                <div class="form-search me-5">
                    <form action="#" class=" d-flex">
                        <input type="text" name="keyword" value="{{request()->input('keyword')}}" class="form-control form-search  me-1" placeholder="Tìm kiếm">
                        <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                    </form>
                </div>
            </div>
            <div class="card-body">
                <form action="{{url('admin/customer/action')}}" method="">
                  <div class="row">
                    <div class="col-6">
                    </div>
                    <div class="col-6">
                      <p class="float-end">Có {{$customers->total()}} khách hàng</p>
                    </div>
                  </div>
                  <div class="col-12">
                    <table class="table table-striped table-checkall">
                        <thead>
                            <tr class="fw-bolder">
                                <th>
                                    <input type="checkbox" name="checkall">
                                </th>
                                <th scope="col">#</th>
                                <th scope="col">Họ tên</th>
                                <th scope="col">Email</th>
                                <th scope="col">Số điện thoại</th>
                                <th scope="col">Địa chỉ</th>
                                <th scope="col">Ngày tạo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $t=0;
                            @endphp
                            @foreach ($customers as $customer)
                            @php
                                $t++;
                            @endphp
                              <tr>
                                <td>
                                    <input type="checkbox" name="list_check[]" value="{{$customer->id}}">
                                </td>
                                <th scope="row">{{$t}}</th>
                                <td>{{$customer->name}}</td>
                                <td>{{$customer->email}}</td>
                                <td>{{$customer->phone}}</td>
                                <td>{{$customer->address}}</td>
                                <td>{{$customer->created_at}}</td>
                              </tr>
                            @endforeach
                        </tbody>
                    </table>
                  </div>

                </form>
                {{$customers->links()}}

            </div>
        </div>
    {{-- </div> --}}
</div>
@endsection
