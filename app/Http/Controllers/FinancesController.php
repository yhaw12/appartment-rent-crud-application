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
    
        if ($request->has('search')) {
            $query->where('tenant_name', 'like', '%' . $request->search . '%')
                  ->orWhere('house', 'like', '%' . $request->search . '%');
        }
    
        $totalAmounts = $query->sum('amount');
        $tenants = $query->paginate(15);
    
        $year = Carbon::now()->year;
        $months = [];
        $totals = [];
    
        // Initialize totals array with zero values for each month
        for ($month = 1; $month <= 12; $month++) {
            $months[] = Carbon::create($year, $month, 1)->format('M');
            $totals[] = 0;
        }
    
        // Loop through tenants and accumulate totals based on start_date
        foreach ($tenants as $tenant) {
            $startMonth = Carbon::parse($tenant->start_date)->format('M');
            $monthIndex = array_search($startMonth, $months);
    
            if ($monthIndex !== false) {
                $totals[$monthIndex] += $tenant->amount;
            }
        }
    
        return view('pages.finances', compact('tenants', 'totalAmounts', 'months', 'totals'));
    }
    
}
