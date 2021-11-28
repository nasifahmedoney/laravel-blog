<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:users,username', //unique:users,username ->users table,username col 
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:7|max:255'
            //'password' => ['required', 'min:7', 'max:255']
            
            //equalvalent
            //'username' => 'required|unique:users,username'
            //'username' => ['required', Rule::unique('users','username')]
        ]);

        //option 1
        //$attributes['password'] = bcrypt($attributes['password']);

        //option 2
        // User::create([
        //     'name' => $attributes['name'],
        //     'password' => bcrypt($attributes['password']),
        // ]);

        //option 3 using mutators in User model 

        User::create($attributes);

        return redirect('/')->with('success','your account has been created.');
    }
}
