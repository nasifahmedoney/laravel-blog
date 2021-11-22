<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Category;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest();

    if( request('search'))
    {
        $posts
            ->where('title', 'like', '%'.request('search').'%')
            ->orWhere('body', 'like', '%'.request('search').'%');
    }

    return view('posts', [
        //using $with property in Post model, n+1 problem, Post-> category,author
        'posts' => $posts->get(),
        'categories' => Category::all()
        //'posts' => Post::latest()->with('category','author')->get()
        //latest('published_at') to specify field
    ]);
    }
}
