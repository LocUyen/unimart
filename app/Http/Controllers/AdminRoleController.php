<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Gate;
class AdminRoleController extends Controller
{
    function list()
    {
        session(['module_hover'=> 'role.list']);

        // return Gate::allows('post.add');

        // if(!Gate::allows('role.list')){
        //     return abort(403);
        // }
        $roles = Role::all();
        return view('admin.role.list', compact('roles'));
    }

    function add()
    {
        session(['module_hover'=> 'role.add']);

        // echo "d";
        // if(!Gate::allows('role.add')){
        //     return abort(403);
        // }
        $permissions = Permission::all()->groupBy(function ($permission) {
            return explode('.', $permission->slug)[0];
        });
        // dd($permissions);
        return view('admin.role.add', compact('permissions'));
    }

    function store(Request $request)
    {
        // echo "d";
        // return $request->all();
        $validated = $request->validate(
            [
                'name' => 'required|unique:roles,name',
                'permission_id' => 'nullable|array',
                'permission_id.*' => 'exists:permissions,id',
                'description' => 'required'
            ],
            [
                'required' => ':attribute không được bỏ trống',
            ],
            [
                'name' => 'Tên quyền',
                'description' => 'Mô tả vai trò',
            ]
        );

        $role = Role::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        $role->permissions()->attach($request->input('permission_id'));

        return redirect()->route('role.list')->with('status', 'Thêm vai trò thành công');
    }

    function edit(Role $role)
    {
        // return $role;
        $permissions = Permission::all()->groupBy(function ($permission) {
            return explode('.', $permission->slug)[0];
        });
        return view('admin.role.edit', compact('permissions', 'role'));
    }
    function update(Request $request, Role $role)
    {
        // echo "D";
        $request->validate(
            [
                'name' => 'required|unique:roles,name,'.$role->id,
                'permission_id' => 'nullable|array',
                'permission_id.*' => 'exists:permissions,id',
            ],
            [
                'name' => 'Tên quyền',
                'description' => 'Mô tả vai trò',
            ]
        );
        // dd($request->all());
        $role->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);
        $role->permissions()->sync($request->input('permission_id', [] ));

        return redirect()->route('role.list')->with('status', 'Cập nhật vai trò thành công');
    }

    function delete(Role $role){

        $role->delete();
        return redirect()->route('role.list')->with('status', 'Xóa vai trò thành công');
    }
}
