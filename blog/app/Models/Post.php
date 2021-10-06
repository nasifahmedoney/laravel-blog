<?php

namespace App\Models;

use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Symfony\Component\Yaml\Yaml;

class Post
{
    public $title;
    public $slug;
    public $body;
    public $date;

    public function __construct($title,$slug,$body,$date)
    {
        $this->title = $title;
        $this->slug = $slug;
        $this->body = $body;
        $this->date = $date;        
    }



    public static function find($slug)
    {
        // $path = resource_path("/posts/{$slug}.html"); #path to the file
        
        // if(!file_exists($path)) #redirect or abort if file not found
        // {
        //     throw new ModelNotFoundException();
        //     //return redirect('/');
        //     //abort(404);
        // }
        // $documents = YamlFrontMatter::parseFile($path);

        //return cache()->remember("posts.{$slug}", 5, fn() => $documents->body(),$documents->title); # save in cache for 5 secs 
        
        //return cache()->remember("posts.{$slug}", 5, fn() => New Post($documents->title,$documents->slug,$documents->body()));
        
        /*
        $post = cache()->remember("posts.{$slug}", 5, function() use($path) # save in cache for 5 secs 
        {
            //var_dump('file_get_contents');
            return file_get_contents($path);
        });
        */
       return static::all()->firstWhere('slug',$slug);
    }

    public static function all()
    {
        /*
        $files = File::files(resource_path("posts/"));
        
        return array_map(function($_file){
            return $_file->getContents();
        }, $files);
          */
          

          //using array map
          /*
          $files_in_posts = File::files(resource_path("posts"));
            
            $posts = array_map(function($document){

                $documents = YamlFrontMatter::parseFile($document);
                return New Post(
                    $documents->title,
                    $documents->slug,
                    $documents->body(),
                );

            },$files_in_posts);
            
          

          return $posts; 

            */
            //check cache run in terminal
            //php artisan tinker
            //cache('anything')
            //after adding new post run
            //cache()->forget('anything')
            return cache()->rememberForever('anything', function () {
                $files = File::files(resource_path("posts/"));
                return collect($files)
                ->map(fn($file)=>YamlFrontMatter::parseFile($file))
                ->map(fn($document)=>new Post(
                    $document->title,
                    $document->slug,
                    $document->body(),
                    $document->date
                ))
                ->sortByDesc('date');    
            });
            

    }
}