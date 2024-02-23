<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Tennants;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        // Calculate the total number of apartments in each house
        $houseA = collect(range(21,   30))->count();
        $houseB = collect(range(1,   12))->count();
        $houseC = collect(range(1,   9))->count();
        $houseS = collect(range(1,   5))->count();

        // Calculate the total number of apartments
        $totalApartments = $houseA + $houseB + $houseC + $houseS;

        // Calculate the total number of occupied apartments
        $totalOccupied = Tennants::whereNotNull('tenant_name')->count();

        // Calculate the total number of vacant apartments
        $totalVacant = $totalApartments - $totalOccupied; 

        // Calculate the total number of tenants whose rent is about to expire within the next  3 months
        $expiringSoon = Tennants::where('duration', '<=', Carbon::now()->addMonths(3))
            ->where('duration', '>', Carbon::now())
            ->count();

        // Dashboard Cards data Object
        $menus = [
            [
                'name' => 'Total Occupied',
                'total' => $totalOccupied,
                'icon' => 'fas fa-users',
                'color' => 'bg-green-500'
            ],
            [
                'name' => 'Total Empty',
                'total' => $totalVacant,
                'icon' => 'fas fa-bed',
                'color' => 'bg-red-500'
            ],
            [
                'name'=> 'Total Renting soon',
                'total'=> $expiringSoon,
                'icon'=> 'fas fa-clock',
                'color'=>'bg-yellow-500'
            ],
            [
                'name' => 'Total Apartments',
                'total' => $totalApartments,
                'icon' => 'fas fa-door-open',
                'color' => 'bg-blue-500'
            ],
        ];

        // DataTable Array
        $tennants = Tennants::all();
        $tableData = [
            'headers' => [
                'Tennant',
                'House',
                'Appartment',
                'Ending Date',
                'Status'
            ],
            'rows' => []
        ];

        foreach ($tennants as $tennant) {
            $status = $tennant->duration <= $tennant->start_date  ? 'Expiring' : 'New';
            $statusColor = $status === 'Expiring' ? 'bg-red-500' : 'bg-green-500';        
            $tableData['rows'][] = [
                'id' => $tennant->id,
                'tenant_name' => $tennant->tenant_name,
                'house' => $tennant->house,
                'appartment' => $tennant->appartment,
                'duration' => $tennant->duration,
                'status' => $status,
            ];
        }

        return view('dashboard', [
            'menus' => $menus, 'tableData' => $tableData
        ]);
    }
}
