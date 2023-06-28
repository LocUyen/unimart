<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Components\Recusive;
use App\Models\Category;
use App\Models\PostCat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminPostController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next){
            session(['module_active'=> 'post']);
            return $next($request);
        });
    }
    function add(Request $request){
        session(['module_hover'=> 'post.add']);

        // if($request->input('btn-add')){
        //     return $request->input();
        // }

        $data = PostCat::all();

        $recusive = new Recusive($data);

        $categories = $recusive->data_tree();
        return view('admin.post.add', compact('categories'));
    }

    function store(Request $request)
    {

        $request->validate(
            [
                'title' => 'required|string|max:255',
                'slug' => 'required',
                'thumbnail' => 'required',
                'desc' => 'required',
                'content' => 'required',
                'category_id' => 'required',
            ],
            [
                'required'=> ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min',
                'max' => ':attribute có độ dài tối đa :max',
            ],
            [
                'title' => 'Tiêu đề bài viết',
                'slug' => 'Link SEO',
                'thumbnail' => 'Hình ảnh',
                'desc' => 'Mô tả ngắn',
                'content' => 'Nội dung',
                'category_id' => 'Danh mục cha',
            ]
        );

        try {
            DB::beginTransaction();

            if ($request->hasFile('thumbnail')) {
                $file = $request->thumbnail;
                $filename = $file->getClientOriginalName();
                $path = $file->move('public/uploads/post', $filename);

                $thumbnail = 'public/uploads/post/'.$filename;

            }
            //insert posts
            $post = Post::create([
                'title' => $request->input('title'),
                'slug' => $request->input('slug'),
                'thumbnail' => $thumbnail,
                'desc' => $request->input('desc'),
                'content' => $request->input('content'),
                'user_id' => Auth::id(),
                'postcat_id' => $request->input('category_id'),
                'status' => $request->input('status'),
            ]);
            DB::commit();
                return redirect('admin/post/add')->with('status', 'Thêm bài viết thành công');

        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("Thông báo:" . $exception->getMessage().'Line'.$exception->getLine());
        }

    }

    function list( Request $request){
        session(['module_hover'=> 'post.list']);

        $status = $request->input('status');
        $list_act = [
            'delete' => 'Xóa tạm thời'
        ];

        if($status == 'trash'){
            $list_act = [
                'restore' => 'Khôi phục',
                'forceDelete' => 'Xóa vĩnh viễn',
            ];
            $posts = Post::onlyTrashed()->paginate(20);

        } else {
            $keyword = "";
            if($request->input('keyword')){
                $keyword = $request->input('keyword');
            }

            $posts = Post::latest()->where('title','LIKE',"%{$keyword}%")->paginate();
            // dd($posts);
        }
        $users = User::all();
        $count_user_active = Post::count();
        $count_user_trash = Post::onlyTrashed()->count();
        $count = [$count_user_active,$count_user_trash];
        // dd($posts);

        return view('admin.post.list', compact('posts','users','count','list_act'));
    }

    function delete($id){
        $post = Post::find($id);
        $post -> delete();

        return redirect('admin/post/list')->with('status', 'Xóa bài viết thành công');
    }

    function action(Request $request){
        $list_check = $request->input('list_check');
        // dd($list_check);
        if($list_check){
            $act = $request->input('act');
            if( $act == 'delete'){
                Post::destroy($list_check);
                return redirect('admin/post/list')->with('status', 'Bạn đã xóa bài viết thành công');
            }
            if( $act == 'restore'){
                Post::withTrashed()
                ->whereIn('id',$list_check)
                ->restore();
                return redirect('admin/post/list')->with('status', 'Bạn đã khôi phục bài viết thành công');
            }
            if($act == 'forceDelete'){
                Post::onlyTrashed()
                ->whereIn('id', $list_check)
                ->forceDelete();
                return redirect('admin/post/list')->with('status', 'Bạn đã xóa vĩnh viễn bài viết');
            }
        }


    }
    function edit($id){
        $post = Post::find($id);
        $data = PostCat::all();

        $recusive = new Recusive($data);

        $categories = $recusive->data_tree();
        // $feature_image_path = $post->feature_image_path;
        // dd($feature_image_path);
        return view('admin.post.edit', compact('post','categories'));
    }

    function update(Request $request, $id)
    {
        // if($request->input('btn-add')){

        // }
        // return $request->input();
            // return Auth::id();
        $request->validate(
            [
                'title' => 'required|string|max:255',
                'slug' => 'required',
                'thumbnail' => 'required',
                'desc' => 'required',
                'content' => 'required',
                'category_id' => 'required',
            ],
            [
                'required'=> ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min',
                'max' => ':attribute có độ dài tối đa :max',
            ],
            [
                'title' => 'Tiêu đề bài viết',
                'slug' => 'Link SEO',
                'thumbnail' => 'Hình ảnh',
                'desc' => 'Mô tả ngắn',
                'content' => 'Nội dung',
                'category_id' => 'Danh mục cha',
            ]
        );
        //
        try {
            DB::beginTransaction();

            if ($request->hasFile('thumbnail')) {
                $file = $request->thumbnail;
                $filename = $file->getClientOriginalName();
                $path = $file->move('public/uploads/post', $filename);

                $thumbnail = 'public/uploads/post/'.$filename;

            }
            //insert posts
            $post = Post::find($id)->update([
                'title' => $request->input('title'),
                'slug' => $request->input('slug'),
                'thumbnail' => $thumbnail,
                'desc' => $request->input('desc'),
                'content' => $request->input('content'),
                'user_id' => Auth::id(),
                'postcat_id' => $request->input('category_id'),
                'status' => $request->input('status'),
            ]);
            DB::commit();

            return redirect('admin/post/add')->with('status', 'Thêm bài viết thành công');

        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("Thông báo:" . $exception->getMessage().'Line'.$exception->getLine());
        }

    }
}
