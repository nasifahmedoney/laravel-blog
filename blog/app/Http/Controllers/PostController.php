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
            'posts' => Post::latest()->filter()->get(), //filter() defined in Post model
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

    // protected function getPosts()
    // {
    //     $posts = Post::latest();

    //     if( request('search'))
    //     {
    //         $posts
    //             ->where('title', 'like', '%'.request('search').'%')
    //             ->orWhere('body', 'like', '%'.request('search').'%');
    //     }

    //     return $posts->get();
    // }
}

//using post controller optional #3
