@extends('layout')

@section('content')
<div class="flex flex-col min-h-screen bg-gray-50">
    <!-- Main Content -->
    <div class="flex-1 p-6">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-10">
                <h2 class="text-3xl md:text-4xl font-extrabold text-indigo-900">Finances Overview</h2>
                <p class="mt-2 text-lg md:text-xl text-gray-600">A comprehensive view of all tenant amounts</p>
            </div>

            <!-- Chart Section -->
           <!-- Chart Section -->
           <div class="bg-white shadow-md rounded-lg p-6 mb-10">
            <canvas class="w-full h-64" id="yearlyFinancesChart"></canvas>
        </div>

            <!-- Table Section -->
            <div class="bg-white shadow-lg rounded-lg p-6 mb-10">
                <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 md:mb-0">Tenant Details</h3>
                    <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2 w-full md:w-auto">
                        <input type="text" id="search" class="border border-gray-300 rounded p-2 w-full md:w-64" placeholder="Search tenants...">
                        <div class="flex space-x-2">
                            <select id="filterHouse" class="border border-gray-300 rounded p-2">
                                <option value="">All Houses</option>
                                <option value="A">House A</option>
                                <option value="B">House B</option>
                                <option value="C">House C</option>
                                <option value="S">House S</option>
                            </select>
                            <button id="sortButton" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition duration-300">
                                Sort by Amount
                            </button>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto">
                        <thead class="bg-indigo-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-medium text-indigo-900">Tenant Name</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-indigo-900">House</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-indigo-900">Duration</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-indigo-900">Amount Paid</th>
                            </tr>
                        </thead>
                        <tbody id="tenantTable" class="bg-white divide-y divide-gray-200">
                            @foreach($tennants as $tennant)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-4 py-3 text-sm text-gray-900">{{ $tennant->tenant_name }}</td>
                                <td class="px-4 py-3 text-sm text-gray-500">{{ $tennant->house }}</td>
                                <td class="px-4 py-3 text-sm text-gray-500">
                                    @if($tennant->duration == 12)
                                        1 year
                                    @elseif($tennant->duration == 24)
                                        2 years
                                    @else
                                        {{ $tennant->duration }} months
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-500">{{ number_format($tennant->amount, 2) }} GHC</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div id="noResults" class="text-center py-4 text-gray-500 hidden">No matching results found.</div>
            </div>

            <!-- Total Amount Section -->
            <div class="flex justify-end items-center space-x-2 bg-white shadow-lg rounded-lg p-6 mb-10">
                <span class="text-sm font-medium text-gray-500">Total Amounts:</span>
                <span class="text-2xl font-bold text-indigo-700">{{ number_format($totalAmounts, 2) }} GHC</span>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-white text-center p-4 mt-auto" style="background-color: #012561">
        <p>&copy; {{ date('Y') }} Blankson Obeng Designs. All rights reserved.</p>
    </footer>
</div>
<style>
    .chart-container {
        position: relative;
        height: 300px;
        width: 100%;
        max-width: 800px;
        margin: 0 auto;
    }
    </style>
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
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        callbacks: {
                            label: function(tooltipItem) {
                                return `${tooltipItem.label}: ${tooltipItem.raw} GHC`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            font: {
                                size: 12,
                                family: "'Roboto', sans-serif",
                                weight: 400
                            },
                            color: '#6B7280'
                        },
                        grid: {
                            color: '#E5E7EB'
                        }
                    },
                    x: {
                        ticks: {
                            font: {
                                size: 12,
                                family: "'Roboto', sans-serif",
                                weight: 400
                            },
                            color: '#6B7280'
                        },
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    
    // Table Functionality
    const tenantTable = document.getElementById('tenantTable');
    const searchInput = document.getElementById('search');
    const sortButton = document.getElementById('sortButton');
    const filterHouse = document.getElementById('filterHouse');
    const noResults = document.getElementById('noResults');

    function filterTable() {
        const filter = searchInput.value.toLowerCase();
        const houseFilter = filterHouse.value;
        const rows = tenantTable.getElementsByTagName('tr');
        let visibleRows = 0;

        for (let row of rows) {
            const cells = row.getElementsByTagName('td');
            let match = false;
            if (cells.length > 0) {
                const house = cells[1].textContent;
                if ((houseFilter === '' || house === houseFilter) &&
                    (cells[0].textContent.toLowerCase().includes(filter) || 
                     cells[1].textContent.toLowerCase().includes(filter) || 
                     cells[2].textContent.toLowerCase().includes(filter) || 
                     cells[3].textContent.toLowerCase().includes(filter))) {
                    match = true;
                    visibleRows++;
                }
            }
            row.style.display = match ? '' : 'none';
        }

        noResults.style.display = visibleRows === 0 ? 'block' : 'none';
    }

    searchInput.addEventListener('input', filterTable);
    filterHouse.addEventListener('change', filterTable);

    let sortAscending = true;
    sortButton.addEventListener('click', function() {
        const rows = Array.from(tenantTable.getElementsByTagName('tr'));
        const headerRow = rows.shift(); // Remove and store the header row

        rows.sort((a, b) => {
            const amountA = parseFloat(a.cells[3].textContent.replace(/[^0-9.-]+/g,""));
            const amountB = parseFloat(b.cells[3].textContent.replace(/[^0-9.-]+/g,""));
            return sortAscending ? amountA - amountB : amountB - amountA;
        });

        sortAscending = !sortAscending;
        sortButton.textContent = `Sort by Amount (${sortAscending ? 'Asc' : 'Desc'})`;

        tenantTable.innerHTML = '';
        tenantTable.appendChild(headerRow); // Add the header row back
        rows.forEach(row => tenantTable.appendChild(row));
    });
});
</script>
@endsection