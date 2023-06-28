<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Components\Recusive;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class AdminMenuController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next){
            session(['module_active'=> 'menu']);
            return $next($request);
        });
    }
    function add(){
        $data = Menu::all();

        $recusive = new Recusive($data);
        $users = User::all();
        $menus = $recusive->data_tree();
        // dd($menus);

        return view('admin.menu.add', compact('menus','users'));
    }
    function store(Request $request){
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'link' => 'required|string|max:255',
                'parent_id' => 'required',
            ],
            [
                'required'=> ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min',
                'max' => ':attribute có độ dài tối đa :max',
            ],
            [
                'name'=> 'Tên menu',
                'link'=> 'Tên đường dẫn',
                'parent_id' =>'menu cha'
            ]
        );

        Menu::create([
            'name' => $request->input('name'),
            'link' => $request->input('link'),
            'parent_id' => $request->input('parent_id'),
            'status' => $request->input('status'),
            'user_id' => Auth::id(),
        ]);

        return redirect('admin/menu/add')->with('status', 'Thêm menu mới thành công');
    }

    function delete($id){
        $menu = Menu::find($id);
        $menu -> delete();

        return redirect('admin/menu/add')->with('status', 'Xóa menu thành công');
    }

    function edit($id){
        $data = Menu::all();
        $recusive = new Recusive($data);
        $menus = $recusive->data_tree();
        $menu = Menu::find($id);
        $users = User::all();

        return view('admin.menu.edit', compact('menu','menus','users'));
    }

    function update(Request $request, $id){
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'link' => 'required|string|max:255',
                'parent_id' => 'required',
            ],
            [
                'required'=> ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min',
                'max' => ':attribute có độ dài tối đa :max',
            ],
            [
                'name'=> 'Tên menu',
                'link'=> 'Tên đường dẫn',
                'parent_id' =>'menu cha'
            ]
        );

        Menu::where('id', $id)->update([
            'name' => $request->input('name'),
            'link' => $request->input('link'),
            'parent_id' => $request->input('parent_id'),
            'status' => $request->input('status'),
        ]);

        return redirect('admin/menu/add')->with('status', 'Cập nhật menu thành công');

    }
}
