<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['category','author'];

    //protected $fillable = ['title','excerpt','body','slug','category_id']; #mass assignment only these fields
    //protected $guarded = ['id']; #mass assignment except these fields

    
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, fn($query,$search)=>
            $query
                ->where('title', 'like', '%'.$search.'%')
                ->orWhere('body', 'like', '%'.$search.'%')
            );
            // alternative
        $query->when($filters['category'] ?? false, fn($query,$category)=>
            $query
                ->whereHas('category', fn($query)=>
                    $query->where('slug',$category)
                )
            );
        $query->when($filters['author'] ?? false, fn($query,$author)=>
            $query
                ->whereHas('author', fn($query)=>
                    $query->where('username',$author)
                )
            );
            //use this
            // $query->when($filters['category'] ?? false, fn($query,$category)=>
            // $query
            //     ->whereExists(fn($query)=>
            //         $query->from('categories')
            //         ->whereColumn('categories.id', 'posts.category_id')
            //         ->where('categories.slug',$category)
            //     )
            // );             
    }

    public function category()
    {
        //hasOne,hasMany,belongsTo,belongsToMany
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this-> belongsTo(User::class,'user_id');
    }
}
