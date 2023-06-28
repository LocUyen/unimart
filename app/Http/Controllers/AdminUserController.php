<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next){
            session([
                'module_active'=>'user',
            ]);
            return $next($request);
        });
    }



    function add(){
        session([
            'module_hover'=>'user.add',
        ]);
        $roles = Role::all();

        return view('admin.user.add', compact('roles'));
    }

    //nơi xử lý dữ liệu form
    function store(Request $request){
        // if($request->input('btn-add')){
        //     return $request->input();
        // }
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ],
            [
                'required'=> ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min',
                'max' => ':attribute có độ dài tối đa :max',
                'confirmed'=> 'Xác nhận mật khẩu ko chính xác',
            ],
            [
                'name'=> 'Tên người dùng',
                'email'=> 'Email',
                'password' =>'Mật khẩu',
            ]
        );

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),

        ]);
        $user->roles()->attach($request->input('roles'));

        return redirect('admin/user/add')->with('status', 'Thêm thành viên thành công');
    }


    function edit($id){
        $user = User::find($id);
        $roles = Role::all();
        return view('admin.user.edit', compact('user','roles'));
    }

    function update(Request $request, $id){
        $user = User::find($id);

        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'unique:users,email,'.$user->id,
                // 'password' => 'required|string|min:8|confirmed',
            ],
            [
                'required'=> ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min',
                'max' => ':attribute có độ dài tối đa :max',
                'confirmed'=> 'Xác nhận mật khẩu ko chính xác',
            ],
            [
                'name'=> 'Tên người dùng',
                'password' =>'Mật khẩu'
            ]
        );

        User::where('id', $id)->update([
            'name' => $request->input('name'),
            // 'password' => Hash::make($request->input('password')),
        ]);

        $user->roles()->sync($request->input('roles'));

        return redirect('admin/user/list')->with('status', 'Đã cập nhật thành công');
    }
    function list(Request $request){
        session([
            'module_hover'=>'user.list',
        ]);
        // if(Auth::user()->hasPermission('product.add')){
        //     return dd('Đc phép truy cập');
        // } else{
        //     return dd('Ko đc phép truy cập');
        // }

        $status = $request->input('status');

        $list_act = [
            'delete' => 'Xóa tạm thời'
        ];

        if($status == 'trash'){
            $list_act = [
                'restore' => 'Kích hoạt',
                'forceDelete' => 'Xóa vĩnh viễn'
            ];
            $users = User::onlyTrashed()->paginate(10);
        } else {
            $keyword = "";
            if($request->input('keyword')){
                $keyword = $request->input('keyword');
            }

            $users = User::where('name','LIKE',"%{$keyword}%")->paginate(10);
        }

        $count_user_active = User::count();
        $count_user_trash = User::onlyTrashed()->count();

        $count = [$count_user_active, $count_user_trash];


        return view('admin.user.list', compact('users','count','list_act','status'));
    }
    function delete($id){
        if(Auth::id() != $id){
            $user = User::find($id);
            $user -> delete();

            return redirect('admin/user/list')->with('status', 'Xóa thành viên thành công');

        } else {
            return redirect('admin/user/list')->with('status', 'Bạn không thể tự xóa tài khoản của mình!!');
        }
    }

    function action(Request $request){

        $list_check = $request->input('list_check');

        if($list_check){
            foreach($list_check as $key=>$id){
                if(Auth::id() == $id){
                    unset($list_check[$key]);
                }
            }

            if(!empty($list_check)){
                $act = $request->input('act');

                if($act == 'delete'){
                    User::destroy($list_check);
                    return redirect('admin/user/list')->with('status', 'Bạn đã xóa thành viên thành công');
                }

                if($act == 'restore'){
                    User::withTrashed()
                    ->whereIn('id', $list_check)
                    ->restore();
                    return redirect('admin/user/list')->with('status', 'Bạn đã khôi phục thành viên thành công');
                }

                if($act == 'forceDelete'){
                    User::onlyTrashed()
                    ->whereIn('id', $list_check)
                    ->forceDelete();
                    return redirect('admin/user/list')->with('status', 'Bạn đã xóa vĩnh viễn thành viên');
                }


            }
        }else {
            return redirect('admin/user/list')->with('status', 'Bạn không đủ quyền để thực hiện hành động này');
        }
    }


}
