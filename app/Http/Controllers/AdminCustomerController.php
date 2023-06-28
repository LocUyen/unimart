<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class AdminCustomerController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next){
            session([
                'module_active'=>'order',
            ]);
            return $next($request);
        });
    }
    function list(Request $request){
        session(['module_hover'=> 'customer.list']);

        $keyword = "";
        if($request->input('keyword')){
            $keyword = $request->input('keyword');
        }
        $customers = Customer::where('name','LIKE',"%{$keyword}%")->latest()->paginate(20);
        // dd($customer);
        return view('admin/customer/list',compact('customers'));
    }
}
