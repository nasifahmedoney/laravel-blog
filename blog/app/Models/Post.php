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

    public function __construct($title,$slug,$body)
    {
        $this->title = $title;
        $this->slug = $slug;
        $this->body = $body;        
    }



    public static function find($slug)
    {
        $path = resource_path("/posts/{$slug}.html"); #path to the file
        
        if(!file_exists($path)) #redirect or abort if file not found
        {
            throw new ModelNotFoundException();
            //return redirect('/');
            //abort(404);
        }
        $documents = YamlFrontMatter::parseFile($path);

        //return cache()->remember("posts.{$slug}", 5, fn() => $documents->body(),$documents->title); # save in cache for 5 secs 
        
        return cache()->remember("posts.{$slug}", 5, fn() => New Post($documents->title,$documents->slug,$documents->body()));
        
        /*
        $post = cache()->remember("posts.{$slug}", 5, function() use($path) # save in cache for 5 secs 
        {
            //var_dump('file_get_contents');
            return file_get_contents($path);
        });
        */
       
    }

    public static function all()
    {
        /*
        $files = File::files(resource_path("posts/"));
        
        return array_map(function($_file){
            return $_file->getContents();
        }, $files);
          */
          
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



    }
}