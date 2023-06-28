<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use App\Models\Permission;
class AdminPermissionController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next){
            session(['module_active'=> 'permission']);
            return $next($request);
        });
    }
    function add(){
        session(['module_hover'=> 'permission.add']);

        $permissions = Permission::all()->groupBy(function($permission){
            return explode('.', $permission->slug)[0];
        });

        // dd($permissions);

        return view('admin.permission.add', compact('permissions'));
    }
    function store(Request $request){
        // return $request->all();
        $validated = $request->validate(
            [
                'name' => 'required||max:255',
                'slug' => 'required'
            ],
            [
                'required'=> ':attribute không được bỏ trống',
            ],
            [
                'name'=> 'Tên quyền',
                'slug'=> 'Slug',
            ]
        );
        // return $request->all();
        Permission::create([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'description' => $request->input('description'),
        ]);
        return redirect() -> route('permission.add') -> with('status','Đã thêm quyền thành công');
    }

    function edit($id){
        $permissions = Permission::all()->groupBy(function($permission){
            return explode('.', $permission->slug)[0];
        });

        $permission = Permission::find($id);
        // dd($permission);
        return view('admin.permission.edit', compact('permission','permissions'));
    }
    function update(Request $request, $id){
        // return $request->all();
        $validated = $request->validate(
            [
                'name' => 'required||max:255',
                'slug' => 'required'
            ],
            [
                'required'=> ':attribute không được bỏ trống',
            ],
            [
                'name'=> 'Tên quyền',
                'slug'=> 'Slug',
            ]
        );
        // return $request->all();
        Permission::where('id',$id)->update([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'description' => $request->input('description')
        ]);
        return redirect() -> route('permission.add') -> with('status','Đã cập nhật quyền thành công');
    }

    function delete($id){
        Permission::where('id',$id)->delete();
        return redirect() -> route('permission.add') -> with('status','Đã xóa quyền thành công');
    }

}
