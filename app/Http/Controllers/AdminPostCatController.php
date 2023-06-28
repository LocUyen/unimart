<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostCat;
use App\Components\Recusive;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminPostCatController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next){
            session(['module_active'=> 'post']);
            return $next($request);
        });
    }

    function add(){
        session(['module_hover'=> 'postcat.add']);

        $data = PostCat::all();

        $recusive = new Recusive($data);
        $users = User::all();
        $post_cats = $recusive->data_tree();
        // dd($post_cats);

        return view('admin.post.cat.add', compact('post_cats','users'));
    }

    function store(Request $request){
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'slug' => 'required|string|max:255',
                'parent_id' => 'required',
            ],
            [
                'required'=> ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min',
                'max' => ':attribute có độ dài tối đa :max',
            ],
            [
                'name'=> 'Tên danh mục',
                'slug'=> 'Tên đường dẫn SEO',
                'parent_id' =>'Danh mục cha'
            ]
        );

        PostCat::create([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'parent_id' => $request->input('parent_id'),
            'status' => $request->input('status'),
            'user_id' => Auth::id(),
        ]);
        return redirect('admin/post/cat/add')->with('status', 'Thêm danh mục mới thành công');

    }

    function delete($id){
        $category = PostCat::find($id);
        $category -> delete();

        return redirect('admin/post/cat/add')->with('status', 'Xóa danh mục thành công');
    }

    function edit($id){
        $data = PostCat::all();
        $recusive = new Recusive($data);
        $post_cats = $recusive->data_tree();
        $category = PostCat::find($id);
        $users = User::all();

        return view('admin.post.cat.edit', compact('category','post_cats','users'));
    }

    function update(Request $request, $id){
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'slug' => 'required|string|max:255',
                'parent_id' => 'required',
            ],
            [
                'required'=> ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min',
                'max' => ':attribute có độ dài tối đa :max',
            ],
            [
                'name'=> 'Tên danh mục',
                'slug'=> 'Tên đường dẫn SEO',
                'parent_id' =>'Danh mục cha'
            ]
        );

        PostCat::where('id', $id)->update([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'parent_id' => $request->input('parent_id'),
            'status' => $request->input('status'),
        ]);

        return redirect('admin/post/cat/add')->with('status', 'Cập nhật danh mục thành công');

    }
}
