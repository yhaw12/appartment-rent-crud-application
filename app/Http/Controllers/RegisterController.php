<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create(){
        return view('register');
    }


    // create New User
    public function store(Request $request){
        $formFeilds = $request->validate([
            'name'=> 'required|max:255|min:3',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        // Hash Password
        $formFeilds['password'] =bcrypt($formFeilds['password']);
        
        //create User 
        $user = User::create($formFeilds);

        auth()->login($user);

        
        return redirect('/login')->with('success', 'Registration successful!');
        

    }
};