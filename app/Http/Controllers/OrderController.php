<?php

namespace App\Http\Controllers;

use App\Mail\CheckoutMail;
// use App\Mail\DemoMail;
use App\Models\Customer;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Status;
use App\Models\Payment;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Province;
use App\Models\District;
use App\Models\Wards;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    function checkout(){
        $payments = Payment::all();
        $provinces = Province::all();
        $districts = District::all();
        $wards = Wards::all();

        return view('public.order.checkout', compact('payments','provinces','districts','wards'));
    }
    function address_ajax( Request $request){
        $action = $request->input('action');
        $ma_id = $request->input('ma_id');
        if($action){
            $output = '';
            $districts = District::where('province_id', $ma_id)->orderBy('district_id', 'ASC')->get();
            if($action == 'province'){
                $output.='<option value="" selected>Chọn Thành phố / quận huyện</option>';
                foreach($districts as $district){
                    $output.='<option value="'. $district->district_id .'">'. $district->name .'</option>';
                }
            } else{
                $wards = Wards::where('district_id', $ma_id)->orderBy('wards_id', 'ASC')->get();
                $output.='<option value="" selected>Phường xã</option>';
                foreach($wards as $ward){
                    $output.='<option value="'. $ward->wards_id .'">'. $ward->name .'</option>';
                }
            }
        }
        echo $output;
    }
    function store(Request $request){
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
                'phone' => 'required|numeric',
                'address' => 'required|string|max:255',
            ],
            [
                'required'=> ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min',
                'max' => ':attribute có độ dài tối đa :max',
            ],
            [
                'name'=> 'Tên khách hàng',
                'email'=> 'Email',
                'phone' =>'Số điện thoại',
                'address' =>'Địa chỉ',
            ]
        );
        $customer = Customer::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'province_id' => $request->input('province'),
            'district_id' => $request->input('district'),
            'wards_id' => $request->input('wards'),
        ]);

        $user_id = null;
        if($customer){

            $customer_id = $customer->id;
            $request->session()->put('customer_id',$customer->id);
            $order = Order::create([
                'user_id' => $user_id,
                'customer_id' => $request->session()->get('customer_id'),
                'status_id' => 1,
                'note' => $request->input('note'),
                'payment_id' => $request->input('payment-method'),
                'total' => (Cart::total()),
                'total_qty' => (Cart::count()),
            ]);

            if($order){
                // $order_id = $order->id;
                $request->session()->put('order_id',$order->id);
                foreach (Cart::content() as $item) {
                    $order_product = OrderProduct::create([
                        'order_id' => $request->session()->get('order_id'),
                        'product_id' => $item->id,
                        'quantity' => $item->qty,
                    ]);

                    $product = Product::find($item->id);
                    if($product){
                        Product::find($item->id)->update([
                            'selling' => $product->selling + $item->qty
                        ]);
                    }
                }


            }
            $data = [
                'customer' => $customer,
                'order' => $order,
                'cart' => Cart::content(),
            ];
            Mail::to($request->input('email'))->send(new CheckoutMail($data));

            return redirect('order/success');
        } else{
            return redirect('order/checkout')->with('status', 'Đặt hàng thất bại, vui lòng đặt lại');

        }

    }

    function success(Request $request){

        $customer = Customer::find($request->session()->get('customer_id'));
        $order_id =$request->session()->get('order_id');
        $order_product = Cart::content();
        $order_total = Cart::total();

        Cart::destroy();
        $request->session()->flush();
        return view('public.order.success',compact('customer','order_id','order_product','order_total'));

    }

}
