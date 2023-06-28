<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
class PostController extends Controller
{
    function show(){
        $posts = Post::where('status', 1)->latest()->paginate(10);
        return view('public.post.show', compact('posts'));
    }

    function detail($slug){
        $post = Post::where('slug', $slug)->first();
        return view('public.post.detail', compact('post'));
    }
}
