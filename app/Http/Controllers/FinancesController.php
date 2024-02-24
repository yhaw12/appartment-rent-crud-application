<?php

namespace App\Http\Controllers;

use App\Models\Tennants;

class FinancesController extends Controller
{
    public function getFinancialData()
    {
        // Get the tenant names from the database
        $tenants = Tennants::pluck('tenant_name')->unique()->toArray();

        // Get the total amount paid by each tenant
        $totals = [];
        foreach ($tenants as $tenant) {
            $totals[$tenant] = Tennants::where('tenant_name', $tenant)->sum('amount');
        }

        // Get the average amount paid per house
        $houses = ['A', 'B', 'C', 'S'];
        $averages = [];
        foreach ($houses as $house) {
            $averages[$house] = Tennants::where('house', $house)->avg('amount');
        }

        // Get the chart data
        $data = Tennants::pluck('amount')->toArray();

        return view('pages.Finances', [
            'tenants' => $tenants,
            'totals' => $totals,
            'houses' => $houses,
            'averages' => $averages,
            'data' => $data,
        ]);
    }
}
