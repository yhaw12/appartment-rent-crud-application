<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(){
        return view('login');
    }
    // login in new user
    public function show(Request $request){
        $formFeilds = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required',
        ]);

        if (auth()->attempt($formFeilds)){
            $request->session->regenerate();

            return redirect('/register')->with('message', 'You are now logged IN');
        }
        return back()->withErrors(['email'=> 'Inavlid Credentials'])->onlyInput('email');
    }
}
