<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function post()//post_id
    {
        return $this-> belongsTo(Post::class);//comment belongs to a post
    }

    public function author()//author_id->user_id
    {
        return $this-> belongsTo(User::class,'user_id');//comment belongs to an author,author is in User,'user_id'
    }
}

