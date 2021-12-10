<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function index()
    {
        //using pageination
        return view('posts.index', [
            'posts' => Post::latest()->filter(
                request( ['search','category','author'] )
                )->paginate(5)->withQueryString()
                //simplePaginate(), alternative paginate()
                //withQueryString() keeping the category query string in the url from the previous page 
            
            ]);
        // return view('posts.index', [
        //     'posts' => Post::latest()->filter(request( ['search','category','author'] ))->get(), //filter() defined in Post model
            
        //     ]);
    }

    public function show(Post $post)
    {
        return view('posts.show',[
            'post' => $post,
            'categories' => Category::all()
        ]);
    }

    public function create()
    {
        
        // create middleware AdminsOnly, php artisan make:middleware AdminsOnly
        // if(auth()->user()?->username !== 'nasif_ahmed'){
        //     abort(Response::HTTP_FORBIDDEN);
        // }
        //checks for the login auth and redirect
        //add middlware('admin') in route and AdminsOnly in kernel
        return view('posts.create');
    }

    public function store()
    {
        //ddd(request()->all());
        $attributes = request()->validate([
            'title' => 'required',
            'slug' => ['required', Rule::unique('posts', 'slug')],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);

        $attributes['user_id'] = auth()->id();

        Post::create($attributes);

        return redirect('/');
    }
}

