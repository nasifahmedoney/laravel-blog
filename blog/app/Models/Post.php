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


    //$query->when($filters['search'] ?? false, fn($query, $search)=>

    public function scopeFilter($query, array $filters)
    {
        if( $filters['search'] ?? false) //using array, null safe function
        {
            $query
                ->where('title', 'like', '%'.request('search').'%')
                ->orWhere('body', 'like', '%'.request('search').'%');
        }
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
