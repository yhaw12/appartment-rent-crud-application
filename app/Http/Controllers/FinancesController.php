<!--  <?php

// namespace App\Http\Controllers;

// use App\Models\Tennants;
// use Illuminate\Http\Request;

// class FinancesController extends Controller
// {
    // public function getFinancialData() {
        // Retrieve all tenants and their associated houses & amounts
        // $tenants = Tennants::with(['house', 'amount'])->get();
      
        // Initialize arrays to store financial data
        // $financialDataByHouse = [];
        // $overallTotalIncome = 0;
      
        // foreach ($tenants as $tenant) {
          // Calculate individual tenant's income
        //   $tenantIncome = $tenant->->sum('amount');
          
          // Add income to corresponding house or initialize if not present yet
        //   if (!isset($financialDataByHouse[$tenant->house->letter])) {
            // $financialDataByHouse[$tenant->house->letter] = ['house' => $tenant->house->letter, 'total_income' => 0];
          
        //   $financialDataByHouse[$tenant->house->letter]['total_income'] += $tenantIncome;
          
          // Accumulate overall total income
        //   $overallTotalIncome += $tenantIncome;
        // }
      
        // return compact('financialDataByHouse', 'overallTotalIncome');
    //   }
// } -->
