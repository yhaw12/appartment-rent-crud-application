@extends('layout')

@section('content')
<div class="overflow-auto h-screen">
    <div class="h-auto mx-auto px-4 sm:px-6 lg:px-8 overflow-x-auto container max-w-4xl">
        <div class="text-center mb-8">
            <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900">Finances Overview</h2>
            <p class="mt-1 text-sm md:text-lg text-gray-600">A comprehensive view of all tenant amounts.</p>
        </div>
    
        <canvas class="w-full h-64 md:h-96" id="yearlyFinancesChart"></canvas>
    
        <div class="mt-8 overflow-x-auto">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 py-2 text-xs md:text-sm font-medium text-gray-500 uppercase tracking-wider">Tenant Name</th>
                            <th scope="col" class="px-4 py-2 text-xs md:text-sm font-medium text-gray-500 uppercase tracking-wider">House</th>
                            <th scope="col" class="px-4 py-2 text-xs md:text-sm font-medium text-gray-500 uppercase tracking-wider">Duration</th>
                            <th scope="col" class="px-4 py-2 text-xs md:text-sm font-medium text-gray-500 uppercase tracking-wider">Amount Paid</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($tenants as $tenant)
                        <tr>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="text-xs md:text-sm text-gray-900">{{ $tenant->tenant_name }}</div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="text-xs md:text-sm text-gray-500">{{ $tenant->house }}</div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="text-xs md:text-sm text-gray-500">{{ $tenant->duration }}</div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-xs md:text-sm text-gray-500">
                                {{ $tenant->amount }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    
        <div class="mt-8 flex justify-end">
            <span class="text-sm font-medium text-gray-500">Total Amounts: </span>
            <span class="ml-2 text-lg font-semibold text-gray-700">{{ $totalAmounts }}</span>
        </div>
    </div>
    
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('yearlyFinancesChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($months),
            datasets: [{
                label: 'Total Amounts Received',
                data: @json($totals),
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                hoverBackgroundColor: 'rgba(75, 192, 192, 0.4)',
                hoverBorderColor: 'rgba(75, 192, 192, 1)',
            }]
        },
        options: {
            title: {
                display: true,
                text: 'Yearly Finances Overview',
                fontSize: 14,
                fontColor: '#000'
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var label = data.labels[tooltipItem.index] || '';
                        if (label) {
                            label += ': ';
                        }
                        var total = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                        label += total + ' GHC';
                        return label;
                    }
                }
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
});
</script>
@endsection