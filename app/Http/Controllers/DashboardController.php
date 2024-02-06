<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //Load Dashboard Page
    public function dashboard(){
        return view('components.dashboard');
    }
}
