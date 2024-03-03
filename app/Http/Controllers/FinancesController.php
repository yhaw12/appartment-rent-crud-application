<?php

namespace App\Http\Controllers;

use App\Models\Tennants;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FinancesController extends Controller
{
    public function getFinancialData(Request $request)
    {
        $query = Tennants::query();
    
        if ($request->has('search')){
            $query->where('tenant_name', 'like', '%' . $request->search . '%')
                 ->orWhere('house', 'like', '%' . $request->search . '%');
        }
    
        // Adjust the query to include all records for total calculation
        $totalAmounts = $query->sum('amount');
        $tennants = $query->paginate(15);
    
        // Prepare data for the chart
        $year = Carbon::now()->year;
        $months = [];
        $totals = [];
    
        for ($month = 1; $month <= 12; $month++) {
            $startOfMonth = Carbon::create($year, $month, 1);
            $endOfMonth = $startOfMonth->copy()->endOfMonth();
    
            // Assuming 'created_at' is the correct field to use for calculating monthly totals
            $totalForMonth = Tennants::whereBetween('created_at', [$startOfMonth, $endOfMonth])->sum('amount');
    
            $months[] = $startOfMonth->format('M');
            $totals[] = $totalForMonth;
        }

        return view('pages.finances', compact('tennants', 'totalAmounts', 'months', 'totals'));
    }
}
