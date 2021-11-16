<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

#Route::get('/', function () {
#    return view('welcome');
#});


//$post = Post::all();
//
//ddd(Post::all());
//using $with property in Post model, n+1 problem, Post-> category,author

Route::get('/', function () {
    return view('posts', [
        //using $with property in Post model, n+1 problem, Post-> category,author
        'posts' => Post::latest()->get(),
        'categories' => Category::all()
        //'posts' => Post::latest()->with('category','author')->get()
        //latest('published_at') to specify field
    ]);
});


Route::get('post/{post:slug}', function (Post $post) 
{
    return view('post',[
        'post' => $post,
        'categories' => Category::all()
    ]);
});

Route::get('categories/{category:slug}',function(Category $category)
{
    return view('posts',[
        //using $with property in Post model
        'posts' => $category->posts,
        'currentCategory' =>$category,
        'categories' => Category::all()
        //'posts' => $category->posts->load('category','author')
    ]);
});

Route::get('authors/{authors:username}',function(User $authors)
{
    return view('posts',[
        //using $with property in Post model
        'posts' => $authors->posts,
        'categories' => Category::all()
    ]);
});


    /*
    $path = __DIR__."/../resources/posts/{$slug}.html"; #path to the file
    
    if(!file_exists($path)) #redirect or abort if file not found
    {
        return redirect('/');
        //abort(404);
    }

    $post = cache()->remember("posts.{$slug}", 5, function() use($path) # save in cache for 5 secs 
    {
        //var_dump('file_get_contents');
        return file_get_contents($path);
    });

    return view('post', [
       'post' => $post
    ]);
    */


/*
Route::get('posts/{post}', function ($slug) {
    if (! file_exists($path = __DIR__ . "/../resources/posts/{$slug}.html")) {
        return redirect('/');
    }

    $post = cache()->remember("posts.{$slug}", 1200, fn() => file_get_contents($path));

    return view('post', ['post' => $post]);
})->where('post', '[A-z_\-]+');

*/
#post=cache()->remember("anyname.{$any_thing}", now()->addSecond(60),function() use ($path)
//addSeconds,mins,hours and other options
