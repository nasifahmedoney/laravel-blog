<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Category;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('posts', [
            'posts' => Post::latest()->filter(request(['search']))->get(), //filter() defined in Post model
            'categories' => Category::all()
            ]);
    }

    public function show(Post $post)
    {
        return view('post',[
            'post' => $post,
            'categories' => Category::all()
        ]);
    }
}

//using post controller optional #3
