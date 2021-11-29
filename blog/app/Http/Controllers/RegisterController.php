<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            //'username' => ['required', Rule::unique('users','username')] //used with conditions Rule::unique('users','username')->ignore something
        ]);

        //option 1
        //$attributes['password'] = bcrypt($attributes['password']);

        //option 2
        // User::create([
        //     'name' => $attributes['name'],
        //     'password' => bcrypt($attributes['password']),
        // ]);

        //option 3 using mutators in User model 

        $user = User::create($attributes);
        
        //login the user created
        Auth::login($user);
        
        
        return redirect('/')->with('success','your account has been created.');
    }
}
