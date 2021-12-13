<?php

use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\AdminPostController;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Services\Newsletter;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use Illuminate\Validation\ValidationException;
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

//restful actions
//index, show, create, store, edit, update, destroy
Route::post('newsletter', NewsletterController::class); 
Route::get('/', [PostController::class, 'index'])->name('home');
//check named url
Route::get('post/{post:slug}', [PostController::class, 'show'] );
Route::post('post/{post:slug}/comments', [PostCommentsController::class, 'store'] );


Route::get('register', [RegisterController::class, 'create'] )->middleware('guest');
Route::post('register', [RegisterController::class, 'store'] )->middleware('guest');
//middleware->app/Http/kernel.php

Route::get('login',[SessionsController::class, 'create'])->middleware('guest');
Route::post('login',[SessionsController::class, 'store'])->middleware('guest');

Route::post('logout',[SessionsController::class, 'destroy'])->middleware('auth');

Route::get('admin/posts/create', [AdminPostController::class, 'create'])->middleware('admin');
Route::post('admin/posts/', [AdminPostController::class, 'store'])->middleware('admin');
Route::get('admin/posts', [AdminPostController::class, 'index'])->middleware('admin');
Route::get('admin/posts/{post}/edit', [AdminPostController::class, 'edit'])->middleware('admin');
Route::patch('admin/posts/{post}', [AdminPostController::class, 'update'])->middleware('admin');
Route::delete('admin/posts/{post}', [AdminPostController::class, 'destroy'])->middleware('admin');



// Route::get('categories/{category:slug}',function(Category $category)
// {
//     return view('posts',[
//         //using $with property in Post model
//         'posts' => $category->posts,
//         'currentCategory' =>$category,
//         'categories' => Category::all()
//         //'posts' => $category->posts->load('category','author')
//     ]);
// })->name('category');

// Route::get('authors/{authors:username}',function(User $authors)
// {
//     return view('posts.index',[
//         //using $with property in Post model
//         'posts' => $authors->posts,
//         'categories' => Category::all()
//     ]);
// });


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
