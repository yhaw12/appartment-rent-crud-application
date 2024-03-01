@extends('layout')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center">
        <h2 class="text-3xl font-extrabold text-gray-900">Finances Overview</h2>
        <p class="mt-2 text-lg text-gray-600">A comprehensive view of all tenant amounts.</p>
    </div>

    <canvas id="yearlyFinancesChart"></canvas>

    

    <div class="mt-8">
        <label for="search" class="sr-only">Search</label>
        <div class="relative rounded-md shadow-sm">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <span class="text-gray-500 sm:text-sm">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0  0  24  24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21  21l-6-6m2-5a7  7  0  11-14  0  7  7  0  0114  0z"></path>
                    </svg>
                </span>
            </div>
            <input type="search" name="search" id="search" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md" placeholder="Search tenants">
        </div>
    </div>

    <div class="mt-8">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tenant Name
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            House
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Duration
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Amount Paid
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($tennants as $tennant)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $tennant->tenant_name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500">{{ $tennant->house }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500">{{ $tennant->duration }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $tennant->amount }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-8">
        <div class="flex justify-end">
            <span class="text-sm font-medium text-gray-500">Total Amounts: </span>
            <span class="ml-2 text-lg font-semibold text-gray-700">{{ $totalAmounts }}</span>
        </div>
    </div>
</div>
@endsection


<script>
    const ctx = document.getElementById('yearlyFinancesChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($months), // Pass the months array from your controller
            datasets: [{
                label: 'Total Amounts Taken',
                data: @json($totals), // Pass the totals array from your controller
                backgroundColor: 'rgba(75,  192,  192,  0.2)',
                borderColor: 'rgba(75,  192,  192,  1)',
                borderWidth:  1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
