<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => 'dashboard']);
            return $next($request);
        });
    }

    function show()
    {
        $orders = DB::table('orders')
            ->join('status', 'status.id', '=', 'orders.status_id')
            ->join('customers', 'customers.id', '=', 'orders.customer_id')
            ->select('status.status', 'customers.name', 'customers.phone', 'orders.*')
            ->orderBy('orders.id', 'DESC')
            ->paginate(20);

        $order_count = Order::all()->count();
        $status_1 = Order::where('status_id', 1)->count();
        $status_2 = Order::where('status_id',2)->count();
        $status_3 = Order::where('status_id', 3)->count();
        $status_4 = Order::where('status_id', 4)->count();
        $sum = Order::where('status_id',3)->sum('total');
        return view('admin.dashboard', compact('orders','order_count','status_1','status_2','status_3','status_4','sum'));
    }
}
