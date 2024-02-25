<?php

namespace App\Http\Controllers;

use App\Models\Tennants;
use Illuminate\Http\Request;

class FinancesController extends Controller
{
    public function getFinancialData(Request $request)
    {
        // Initialize the query builder
        $query = Tennants::query();

        // Apply search/filter if a search term is provided
        if ($request->has('search')) {
            $query->where('tenant_name', 'like', '%' . $request->search . '%')
                  ->orWhere('house', 'like', '%' . $request->search . '%');
        }

        // Apply pagination
        $tennants = $query->paginate(15);

        // Calculate the total amount collected from all tenants
        // Note: This should ideally be calculated from the filtered/searched tenants, not all tenants
        $totalAmounts = $tennants->sum('amount');

        // Pass the data to the view
        return view('pages.finances', compact('tennants', 'totalAmounts'));
    }
}
