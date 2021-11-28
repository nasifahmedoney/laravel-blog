<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    //accessor
    // public function getUsernameAttribute($username)
    // {
    //     return ucwords($username); //camel case while rerieving from database
    // }

    //using mutators
    public function setPasswordAttribute($password) //naming convension set (Attributename) Attribute ->Password,Username,Name ->not case sensative
    {
        $this->attributes['password'] = bcrypt($password);
    }
    /**
     * The attributes that should be cast.
     *
     * @var array
     */

    protected $guarded = [];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
