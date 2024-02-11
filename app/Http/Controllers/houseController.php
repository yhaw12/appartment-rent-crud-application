<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class houseController extends Controller
{
    public function house(){
        
    
        $appartments = collect(range(1, 12))->map(function($number){
            return (object) [
                'number' => $number,
                'status' => 'vacant', // or 'occupied' based on your logic
                // Add other properties as needed
            ];
        });


    return view('pages.houseA', ['appartments'=>$appartments]);
    // return view('pages.appartmentB', ['tableData' => $otherData]);
    // return view('pages.appartmentC', ['tableData' => $moreData]);

}
}
