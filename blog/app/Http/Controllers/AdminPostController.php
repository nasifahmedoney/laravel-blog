<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class AdminPostController extends Controller
{
    public function index()
    {
        return view('admin.posts.index',[
            'posts' => Post::paginate(50)
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
        // file info
        //ddd(request()->file('thumbnail'));
        //creates a folder 'thumbnails' in storage>app> or storage>app>public>, file config set in config>filesystems.php
        // Illuminate\http\UploadedFile;
        // filesystems.php->'default' => env('FILESYSTEM_DRIVER', 'local'),check FILESYSTEM_DRIVER if not found 'local'
        // .env file FILESYSTEM_DRIVER=public
        // $path = request()->file('thumbnail')->store('thumbnails');
        // return 'Done '.$path;


        $attributes = request()->validate([
            'title' => 'required',
            'thumbnail' => 'image',
            'slug' => ['required', Rule::unique('posts', 'slug')],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);

        $attributes['user_id'] = auth()->id();
        if(isset($attributes['thumbnail']))
        {
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }
        Post::create($attributes);

        return redirect('/');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit',[
            'post' => $post
        ]);
    }

    public function update(Post $post)
    {
        $attributes = request()->validate([
            'title' => 'required',
            'thumbnail' => 'image',
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post->id)],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);

        if(isset($attributes['thumbnail']))
        {
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }

        $post->update($attributes);

        return back()->with('success','post updated');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('success','Post deleted');
    }
}
