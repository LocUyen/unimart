<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\App;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Components\Recusive;

class AdminCategoriesController extends Controller
{
    private $category;
    public function __construct(Category $category){
        $this->category = $category;

        $this->middleware(function ($request, $next){
            session([
                'module_active'=>'product',
            ]);
            return $next($request);
        });
    }

    function add(){
        session([
            'module_hover'=>'productcat.add',
        ]);

        $data = $this->category->all();

        $recusive = new Recusive($data);
        $categories = $recusive->data_tree();

        $users = User::all();
        return view('admin.product.cat.add', compact('categories','users'));
    }

    function store(Request $request){
        // return $request->all();
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

        $this->category->create([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'user_id' => Auth::id(),
            'parent_id' => $request->input('parent_id'),
            'status' => $request->input('status'),
        ]);

        return redirect('admin/product/cat/add')->with('status', 'Thêm danh mục mới thành công');
    }

    function delete($id){
        $category = $this->category->find($id);
        $category -> delete();

        return redirect('admin/product/cat/add')->with('status', 'Xóa danh mục thành công');
    }

    function edit($id){
        $data = $this->category->all();

        $recusive = new Recusive($data);
        $categories = $recusive->data_tree();

        $category = $this->category->find($id);
        $users = User::all();

        return view('admin.product.cat.edit', compact('category','categories','users'));
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

        $this->category->where('id', $id)->update([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'user_id' => Auth::id(),
            'parent_id' => $request->input('parent_id'),
            'status' => $request->input('status'),

        ]);

        return redirect('admin/product/cat/add')->with('status', 'Cập nhật danh mục thành công');

    }
}
