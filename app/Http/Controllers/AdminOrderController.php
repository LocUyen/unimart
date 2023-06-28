<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Province;
use App\Models\District;
use App\Models\Wards;
class AdminOrderController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session([
                'module_active' => 'order',
            ]);
            return $next($request);
        });
    }
    function list(Request $request)
    {
        session(['module_hover'=> 'order.list']);

        $keyword = "";
        if ($request->input('keyword')) {
            $keyword = $request->input('keyword');
        }

        $status = $request->input('status');
        if($status==1){
            $orders = DB::table('orders')
            ->join('status', 'status.id', '=', 'orders.status_id')
            ->join('customers', 'customers.id', '=', 'orders.customer_id')
            ->select('status.status', 'customers.name', 'customers.phone', 'orders.*')
            ->orderBy('orders.id', 'DESC')
            ->where('status_id','=', '1')
            ->where('name', 'LIKE', "%{$keyword}%")
            ->paginate(20);
        } elseif($status==2){
            $orders = DB::table('orders')
            ->join('status', 'status.id', '=', 'orders.status_id')
            ->join('customers', 'customers.id', '=', 'orders.customer_id')
            ->select('status.status', 'customers.name', 'customers.phone', 'orders.*')
            ->orderBy('orders.id', 'DESC')
            ->where('status_id','=', '2')
            ->where('name', 'LIKE', "%{$keyword}%")
            ->paginate(20);
        } elseif($status==3){
            $orders = DB::table('orders')
            ->join('status', 'status.id', '=', 'orders.status_id')
            ->join('customers', 'customers.id', '=', 'orders.customer_id')
            ->select('status.status', 'customers.name', 'customers.phone', 'orders.*')
            ->orderBy('orders.id', 'DESC')
            ->where('status_id','=', '3')
            ->where('name', 'LIKE', "%{$keyword}%")
            ->paginate(20);
        } elseif($status==4){
            $orders = DB::table('orders')
            ->join('status', 'status.id', '=', 'orders.status_id')
            ->join('customers', 'customers.id', '=', 'orders.customer_id')
            ->select('status.status', 'customers.name', 'customers.phone', 'orders.*')
            ->orderBy('orders.id', 'DESC')
            ->where('status_id','=', '4')
            ->where('name', 'LIKE', "%{$keyword}%")
            ->paginate(20);
        } else{
            $orders = DB::table('orders')
            ->join('status', 'status.id', '=', 'orders.status_id')
            ->join('customers', 'customers.id', '=', 'orders.customer_id')
            ->select('status.status', 'customers.name', 'customers.phone', 'orders.*')
            ->orderBy('orders.id', 'DESC')
            ->where('name', 'LIKE', "%{$keyword}%")
            ->paginate(20);
        }
        $order_count = Order::all()->count();
        $status_1 = Order::where('status_id',1)->count();
        $status_2 = Order::where('status_id',2)->count();
        $status_3 = Order::where('status_id',3)->count();
        $status_4 = Order::where('status_id',4)->count();
        $sum = Order::where('status_id',3)->sum('total');
        // dd($status_1);
        return view('admin.order.list', compact('orders','order_count','status_1','status_2','status_3','status_4','sum'));
    }

    function edit($id)
    {
        // dd($id);
        $customer = Order::find($id)->customer;
        $order = Order::find($id);
        $order_products = OrderProduct::where('order_id', $id)->get();
        // dd($order);
        $status = Status::all();
        // dd($order);
        return view('admin.order.edit', compact('order', 'status', 'customer', 'order_products'));
    }

    function update(Request $request, $id)
    {
        Order::where('id', $id)->update([
            'status_id' => $request->input('status'),
        ]);

        return redirect('admin/order/list');
    }

    function delete($id)
    {
        $order = Order::find($id);
        $order->delete();

        return redirect('admin/order/list')->with('status', 'Xóa đơn hàng thành công');
    }
    function action(Request $request){
        $list_check = $request->input('list_check');
        // dd($list_check);
        if(!empty($list_check)){
            $act = $request->input('act');
            if($act == 'delete'){
                Order::destroy($list_check);
                OrderProduct::whereIn('order_id', $list_check)->delete();
                return redirect('admin/order/list')->with('status', 'Xóa đơn hàng thành công');
            }
        }
    }
}
