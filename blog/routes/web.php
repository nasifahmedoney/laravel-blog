<?php

use App\Models\Post;
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



Route::get('/', function () {
    //$post = Post::all();
    //
    //ddd(Post::all());

    return view('posts', [
        'posts_var_from_route' => Post::all()
    ]);
});

Route::get('/post/{post}', function ($id) {
    //find post by its slug and pass it to a view called "post"
    $post = Post::findOrFail($id);
    
    return view('post',[
        'post' => $post
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
