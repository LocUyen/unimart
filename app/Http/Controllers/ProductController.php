<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    function show(){
        $categories = Category::where('status', 1)->where('parent_id', 0)->get();
        $products = Product::where('status', 1)->get();
        $data = DB::table('products')
        ->join('categories', 'products.category_id','=','categories.id')
        ->select('categories.parent_id', 'products.*')->latest()
        ->get();
        return view('public.product.show',compact('categories','products','data'));

    }
    function category($slug_cat)
    {
        //lấy 1 cat từ slug
        $category= Category::where('status', '1')->where('slug', $slug_cat)->first();
        $category_id = Category::where('status', '1')->where('slug', $slug_cat)->selectRaw('id')->first();
        // dd($category_id);
        //lấy các cat có parents từ slug
        $category_cat_ids = Category::where('status', '1')
            ->where('parent_id', $category_id)
            ->orWhere('id', $category_id)
            ->select('id')
            ->get();
        // dd($category_cat_ids);
        if (isset($_GET['sort'])) {
            $sort = $_GET['sort'];
            // echo $sort;
            if ($sort == 'az') {
                $products = Product::where('status', '1')
                ->whereIn('category_id', $category_cat_ids)
                ->orderBy('name', 'ASC')
                ->get();

            } elseif ($sort == 'za') {
                $products = Product::where('status', '1')
                ->whereIn('category_id', $category_cat_ids)
                ->orderBy('name', 'DESC')
                ->get();

            } elseif ($sort == 'hl') {
                $products = Product::where('status', '1')
                ->whereIn('category_id', $category_cat_ids)
                ->orderBy('discount', 'DESC')
                ->get();
                // dd($products);
            } elseif ($sort == 'lh') {
                $products = Product::where('status', '1')
                ->whereIn('category_id', $category_cat_ids)
                ->orderBy('discount', 'ASC')
                ->get();

            }
        } elseif (isset($_GET['price'])) {
            $price = $_GET['price'];
            // echo $price;
            if ($price == 500) {

                $products = Product::where('status', '1')
                ->whereIn('category_id', $category_cat_ids)
                ->where('discount', '<', 500000)
                ->get();

            } elseif ($price == '500_1000') {

                $products = Product::where('status', '1')
                ->whereIn('category_id', $category_cat_ids)
                ->where('discount', '>=', 500000)
                ->where('discount','<=', 1000000)
                ->get();

            } elseif ($price == '1000_5000') {

                $products = Product::where('status', '1')
                ->whereIn('category_id', $category_cat_ids)
                ->where('discount', '>=', 1000000)
                ->where('discount','<=', 5000000)
                ->get();

            } elseif ($price == '5000_10000') {

                $products = Product::where('status', '1')
                ->whereIn('category_id', $category_cat_ids)
                ->where('discount', '>=', 5000000)
                ->where('discount','<=', 10000000)
                ->get();

            } elseif ($price == '10000') {

                $products = Product::where('status', '1')
                ->whereIn('category_id', $category_cat_ids)
                ->where('discount','>', 10000000)
                ->get();

            }

        } elseif (isset($_GET['brand'])) {
            $products = Product::where('status', '1')
                ->whereIn('category_id', $category_cat_ids)
                ->where('category_id', $_GET['brand'])
                ->get();

        } else {
            $products = Product::where('status', '1')->latest()
            ->whereIn('category_id', $category_cat_ids)
            ->get();
        }
        $categories = Category::where('status', 1)->get();

        return view('public.category.show', compact('category', 'categories', 'category_cat_ids', 'products'));
    }
    function detail($slug){
        $product = Product::where('slug',$slug)->where('status','1')->first();
        $categories = Category::where('status',1)->get();

        $same_category = Category::find($product->category_id);

        // dd($data);
        // dd($same_category);
        return view('public.product.detail', compact('product','slug','categories','same_category'));
    }
}
