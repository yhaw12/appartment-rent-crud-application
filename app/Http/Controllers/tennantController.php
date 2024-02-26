<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Tennants;
use Illuminate\Http\Request;

class tennantController extends Controller
{

public function store(Request $request)
{
    $formFeilds = $request->validate([
        'tenant_name' => 'required|string|max:255',
        'house' => 'required|string|in:A,B,C,S',
        'appartment' => 'nullable|integer|min:1|max:99',
        'start_date' => 'required|date',
        'duration' => 'required|string|in:3/12,6/12,12,24',  
        'amount' => 'required|numeric|min:0',
    ]);

    // Convert the selected option to the corresponding number of months
    $durationMapping = [
        '3/12' =>   3,
        '6/12' =>   6,
        '12' =>   12,
        '24' =>   24,
    ];
    $formFeilds['duration'] = $durationMapping[$formFeilds['duration']];

    // Calculate end date based on selected duration
    $endDate = Carbon::parse($formFeilds['start_date'])->addMonths($formFeilds['duration'])->toDateString();

    // Check for existing customer
    $existingTenant = tennants::where(['house' => $formFeilds['house'], 'appartment' => $formFeilds['appartment']])
        ->whereBetween('start_date', [$formFeilds['start_date'], $endDate])
        ->first();

    if (!empty($existingTenant)) {
        return redirect()->back()->with('error', 'The selected apartment is currently occupied between the given dates. Please select different dates or choose a vacant apartment.');
    }

    // Add the end_date to the form fields array before creating the tenant
    $formFeilds['end_date'] = $endDate;

    Tennants::create($formFeilds);

    return redirect()->back()->with('success', 'Tenant added successfully');
}

        
    // STORE TENNAT FORM DATA
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
            $status = $tennant->duration <= $tennant->start_date  ? 'Expiring' : 'New';
            $statusColor = $status === 'Expiring' ? 'bg-red-500' : 'bg-green-500';        
            $tableData['rows'][] = [
                'id' => $tennant->id,
                'tenant_name' => $tennant->tenant_name,
                'house' => $tennant->house,
                'duration' => $tennant->duration,
                'amount' => $tennant->amount,
                'status' => $status,
                'action' => "Update|Delete",
            ];
        }
        return view('pages.tennants', ['tableData' => $tableData]);
    }


    

        // edit a tennant info
        public function update(Request $request, $id){
            $formFeilds = $request->validate([
                'tenant_name' => 'required|string|max:255',
                'start_date' => 'required|date',
                'duration' => 'required|string|in:3/12,6/12,12,24',
                'amount' => 'required|numeric|min:0',
            ]);
            $tennant = Tennants::findOrFail($id);

            // Update the tenant's attributes
            $tennant->tenant_name = $formFeilds['tenant_name'];
            $tennant->start_date = $formFeilds['start_date'];
            $tennant->duration = $formFeilds['duration'];
            $tennant->amount = $formFeilds['amount'];

            // save the tennant
            $tennant->save();
             // Redirect the user to the tenants list with a success message
            return redirect()->back()->with('success', 'Tenant updated successfully');

        }

        // DELETE TENNAT ID..
        public function destroy($id){
            $tennant = Tennants::findOrFail($id);

            $tennant->delete();

            return redirect()->back()->with('success', 'Tennant deleted successfully');

        }

        
    
}
