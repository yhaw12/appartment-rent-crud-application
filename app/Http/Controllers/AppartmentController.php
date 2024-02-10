<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppartmentController extends Controller
{
    public function appartment(){
        $otherData = [
            'headers' => [
                'Tennant',
                'Appartment',
                'Starting Date',
                'Status',
                'Action'
            ],
            'rows' => [
                [
                    'user' => 'Vera Carpenter',
                    'role' => 'Admin',
                    'created_at' => 'Jan  21,  2020',
                    'status' => 'Active'
                ],
                [
                    'user' => 'Vera Carpenter',
                    'role' => 'Admin',
                    'created_at' => 'Jan  21,  2020',
                    'status' => 'Active'
                ],
                [
                    'user' => 'Vera Carpenter',
                    'role' => 'Admin',
                    'created_at' => 'Jan  21,  2020',
                    'status' => 'Active'
                ],
                
            ]
        ];
        return view('pages.appartmentA', ['tableData' => $otherData]);
        // return view('pages.appartmentB', ['tableData' => $otherData]);
        // return view('pages.appartmentC', ['tableData' => $moreData]);

    }
}
