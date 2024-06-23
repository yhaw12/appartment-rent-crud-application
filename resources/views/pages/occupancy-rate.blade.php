@extends('layout')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Yearly Occupancy Rate Report</h1>

    <div class="bg-gray-100 shadow-md rounded-lg mb-6 p-6">
        <form method="GET" action="{{ route('occupancy-rate') }}" id="report-form" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label for="start_year" class="block text-sm font-medium text-gray-700">Start Year:</label>
                <input type="number" name="start_year" id="start_year" value="{{ $startYear }}" min="2000" max="{{ date('Y') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label for="end_year" class="block text-sm font-medium text-gray-700">End Year:</label>
                <input type="number" name="end_year" id="end_year" value="{{ $endYear }}" min="2000" max="{{ date('Y') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label for="house_filter" class="block text-sm font-medium text-gray-700">Filter by House:</label>
                <select name="house_filter" id="house_filter" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="all">All Houses</option>
                    <option value="A">House A</option>
                    <option value="B">House B</option>
                    <option value="C">House C</option>
                    <option value="S">House S</option>
                </select>
            </div>
            <div class="flex items-end space-x-2">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Generate Report</button>
                <button type="button" id="export-csv" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">Export CSV</button>
            </div>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="md:col-span-2 bg-white shadow-md rounded-lg p-6">
            <canvas id="occupancyChart" width="400" height="200"></canvas>
        </div>
        <div>
            <div class="bg-white shadow-md rounded-lg p-6">
                <h5 class="text-lg font-semibold mb-4 text-gray-800">Summary Statistics</h5>
                <ul id="summary-stats" class="space-y-2">
                    <!-- Summary stats will be populated by JavaScript -->
                </ul>
            </div>
        </div>
    </div>

    <div class="mt-6 bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200" id="occupancy-table">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Year</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">House A</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">House B</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">House C</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">House S</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Overall</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($occupancyData as $data)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $data['year'] }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $data['house_A'] ?? 'N/A' }}%</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $data['house_B'] ?? 'N/A' }}%</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $data['house_C'] ?? 'N/A' }}%</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $data['house_S'] ?? 'N/A' }}%</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @php
                            $validRates = array_filter([$data['house_A'] ?? null, $data['house_B'] ?? null, $data['house_C'] ?? null, $data['house_S'] ?? null]);
                            $average = count($validRates) > 0 ? array_sum($validRates) / count($validRates) : 'N/A';
                        @endphp
                        {{ is_numeric($average) ? round($average, 2) . '%' : $average }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('occupancyChart').getContext('2d');
        const occupancyData = @json($occupancyData);
        const houses = ['A', 'B', 'C', 'S'];

        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: occupancyData.map(data => data.year),
                datasets: [
                    {
                        label: 'House A',
                        data: occupancyData.map(data => data.house_A),
                        borderColor: 'rgb(59, 130, 246)',
                        backgroundColor: 'rgba(59, 130, 246, 0.5)',
                        tension: 0.1
                    },
                    {
                        label: 'House B',
                        data: occupancyData.map(data => data.house_B),
                        borderColor: 'rgb(16, 185, 129)',
                        backgroundColor: 'rgba(16, 185, 129, 0.5)',
                        tension: 0.1
                    },
                    {
                        label: 'House C',
                        data: occupancyData.map(data => data.house_C),
                        borderColor: 'rgb(245, 158, 11)',
                        backgroundColor: 'rgba(245, 158, 11, 0.5)',
                        tension: 0.1
                    },
                    {
                        label: 'House S',
                        data: occupancyData.map(data => data.house_S),
                        borderColor: 'rgb(239, 68, 68)',
                        backgroundColor: 'rgba(239, 68, 68, 0.5)',
                        tension: 0.1
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Yearly Occupancy Rate'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        title: {
                            display: true,
                            text: 'Occupancy Rate (%)'
                        }
                    }
                }
            }
        });

        // Calculate and display summary statistics
        const summaryStats = document.getElementById('summary-stats');
        houses.forEach(house => {
            const rates = occupancyData.map(data => data[`house_${house}`]).filter(rate => rate !== undefined);
            if (rates.length > 0) {
                const avg = rates.reduce((a, b) => a + b, 0) / rates.length;
                const max = Math.max(...rates);
                const min = Math.min(...rates);
                
                const li = document.createElement('li');
                li.className = 'text-sm text-gray-600';
                li.textContent = `House ${house}: Avg ${avg.toFixed(2)}%, Max ${max}%, Min ${min}%`;
                summaryStats.appendChild(li);
            }
        });

        // Export to CSV functionality
        document.getElementById('export-csv').addEventListener('click', function() {
            let csvContent = "data:text/csv;charset=utf-8,";
            csvContent += "Year,House A,House B,House C,House S,Overall\n";
            
            occupancyData.forEach(function(data) {
                const validRates = [data.house_A, data.house_B, data.house_C, data.house_S].filter(rate => rate !== undefined);
                const overall = validRates.length > 0 ? (validRates.reduce((a, b) => a + b, 0) / validRates.length).toFixed(2) : 'N/A';
                csvContent += `${data.year},${data.house_A ?? 'N/A'},${data.house_B ?? 'N/A'},${data.house_C ?? 'N/A'},${data.house_S ?? 'N/A'},${overall}\n`;
            });

            const encodedUri = encodeURI(csvContent);
            const link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", "yearly_occupancy_report.csv");
            document.body.appendChild(link);
            link.click();
        });

        // House filter functionality
        document.getElementById('house_filter').addEventListener('change', function() {
            const selectedHouse = this.value;
            const tableRows = document.querySelectorAll('#occupancy-table tbody tr');
            
            tableRows.forEach(row => {
                if (selectedHouse === 'all') {
                    row.classList.remove('hidden');
                } else {
                    const houseCell = row.querySelector(`td:nth-child(${houses.indexOf(selectedHouse) + 2})`);
                    if (houseCell.textContent !== 'N/A%') {
                        row.classList.remove('hidden');
                    } else {
                        row.classList.add('hidden');
                    }
                }
            });

            // Update chart visibility
            chart.data.datasets.forEach((dataset, index) => {
                const meta = chart.getDatasetMeta(index);
                meta.hidden = selectedHouse !== 'all' && dataset.label !== `House ${selectedHouse}`;
            });
            chart.update();
        });
    });
</script>
@endsection
