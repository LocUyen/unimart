<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Mockery\Undefined;
use Symfony\Component\HttpFoundation\Session\Session;
class CartController extends Controller
{
    public function add(Request $request, $id)
    {
        $id = $request->input('id');
        $qty = $request->input('qty');
        $product = Product::find($id);
        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => $qty,
            'price' => $product->discount,
            'options' => ['thumbnail' => $product->feature_image_path],
        ]);
        //display cart
        $output = '';
        $output.='
        <div id="btn-cart">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            <span id="num">'.Cart::count().'</span>
        </div>
        <div id="dropdown">
        <p class="desc">Có <span>'. Cart::count() .' sản phẩm</span> trong giỏ hàng</p>
        <ul class="list-cart">';
            foreach(Cart::content() as $row){
                $output.='
                <li class="clearfix">
                    <a href="" title="" class="thumb fl-left">
                        <img src="'. url($row->options->thumbnail).'" alt="">
                    </a>
                    <div class="info fl-right">
                        <a href="" title="" class="product-name">'. $row->name.'</a>
                        <p class="price">'. number_format($row->price, 0, ',', '.').'đ
                        </p>
                        <p class="qty">Số lượng: <span>'.$row->qty.'</span></p>
                    </div>
                </li>
                ';
            }
        $output.='
        </ul>
        <div class="total-price clearfix">
            <p class="title fl-left">Tổng:</p>
            <p class="price fl-right">'.number_format(Cart::total()).'đ</p>
        </div>
        <div class="action-cart clearfix">
            <a href="'.url('cart/show') .'" title="Giỏ hàng" class="view-cart fl-left">Giỏ hàng</a>
            <a href="'.route('order.checkout').'" title="Thanh toán" class="checkout fl-right">Thanh
                toán</a>
        </div>
        </div>
        ';
        echo $output;
        // dd($id);
        // print_r(Cart::content());
        // return redirect('cart/show');
    }
    function quick_checkout(Request $request, $id){
        $product = Product::find($id);
        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => 1,
            'price' => $product->discount,
            'options' => ['thumbnail' => $product->feature_image_path],
        ]);
        return redirect('order/checkout');
    }
    function show()
    {
        $products = Product::all();
        $categories = Category::all();
        $cart = Cart::content();
        // dd($cart);
        return view('public.cart.show', compact('products', 'categories'));
    }
    function remove($rowId)
    {
        Cart::remove($rowId);
        return redirect('cart/show')->with('message','Xóa thành công');
    }
    //all product
    function destroy()
    {
        Cart::destroy();
        // return response()->json([
        //     'code' => 200,
        //     'message' => 'success'
        // ]);
        $status = 'success';
        echo $status;
    }

    function update(Request $request)
    {
        $data = $request->input('qty');
        foreach ($data as $rowId => $qty) {
            Cart::update($rowId, $qty);
        }
        // return $request->all();
        return redirect('cart/show');
    }

    function update_ajax()
    {
        // $data = $request->input('qty');
        $qty = $_POST['qty'];
        $rowId = $_POST['rowId'];
        $price = $_POST['price'];
        $sub_total = $qty * $price;
        Cart::update($rowId, $qty);
        // $data = Cart::content();
        $data = array(
            'sub_total' => number_format($sub_total, 0, ',', '.'),
            'total' => number_format(Cart::total(), 0, ',', '.'),
        );
        echo json_encode($data);
    }
}
