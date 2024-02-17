<?php

namespace App\Http\Controllers;

use App\Models\Tennants;
use Illuminate\Http\Request;

class tennantController extends Controller
{
    public function tennants()
    {
        $tennants = Tennants::all();

        $otherData = [
            'headers' => [
                'Tennant',
                'House',
                'Ending Date',
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

                
            ]
        ];
        return view('pages.tennants', ['tableData' => $otherData]);
    }

    public function save(Request $request){
        $formFeilds = $request->validate([
            'tenant_name' => 'required|string|max:255',
            'house' => 'required|string|in:A,B,C,S',
            'appartment_number' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'amount' => 'required|numeric|min:1',
        ]);

        dd($formFeilds);
    
        $tenant = Tennants::create($formFeilds);
    
        return redirect()->back()->with('success', 'Tenant added successfully');
    }
    
}
