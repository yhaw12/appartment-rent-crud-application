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
        $durationMonths = $durationMapping[$formFeilds['duration']];
    
        // Calculate end date based on selected duration
        $endDate = Carbon::parse($formFeilds['start_date'])->addMonths($durationMonths)->toDateString();
    
        // Add the end_date to the form fields array before creating the tenant
        $formFeilds['end_date'] = $endDate;
    
        Tennants::create($formFeilds);
    
        // Assuming you're passing this data to a view named 'tenant.index' or similar
        $tennants = Tennants::all(); // Adjust this query as needed
        
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
