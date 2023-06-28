<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductTag;
use App\Models\Tag;
use App\Models\User;
use App\Components\Recusive;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
class AdminProductController extends Controller
{
    private $category;
    private $product;
    private $productImage;
    private $productTag;
    private $tag;
    function __construct(Category $category, Product $product, ProductImage $productImage, ProductTag $productTag, Tag $tag)
    {

        $this->category = $category;
        $this->product = $product;
        $this->productImage = $productImage;
        $this->productTag = $productTag;
        $this->tag = $tag;

        $this->middleware(function ($request, $next){
            session(['module_active'=> 'product']);
            return $next($request);
        });
    }

    function add(Request $request){
        session([
            'module_hover'=>'product.add',
        ]);
        // if($request->input('btn-add')){
        //     return $request->input();
        // }
        $data = $this->category->all();

        $recusive = new Recusive($data);

        $categories = $recusive->data_tree();
        return view('admin.product.add', compact('categories'));
    }
    function store(Request $request)
    {
        // dd($request->tags);
        // if($request->input('btn-add')){
        //     return $request->input();
        // }
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'slug' => 'required',
                'price' => 'required',
                'discount' => 'required',
                'feature_image_path' => 'required',
                'content' => 'required',
                'category_id' => 'required',
                'tags' => 'required',


            ],
            [
                'required'=> ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min',
                'max' => ':attribute có độ dài tối đa :max',
                'confirmed'=> 'Xác nhận mật khẩu ko chính xác',
            ],
            [
                'name' => 'Tên sản phẩm',
                'slug' => 'Link SEO',
                'price' => 'Giá sản phẩm',
                'discount' => 'Giá giảm',
                'feature_image_path' => 'Hình ảnh',
                'content' => 'Nội dung',
                'category_id' => 'Danh mục cha',
                'tags' => 'Tag',
            ]
        );
        //
        try {
            DB::beginTransaction();

            if ($request->hasFile('feature_image_path')) {
                $file = $request->feature_image_path;
                $filename = $file->getClientOriginalName();
                $path = $file->move('public/uploads/product', $filename);

                $feature_image_path = 'public/uploads/product/'.$filename;

            }
            //insert products
            $product = $this->product->create([
                'name' => $request->input('name'),
                'slug' => $request->input('slug'),
                'price' => $request->input('price'),
                'feature_image_path' => $feature_image_path,
                'content' => $request->input('content'),
                'user_id' => Auth::id(),
                'category_id' => $request->input('category_id'),
                'discount' => $request->input('discount'),
                'status' => $request->input('status'),
            ]);

            //insert images
            if ($request->hasFile('image_path')) {
                $files = $request->image_path;
                foreach($files as $itemImage){
                    $filename = $itemImage->getClientOriginalName();
                    $path = $itemImage->move('public/uploads/product', $filename);
                    $image_path = 'public/uploads/product/'. $filename;

                    $product->images()->create([
                        'image_path' => $image_path,
                        'product_id' => $product->id,
                    ]);
                }
            }

            //insert tags for products
            if(!empty($request->tags)){
                foreach($request->tags as $tagItem){
                    //insert to tags
                    $tags = $this->tag->firstOrCreate(['name' => $tagItem]);
                    $tagIds[] = $tags->id;
                }
            }

            $product->tags()->attach($tagIds);
            DB::commit();
            return redirect('admin/product/add')->with('status', 'Thêm sản phẩm thành công');

        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("Thông báo:" . $exception->getMessage().'Line'.$exception->getLine());
        }

    }

    function edit($id){
        $product = $this->product->find($id);
        $data = $this->category->all();

        $recusive = new Recusive($data);

        $categories = $recusive->data_tree();
        // $feature_image_path = $product->feature_image_path;
        // dd($feature_image_path);
        return view('admin.product.edit', compact('product','categories'));
    }

    function update(Request $request, $id){
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'slug' => 'required',
                'price' => 'required',
                'discount' => 'required',
                'feature_image_path' => 'required',
                'content' => 'required',
                'category_id' => 'required',
                'tags' => 'required',


            ],
            [
                'required'=> ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min',
                'max' => ':attribute có độ dài tối đa :max',
                'confirmed'=> 'Xác nhận mật khẩu ko chính xác',
            ],
            [
                'name' => 'Tên sản phẩm',
                'slug' => 'Link SEO',
                'price' => 'Giá sản phẩm',
                'discount' => 'Giá giảm',
                'feature_image_path' => 'Hình ảnh',
                'content' => 'Nội dung',
                'category_id' => 'Danh mục cha',
                'tags' => 'Tag',
            ]
        );
        //
        try {
            DB::beginTransaction();
            $product = $this->product->find($id);
            // if(empty($product->feature_image_path)){
            //     $feature_image_path = $product->feature_image_path;
            // }
            if ($request->hasFile('feature_image_path')) {
                $file = $request->feature_image_path;
                $filename = $file->getClientOriginalName();
                $path = $file->move('public/uploads/product', $filename);

                $feature_image_path = 'public/uploads/product/'.$filename;

            }

            // dd($feature_image_path);
            $this->product->where('id',$id)->update([
                'name' => $request->input('name'),
                'slug' => $request->input('slug'),
                'price' => $request->input('price'),
                'feature_image_path' => $feature_image_path,
                'content' => $request->input('content'),
                'user_id' => Auth::id(),
                'category_id' => $request->input('category_id'),
                'discount' => $request->input('discount'),
                'status' => $request->input('status'),
            ]);
            //insert images
            if ($request->hasFile('image_path')) {
                $this->productImage->where('product_id', $id)->delete();
                $files = $request->image_path;
                foreach($files as $itemImage){
                    $filename = $itemImage->getClientOriginalName();
                    $path = $itemImage->move('public/uploads/product', $filename);
                    $image_path = 'public/uploads/product/'. $filename;

                    $product->images()->create([
                        'image_path' => $image_path,
                        'product_id' => $product->id,
                    ]);
                }
            }

            //insert tags for products
            if(!empty($request->tags)){
                foreach($request->tags as $tagItem){
                    //insert to tags
                    $tags = $this->tag->firstOrCreate(['name' => $tagItem]);
                    $tagIds[] = $tags->id;
                }
            }

            $product->tags()->sync($tagIds);
            DB::commit();
            return redirect('admin/product/list')->with('status', 'Cập nhật sản phẩm thành công');

        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("Thông báo:" . $exception->getMessage().'Line'.$exception->getLine());
        }

    }

    function delete($id){
        $product = $this->product->find($id);
        $product -> delete();

        return redirect('admin/product/list')->with('status', 'Xóa thành viên thành công');
    }

    function list( Request $request){
        session([
            'module_hover'=>'product.list',
        ]);
        $status = $request->input('status');
        $list_act = [
            'delete' => 'Xóa tạm thời'
        ];

        if($status == 'trash'){
            $list_act = [
                'restore' => 'Khôi phục',
                'forceDelete' => 'Xóa vĩnh viễn',
            ];
            $products = $this->product->onlyTrashed()->paginate(20);

        } else {
            $keyword = "";
            if($request->input('keyword')){
                $keyword = $request->input('keyword');
            }

            $products = $this->product->latest()->where('name','LIKE',"%{$keyword}%")->paginate(20);
        }
        $users = User::all();
        $count_user_active = $this->product->count();
        $count_user_trash = $this->product->onlyTrashed()->count();
        $count = [$count_user_active,$count_user_trash];
        // dd($products);
        $status_array = [
            '1' => 'Hiển thị',
            '0' => 'Ẩn'
        ];
        return view('admin.product.list', compact('products','count','list_act','status_array','users'));
    }

    function action(Request $request){
        $list_check = $request->input('list_check');
        // dd($list_check);
        if($list_check){
            $act = $request->input('act');
            if( $act == 'delete'){
                $this->product->destroy($list_check);
                return redirect('admin/product/list')->with('status', 'Bạn đã xóa sản phẩm thành công');
            }
            if( $act == 'restore'){
                $this->product->withTrashed()
                ->whereIn('id',$list_check)
                ->restore();
                return redirect('admin/product/list')->with('status', 'Bạn đã khôi phục sản phẩm thành công');
            }
            if($act == 'forceDelete'){
                $this->product->onlyTrashed()
                ->whereIn('id', $list_check)
                ->forceDelete();
                return redirect('admin/product/list')->with('status', 'Bạn đã xóa vĩnh viễn sản phẩm');
            }
        }


    }
}
