<?php

namespace App\Http\Controllers;

use App\Models\TennantForm;
use Illuminate\Http\Request;

class tennantController extends Controller
{
    public function tennants(){
        $otherData = [
            'headers' => [
                'Tennant',
                'Appartment',
                'Starting Date',
                'Amount Paid',
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
        return view('pages.tennants', ['tableData' => $otherData]);
    }

    public function save(Request $request){
        $validatedData = $request->validate([
            'tenant_name' => 'required|string|max:255',
            'house' => 'required|string|max:1',
            'apartment_number' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'amount' => 'required|numeric',
        ]);
    
        $tenant = TennantForm::create($validatedData);
    
        return redirect()->back()->with('success', 'Tenant added successfully');
    }
    
}
