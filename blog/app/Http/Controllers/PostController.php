<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Category;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::latest()->filter(request( ['search','category'] ))->get(), //filter() defined in Post model
            
            ]);
    }

    public function show(Post $post)
    {
        return view('posts.show',[
            'post' => $post,
            'categories' => Category::all()
        ]);
    }
}

