<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPageController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next){
            session(['module_active'=> 'page']);
            return $next($request);
        });
    }

    function list(){
        session(['module_hover'=> 'page.list']);

        $pages = Page::all();

        $users = User::all();

        return view('admin.page.list', compact('pages','users'));
    }

    function add(){
        session(['module_hover'=> 'page.add']);

        return view('admin.page.add');
    }
    function store(Request $request){
        $request->validate(
            [
                'title' => 'required|string|max:255',
                'link' => 'required|string|max:255',
                'desc' => 'required',
            ],
            [
                'required'=> ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min',
                'max' => ':attribute có độ dài tối đa :max',
            ],
            [
                'title'=> 'Tên trang',
                'link'=> 'Tên đường dẫn',
                'desc' =>'Nội dung'
            ]
        );

        Page::create([
            'title' => $request->input('title'),
            'link' => $request->input('link'),
            'desc' => $request->input('desc'),
            'status' => $request->input('status'),
            'user_id' => Auth::id(),
        ]);

        return redirect('admin/page/list')->with('status', 'Thêm trang mới thành công');
    }

    function delete($id){
        $page = Page::find($id);
        $page -> delete();

        return redirect('admin/page/list')->with('status', 'Xóa trang thành công');
    }

    function edit($id){

        $page = Page::find($id);

        $users = User::all();

        return view('admin.page.edit', compact('page','users'));
    }

    function update(Request $request, $id){
        $request->validate(
            [
                'title' => 'required|string|max:255',
                // 'link' => 'required|string|max:255',
                'desc' => 'required',
            ],
            [
                'required'=> ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min',
                'max' => ':attribute có độ dài tối đa :max',
            ],
            [
                'title'=> 'Tên trang',
                // 'link'=> 'Tên đường dẫn',
                'desc' =>'Nội dung'
            ]
        );

        Page::where('id',$id)->update([
            'title' => $request->input('title'),
            // 'link' => $request->input('link'),
            'desc' => $request->input('desc'),
            'status' => $request->input('status'),
            'user_id' => Auth::id(),
        ]);

        return redirect('admin/page/list')->with('status', 'Cập nhật page thành công');

    }
}
