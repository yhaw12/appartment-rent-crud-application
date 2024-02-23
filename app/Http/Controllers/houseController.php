<?php

namespace App\Http\Controllers;

use App\Models\Tennants;
use Illuminate\Http\Request;

class houseController extends Controller
{
    // ... other methods ...

public function houseA(){
    $house = 'A';
    $appartmentsA = collect(range(21,   30))->map(function($number) use ($house){
        $tenant = Tennants::where('house', $house)->where('appartment', $number)->first();
        $status = 'vacant';
        if ($tenant) {
            $status = 'occupied';
        }
        return (object) [
            'house'=> $house,
            'number' => $number,
            'status' => $status,
            'tenant' => $tenant, // Make sure to include the tenant object
            // Add other properties as needed
        ];
    });
    return view('pages.houseA', ['appartments'=>$appartmentsA]);
}

// ... other methods ...


    // house B appartments
    public function houseB(){

        $house = 'B';    
        $appartmentsB = collect(range(1,   12))->map(function($number) use ($house){
            $tenant = Tennants::where('house', $house)->where('appartment', $number)->first();
            $status = 'vacant';
            if ($tenant) {
                $status = 'occupied';
            }
            return (object) [
                'house'=> $house,
                'number' => $number,
                'status' => $status,
                'tenant' => $tenant, // Make sure to include the tenant object
                // Add other properties as needed
            ];
        });
        //  dd($appartments);


    return view('pages.houseB', ['appartments'=>$appartmentsB]);
    }

    // house C appartments
    public function houseC(){

        $house = 'C';
        
    
        $appartmentsC = collect(range(1,   9))->map(function($number) use ($house){
            $tenant = Tennants::where('house', $house)->where('appartment', $number)->first();
            $status = 'vacant';
            if ($tenant) {
                $status = 'occupied';
            }
            return (object) [
                'house'=> $house,
                'number' => $number,
                'status' => $status,
                'tenant' => $tenant, // Make sure to include the tenant object
                // Add other properties as needed
            ];
        });
        //  dd($appartments);


    return view('pages.houseC', ['appartments'=>$appartmentsC]);
    }

    // STORES
    public function houseS(){

        $house = 'S';
        
    
        $stores = collect(range(1,   6))->map(function($number) use ($house){
            $tenant = Tennants::where('house', $house)->where('appartment', $number)->first();
            $status = 'vacant';
            if ($tenant) {
                $status = 'occupied';
            }
            return (object) [
                'house'=> $house,
                'number' => $number,
                'status' => $status,
                'tenant' => $tenant, // Make sure to include the tenant object
                // Add other properties as needed
            ];
        });
        //  dd($appartments);


    return view('pages.stores', ['stores'=>$stores]);
    }


    public function getTenant($house, $number) {
        $tenant = Tennants::where('house', $house)->where('appartment', $number)->first();
        return response()->json($tenant);
    }
    
}
