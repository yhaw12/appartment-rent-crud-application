<?php

namespace App\Http\Controllers;

use App\Models\Tennants;
use Illuminate\Http\Request;

class tennantController extends Controller
{
    public function tennants()
    {
        $tennants = Tennants::all();

        $tableData = [
            'headers' => [
                'Tennant',
                'House',
                'Ending Date',
                'Amount Paid',
                'Status',
                'Action'
            ],
            'rows' => []
        ];
        // pull the start date from the db
    
        foreach ($tennants as $tennant) {
            $status = $tennant->end_date <= $tennant->start_date  ? 'Expiring' : 'New';
            $statusColor = $status === 'Expiring' ? 'bg-red-500' : 'bg-green-500';        
            $tableData['rows'][] = [
                'tenant_name' => $tennant->tenant_name,
                'house' => $tennant->house,
                'end_date' => $tennant->end_date,
                'amount' => $tennant->amount,
                'status' => 'Active', // Replace with actual status logic
                'action' => '', // Define action buttons
            ];
        }
        return view('pages.tennants', ['tableData' => $tableData]);
    }

    public function save(Request $request){
        $formFeilds = $request->validate([
            'tenant_name' => 'required|string|max:255',
            // 'property_type' => 'required|string|in:house,apartment',
            // 'property_number' => 'nullable|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'amount' => 'requsired|numeric',
        ]);

        dd($formFeilds);
    
        $tennant = Tennants::create($formFeilds);
    
        return  redirect()->back()->with('success', 'Tenant added successfully');
    }
    
}
