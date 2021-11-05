<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    //protected $fillable = ['title','excerpt','body','slug','category_id'];
    //protected $guarded = ['id']; #opposite of fillable


    public function category()
    {
        //hasOne,hasMany,belongsTo,belongsToMany
        return $this->belongsTo(Category::class);
    }
}
