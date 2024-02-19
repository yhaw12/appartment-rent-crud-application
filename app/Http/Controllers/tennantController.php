<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
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
                'status' => "<span class='$statusColor'>$status</span>",
                'action' => "<a href='#' class='text-blue-600 underline'>Update</a>" . " | " . "<a href='#' class='text-red-600 underline'>Delete</a>",
            ];
        }
        return view('pages.tennants', ['tableData' => $tableData]);
    }

    public function store(Request $request){

        try{
            $formFeilds = $request->validate([
                'tenant_name' => 'required|string|max:255',
                'house' => 'required|string|in:A,B,C,S',
                'appartment' => 'nullable|integer|min:1|max:99',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after:start_date',
                'amount' => 'required|numeric|min:0',
            ]);
    
            // dd($formFeilds);
    
            // check for existing customer
            $existingTenant = Tennants::where(['house' => $formFeilds['house'], 'appartment' => $formFeilds['appartment']])
             ->whereBetween('end_date', [$formFeilds['start_date'], $formFeilds['end_date']])
             ->count();
    
            // if (!empty($existingTenant)) {
            //  return redirect()->back()->withErrors(['apartment' => 'The selected apartment is currently occupied between the given dates. Please select different dates or choose a vacant apartment.']);
            // }
            if ($existingTenant > 0) {
                throw new \Exception('The selected apartment is currently occupied between the given dates. Please select different dates or choose a vacant apartment.');
            }
        
        
            Tennants::create($formFeilds);
        
            return  redirect()->back()->with('success', 'Tenant added successfully');
        } catch (\Throwable $th) {
            // Redirect back with error message
            return redirect()->back()->with('error', $th->getMessage());
        }
        
    }
    
}
