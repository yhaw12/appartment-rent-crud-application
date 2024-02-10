<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    
    public function dashboard(){
                
        // Dashboard Cards data Object
        $menus = [
            [
                'name'=> 'Total Occupied',
                'total'=> '7',
                'icon'=> 'fas fa-users',
                'color'=>'bg-blue-500'
            ],
            [
                'name'=> 'Total Empty',
                'total'=> '8',
                'icon'=> 'fas fa-bed',
                'color'=>'bg-blue-500'
            ],
            [
                'name'=> 'Total Renting soon',
                'total'=> '9',
                'icon'=> 'fas fa-clock',
                'color'=>'bg-blue-500'
            ],
            [
                'name'=> 'Total Rooms',
                'total'=> '9',
                'icon'=> 'fas fa-door-open',
                'color'=>'bg-blue-500'
            ],
        ];
        // DataTable Array
        $tableData = [
            'headers' => [
                'Tennant',
                'Appartment',
                'Starting Date',
                'Status'
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
        return view('dashboard', [
            'menus' => $menus,'tableData' => $tableData
        ]);
    }
}
