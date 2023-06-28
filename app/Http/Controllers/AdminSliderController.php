<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminSliderController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next){
            session(['module_active'=> 'slider']);
            return $next($request);
        });
    }
    function add(){
        $sliders = Slider::all();

        $users = User::all();
        // dd($sliders);

        return view('admin.slider.add', compact('sliders','users'));
    }

    function store(Request $request){
        // return $request->all();
        $request->validate(
            [
                'title' => 'required',
                'thumbnail' => 'required',
                'desc' => 'required',
                'link' => 'required',
            ],
            [
                'required'=> ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min',
                'max' => ':attribute có độ dài tối đa :max',
            ],
            [
                'title'=> 'Tiêu đề',
                'thumbnail'=> 'Ảnh',
                'desc'=> 'Mô tả',
                'link'=> 'Tên đường dẫn',
            ]
        );
        if ($request->hasFile('thumbnail')) {
            $file = $request->thumbnail;
            $filename = $file->getClientOriginalName();
            $path = $file->move('public/uploads/slider', $filename);

            $thumbnail = 'public/uploads/slider/'.$filename;

        }
        // return $filename;

        Slider::create([
            'title' => $request->input('title'),
            'thumbnail' => $thumbnail,
            'desc' => $request->input('desc'),
            'link' => $request->input('link'),
            'status' => $request->input('status'),
            'user_id' => Auth::id(),
        ]);

        return redirect('admin/slider/add')->with('status', 'Thêm slider mới thành công');
    }

    function delete($id){
        $slider = Slider::find($id);
        $slider -> delete();

        return redirect('admin/slider/add')->with('status', 'Xóa slider thành công');
    }

    function edit($id){
        $slider = slider::find($id);
        $sliders = slider::all();
        $users = User::all();

        return view('admin.slider.edit', compact('slider','sliders','users'));
    }

    function update(Request $request, $id){
        $request->validate(
            [
                'title' => 'required',
                'thumbnail' => 'required',
                'desc' => 'required',
                'link' => 'required',
            ],
            [
                'required'=> ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min',
                'max' => ':attribute có độ dài tối đa :max',
            ],
            [
                'title'=> 'Tiêu đề',
                'thumbnail'=> 'Ảnh',
                'desc'=> 'Mô tả',
                'link'=> 'Tên đường dẫn',
            ]
        );
        if ($request->hasFile('thumbnail')) {
            $file = $request->thumbnail;
            $filename = $file->getClientOriginalName();
            $path = $file->move('public/uploads/slider', $filename);

            $thumbnail = 'public/uploads/slider/'.$filename;

        }
        // return $filename;

        Slider::where('id',$id)->update([
            'title' => $request->input('title'),
            'thumbnail' => $thumbnail,
            'desc' => $request->input('desc'),
            'link' => $request->input('link'),
            'status' => $request->input('status'),
            'user_id' => Auth::id(),
        ]);

        return redirect('admin/slider/add')->with('status', 'Cập nhật slider thành công');

    }
}
