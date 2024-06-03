<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Tennants;
use Illuminate\Http\Request;

class tennantController extends Controller
{
    
    public function store(Request $request)
{
    // Validate the incoming request
    $formFields = $request->validate([
        'tenant_name' => 'required|string|max:255|unique:tennants,tenant_name',
        'house' => 'required|string|in:A,B,C,S',
        'appartment' => 'nullable|integer|min:1|max:99',
        'start_date' => 'required|date',
        'duration' => 'required|string|in:3/12,6/12,12,24',
        'amount' => 'required|numeric|min:0',
    ]);

    // Mapping durations to months
    $durationMapping = [
        '3/12' => 3,
        '6/12' => 6,
        '12' => 12,
        '24' => 24,
    ];

    // Calculate the end date based on the start date and duration
    $durationMonths = $durationMapping[$formFields['duration']];
    // $endDate = Carbon::parse($formFields['start_date'])->addMonths($durationMonths);
    $endDate = Carbon::parse($formFields['start_date'])->addMonths($formFields['duration'])->subDay();

    // Check if the selected house and apartment are already occupied
    $occupied = Tennants::where('house', $formFields['house'])
                        ->where('appartment', $formFields['appartment'])
                        ->where('end_date', '>=', Carbon::now())
                        ->exists();

    if ($occupied) {
        return redirect()->back()->withErrors(['The selected house and apartment are already occupied.']);
    }

    // Add the end date to the form fields before creating the tenant
    $formFields['end_date'] = $endDate->toDateString();

    // Double-check that the end_date is in the formFields array
    // dd($formFields);

    // Create the tenant
    Tennants::create($formFields);

    return redirect()->back()->with('success', 'Tenant added successfully');
}

        
    // GET TENNAT DATA FOR TABLE
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
    
        foreach ($tennants as $tennant) {
            // Assuming the duration is stored in a format like '3/12' for  3 months
            $durationMonths = explode('/', $tennant->duration)[0];
            $endDate = Carbon::parse($tennant->start_date)->addMonths($durationMonths)->toDateString();
    
            $status = Carbon::parse($endDate)->lt(Carbon::now()) ? 'Expired' : 'Active';
            // $statusColor = $status === 'Expired' ? 'bg-red-500' : 'bg-green-500';        
    
            $tableData['rows'][] = [
                'id' => $tennant->id,
                'tenant_name' => $tennant->tenant_name,
                'house' => $tennant->house,
                'end_date' => $endDate, 
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
                'tenant_name' => 'required|string|max:255|unique:tennants,tenant_name,' . $id,
                'start_date' => 'required|date',
                'duration' => 'required|string|in:3/12,6/12,12,24',
                'amount' => 'required|numeric|min:0',
            ]);
        
            // Convert the selected option to the corresponding number of months
            $durationMapping = [
                '3/12' => 3,
                '6/12' => 6,
                '12' => 12,
                '24' => 24,
            ];
            $durationMonths = $durationMapping[$formFeilds['duration']];
        
            // Calculate end date based on selected duration
            $endDate = Carbon::parse($formFeilds['start_date'])->addMonths($durationMonths);
        
            // Check if the selected house and apartment are already occupied by another tenant
            $occupied = Tennants::where('house', $formFeilds['house'])
                                    ->where('appartment', $formFeilds['appartment'])
                                    ->where('end_date', '>=', Carbon::now())
                                    ->where('id', '!=', $id) // Exclude the current tenant
                                    ->exists();
        
            if ($occupied) {
                return redirect()->back()->withErrors(['The selected house and apartment are already occupied.']);
            }
        
            $tennant = Tennants::findOrFail($id);
        
            // Update the tenant's attributes
            $tennant->tenant_name = $formFeilds['tenant_name'];
            $tennant->start_date = $formFeilds['start_date'];
            $tennant->duration = $formFeilds['duration'];
            $tennant->amount = $formFeilds['amount'];
            $tennant->end_date = $endDate;
        
            // Save the tenant
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
