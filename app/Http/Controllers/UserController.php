<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    //Load the SignUp Page
    public function create(){
        return view('register');
    }
    //Load the Login Page
    public function login(){
        return view('login');
    }

    // Submit the SignUp Form
    public function store(Request $request){
        // validate the inputs
        $formFeilds = $request->validate([
            'name' => 'required|max:100|min:3',
            'email' => 'required|unique:users|email|max:255|email',
            'password'=> 'required|confirmed|min:5'
        ]);
        // Hash the paswword
        $formFeilds['password'] = bcrypt($formFeilds['password']);

        // create User
        $user = User::create($formFeilds);

        auth()->login($user);

        return redirect('/login')->with('success', 'You are Signed Up');
    }
    

    // Retrieve the Login User

    public function show(Request $request){
         // validate the inputs
        $formFeilds = $request->validate([
            'email' => 'required|max:255',
            'password'=> 'required|min:5'
        ]);

        if (auth()->attempt($formFeilds)){
            $request->session->regenerate();
            
            return redirect('/register')->with('message', 'You are LoggedIn');
        }

        return back()->withErrors(['email'=> 'Inavlid Credentials'])->onlyInput('email');
    }

    public function logout(Request $request){
        
    }





}
