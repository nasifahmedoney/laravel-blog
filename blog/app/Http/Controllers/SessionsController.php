<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }
    public function destroy()
    {
        Auth::logout();

        return redirect('/')->with('success', 'bye');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => 'required',
            'password' => 'required' 
        ]);

        //auth()= Auth::, check(),login(),logout(), auth()->guest
        //attempt()->login and start session automatically if ok
        if(Auth::attempt($attributes)) 
        {
            session()->regenerate();
            return redirect('/')->with('success', 'login successful');
        }

        throw ValidationException::withMessages([
            'email' => 'your provided credentials could not be varified'
        ]);

    }
}
