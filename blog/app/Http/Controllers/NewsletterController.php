<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Services\Newsletter;


class NewsletterController extends Controller
{
    public function __invoke(Newsletter $newsletter)
    {
        request()->validate([
            'email' => 'required|email'
        ]);//required, of type 'email'
        
        try{
            
            $newsletter->subscribe(request('email'));
        }
        catch(Exception $e){
            throw ValidationException::withMessages([
                'email' => 'Cant add to email list'
            ]);
        }
        
        //ddd($response);
        return redirect('/')->with('success','Subscribed!');
    }
}
