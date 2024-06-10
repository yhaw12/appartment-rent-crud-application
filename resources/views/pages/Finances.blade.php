@extends('layout')

@section('content')
<div class="h-screen w-full "> 
    <div class="h-full w-full mx-auto px-4 sm:px-6 lg:px-8 max-w-3xl">
        <div class="text-center mb-6">
            <h2 class="text-2xl md:text-3xl font-extrabold text-indigo-900">Finances Overview</h2>
            <p class="mt-1 text-sm md:text-lg text-gray-600">A comprehensive view of all tenant amounts.</p>
        </div>

        <canvas class="w-full h-32 md:h-40" id="yearlyFinancesChart"></canvas>

        <div class="mt-16 max-h-96 ">
            <div class="shadow border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-indigo-100">
                        <tr>
                            <th scope="col" class="px-4 py-2 text-xs md:text-sm font-medium text-indigo-900 uppercase tracking-wider">Tenant Name</th>
                            <th scope="col" class="px-4 py-2 text-xs md:text-sm font-medium text-indigo-900 uppercase tracking-wider">House</th>
                            <th scope="col" class="px-4 py-2 text-xs md:text-sm font-medium text-indigo-900 uppercase tracking-wider">Duration</th>
                            <th scope="col" class="px-4 py-2 text-xs md:text-sm font-medium text-indigo-900 uppercase tracking-wider">Amount Paid</th>
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
                                <div class="text-xs md:text-sm text-gray-500">
                                    @if($tenant->duration == 12)
                                        1 year
                                    @elseif($tenant->duration == 24)
                                        2 years
                                    @else
                                        {{ $tenant->duration }} months
                                    @endif
                                </div>
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

        <div class="mt-8 mb-32 flex justify-end">
            <span class="text-sm font-medium text-gray-500">Total Amounts: </span>
            <span class="ml-2 mb-12 text-lg font-semibold text-indigo-700">{{ $totalAmounts }}</span>
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
                backgroundColor: 'rgba(99, 102, 241, 0.2)',
                borderColor: 'rgba(99, 102, 241, 1)',
                borderWidth: 1,
                hoverBackgroundColor: 'rgba(99, 102, 241, 0.4)',
                hoverBorderColor: 'rgba(99, 102, 241, 1)',
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: 'Yearly Finances Overview',
                font: {
                    size: 16,
                    family: "'Roboto', sans-serif",
                    weight: 700
                },
                color: '#374151'
            },
            tooltips: {
                mode: 'index',
                intersect: false,
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
                        beginAtZero: true,
                        font: {
                            size: 10,
                            family: "'Roboto', sans-serif",
                            weight: 400
                        },
                        color: '#6B7280'
                    },
                    gridLines: {
                        display: true,
                        color: '#E5E7EB'
                    }
                }],
                xAxes: [{
                    ticks: {
                        font: {
                            size: 10,
                            family: "'Roboto', sans-serif",
                            weight: 400
                        },
                        color: '#6B7280'
                    },
                    gridLines: {
                        display: false
                    }
                }]
            },
            legend: {
                display: false
            }
        }
    });
});
</script>
@endsection
