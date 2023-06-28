<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
// use App\Components\data;
use App\Models\Page;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function show()
    {
        //sp mới nhất
        $products = Product::where('status', '1')->latest()->take(4)->get();

        $categories = Category::where('status', '1')->where('parent_id','0')->get();
        // $category_cat_ids = Category::where('status', '1')
        //     ->where('parent_id', $categories->id)
        //     ->orWhere('id', $categories->id)
        //     ->select('id')
        //     ->get();
        // echo "<pre>";
        // print_r($categories);
        // echo "</pre>";
        // dd($category_cat_ids);
        return view('public.home.home', compact('products', 'categories'));
    }




    function page($slug)
    {
        $page = Page::where('link', $slug)->first();
        return view('public.home.page', compact('page'));
    }

    function search(Request $request)
    {
        $keyword = "";
        if ($request->input('keyword')) {
            $keyword = $request->input('keyword');
        }

        $products = Product::where('name', 'LIKE', "%{$keyword}%")->get();
        // dd($products);
        return view('public.home.search', compact('products'));
    }

    function searchAuto(Request $request)
    {
        if ($request->get('keyword')) {
            $keyword = $request->get('keyword');
            $product = Product::where('status', 1)->where('name', 'LIKE', "%{$keyword}%")->get();
            $categories = Category::where('status', 1)->get();
            $output = '<ul class="dropdown-menu d-block position-absolute border-0" style="width:399px;">';
            foreach ($product as $row) {
                $output .= '
                <li class="li_search" style="    border-bottom: 1px solid #e9e0e0">
                <a href="' . route('product.detail', $row->slug) . '" class="product-link" style="font-family: inherit;font-size: 14px;    display: flex;max-width: 100%;height: auto;align-items: center;">
                    <div class="item-thumb" style="display: block;max-width: 18%;height: auto;">
                        <img src="' . url($row->feature_image_path	) . '" alt="">
                    </div>
                    <div class="item-detail" style="margin-left: 15px;">
                        <p class="product-name" style="color: #000;font-weight: 600;font-size: 15px;-webkit-line-clamp: 2;">' . $row->name . '</p>
                        <span class="item-price" style="color: #f22; font-weight: 800;">' . number_format($row->discount) . 'đ</span>
                    </div>
                </a>
            </li>
                            ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
}
