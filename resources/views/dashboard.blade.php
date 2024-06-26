@extends('layout')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Dashboard Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Property Management Dashboard</h1>
            <p class="text-gray-600 mt-1">Overview of your property occupancy and tenant status.</p>
        </div>

        <!-- Property Statistics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            @foreach ($menus as $menu)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 cursor-pointer"
                     onclick="loadCardData('{{ $menu['name'] }}', {{ $menu['total'] }})"
                     @if($menu['name'] == 'Total Appartments') onclick="event.preventDefault()" @endif>
                    <div class="p-5">
                        <div class="flex items-center justify-between">
                            <div class="{{ $menu['color'] }} w-12 h-12 rounded-full flex items-center justify-center">
                                <i class="{{ $menu['icon'] }} text-white text-xl"></i>
                            </div>
                            <div class="text-right">
                                <p class="text-gray-500 text-sm font-medium uppercase">{{ $menu['name'] }}</p>
                                <p class="text-2xl font-bold text-gray-800">{{ number_format($menu['total']) }}                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Dynamic Content Area -->
        <div id="dynamic-content" class="bg-white rounded-xl shadow-md overflow-hidden mb-8" style="display: none;">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 id="dynamic-content-title" class="text-xl font-semibold text-gray-800"></h2>
            </div>
            <div id="dynamic-content-body" class="p-6">
                <!-- Dynamic content will be inserted here -->
            </div>
        </div>

        <!-- Tenants Table Section -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">Tenants</h2>
                <div class="flex space-x-2">
                    <input type="text" id="search-input" placeholder="Search tenants..." class="px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <select id="status-filter" class="px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="">All Statuses</option>
                        <option value="active">Active</option>
                        <option value="Expiring Soon">Expiring Soon</option>
                        <option value="Expired">Expired</option>
                    </select>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full whitespace-nowrap">
                    <thead>
                        <tr class="" style="background-color: #203c6b">
                            @foreach ($tableData['headers'] as $header)
                                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider cursor-pointer" onclick="sortTable('{{ strtolower(str_replace(' ', '_', $header)) }}')">
                                    {{ $header }}
                                    <span class="ml-1 sort-indicator"></span>
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <!-- Table rows will be dynamically inserted here -->
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="bg-white px-6 py-4 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <span id="table-info" class="text-sm text-gray-700"></span>
                    <div class="flex-1 flex justify-end">
                        <button id="prev-button" class="relative inline-flex items-center px-4 py-2 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 border border-gray-300 mr-3" onclick="prevPage()">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                            Previous
                        </button>
                        <button id="next-button" class="relative inline-flex items-center px-4 py-2 text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700" onclick="nextPage()">
                            Next
                            <svg class="h-5 w-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // CARDS DATA
        function loadCardData(cardName, total) {
    if (cardName === 'Total Apartments') return; // Do nothing for Total Apartments card

    const dynamicContent = document.getElementById('dynamic-content');
    const dynamicContentTitle = document.getElementById('dynamic-content-title');
    const dynamicContentBody = document.getElementById('dynamic-content-body');

    dynamicContentTitle.textContent = cardName;
    dynamicContent.style.display = 'block';

    dynamicContentBody.innerHTML = '<p class="text-center"><i class="fas fa-spinner fa-spin text-4xl text-indigo-500"></i></p>';

    // AJAX call to fetch detailed data
    fetch(`/dashboard/${cardName.toLowerCase().replace(/\s+/g, '-')}`)
        .then(response => response.json())
        .then(data => {
            let content = '';
            switch(cardName) {
                case 'Total Occupied':
                    const occupancyRate = ((total / data.totalAppartments) * 100).toFixed(2);
                    content = `
                        <div class="bg-gradient-to-r from-green-100 to-green-200 p-6 rounded-lg shadow-md">
                            <h3 class="text-2xl font-bold text-green-800 mb-4">Occupancy Overview</h3>
                            <div class="flex items-center mb-4">
                                <div class="text-4xl font-bold text-green-600 mr-4">${total}</div>
                                <div class="text-lg text-green-700">Total Occupied Units</div>
                            </div>
                            <div class="mb-4">
                                <div class="flex justify-between mb-1">
                                    <span class="text-green-700">Occupancy Rate</span>
                                    <span class="text-green-800 font-bold">${occupancyRate}%</span>
                                </div>
                                <div class="w-full bg-green-300 rounded-full h-2.5">
                                    <div class="bg-green-600 h-2.5 rounded-full" style="width: ${occupancyRate}%"></div>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4 mt-6">
                                ${['A', 'B', 'C', 'S'].map(house => `
                                    <div class="bg-white p-4 rounded-lg shadow">
                                        <h4 class="text-lg font-semibold text-green-700 mb-2">House ${house}</h4>
                                        <p class="text-3xl font-bold text-green-600">${data['house'+house]}</p>
                                        <p class="text-sm text-green-500">Occupied Units</p>
                                    </div>
                                `).join('')}
                            </div>
                        </div>
                    `;
                    break;
                case 'Total Empty':
                    const vacancyRate = ((total / data.totalAppartments) * 100).toFixed(2);
                    content = `
                        <div class="bg-gradient-to-r from-red-100 to-red-200 p-6 rounded-lg shadow-md">
                            <h3 class="text-2xl font-bold text-red-800 mb-4">Vacancy Overview</h3>
                            <div class="flex items-center mb-4">
                                <div class="text-4xl font-bold text-red-600 mr-4">${total}</div>
                                <div class="text-lg text-red-700">Total Vacant Units</div>
                            </div>
                            <div class="mb-4">
                                <div class="flex justify-between mb-1">
                                    <span class="text-red-700">Vacancy Rate</span>
                                    <span class="text-red-800 font-bold">${vacancyRate}%</span>
                                </div>
                                <div class="w-full bg-red-300 rounded-full h-2.5">
                                    <div class="bg-red-600 h-2.5 rounded-full" style="width: ${vacancyRate}%"></div>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4 mt-6">
                                ${['A', 'B', 'C', 'S'].map(house => `
                                    <div class="bg-white p-4 rounded-lg shadow">
                                        <h4 class="text-lg font-semibold text-red-700 mb-2">House ${house}</h4>
                                        <p class="text-3xl font-bold text-red-600">${data['house'+house]}</p>
                                        <p class="text-sm text-red-500">Vacant Units</p>
                                    </div>
                                `).join('')}
                            </div>
                        </div>
                    `;
                    break;
                case 'Total Renting Soon':
                    content = `
                        <div class="bg-gradient-to-r from-yellow-100 to-yellow-200 p-6 rounded-lg shadow-md">
                            <h3 class="text-2xl font-bold text-yellow-800 mb-4">Leases Expiring Soon</h3>
                            <div class="flex items-center mb-4">
                                <div class="text-4xl font-bold text-yellow-600 mr-4">${total}</div>
                                <div class="text-lg text-yellow-700">Total Expiring Leases</div>
                            </div>
                            <div class="grid grid-cols-3 gap-4 mt-6">
                                ${['within1Month', 'within2Months', 'within3Months'].map((period, index) => `
                                    <div class="bg-white p-4 rounded-lg shadow">
                                        <h4 class="text-lg font-semibold text-yellow-700 mb-2">Within ${index + 1} Month${index > 0 ? 's' : ''}</h4>
                                        <p class="text-3xl font-bold text-yellow-600">${data[period]}</p>
                                        <p class="text-sm text-yellow-500">Expiring Leases</p>
                                    </div>
                                `).join('')}
                            </div>
                        </div>
                    `;
                    break;
                default:
                    content = `<p class="text-center text-gray-500 text-lg">No detailed information available for ${cardName}.</p>`;
            }
            dynamicContentBody.innerHTML = content;
        })
        .catch(error => {
            console.error('Error:', error);
            dynamicContentBody.innerHTML = '<p class="text-center text-red-500 text-lg">Error loading data. Please try again later.</p>';
        });
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            renderTable();
            document.getElementById('search-input').addEventListener('input', filterTable);
            document.getElementById('status-filter').addEventListener('change', filterTable);
        
            // Add click event listener to hide dynamic content when clicking outside
            document.addEventListener('click', function(event) {
                const dynamicContent = document.getElementById('dynamic-content');
                const cards = document.querySelectorAll('.bg-white.rounded-xl.shadow-md.overflow-hidden.hover\\:shadow-lg');
                
                let clickedOutside = true;
                cards.forEach(card => {
                    if (card.contains(event.target)) {
                        clickedOutside = false;
                    }
                });
        
                if (clickedOutside && !dynamicContent.contains(event.target)) {
                    dynamicContent.style.display = 'none';
                }
            });
        });
        
        // DATA TABLE
        const rows = @json($tableData['rows']);
        const rowsPerPage = 8;
        let currentPage = 1;
        let filteredRows = [...rows];
        let sortColumn = '';
        let sortDirection = 'asc';
        
        function renderTable() {
            const tableBody = document.getElementById('table-body');
            tableBody.innerHTML = '';
        
            const start = (currentPage - 1) * rowsPerPage;
            const end = Math.min(start + rowsPerPage, filteredRows.length);
            const paginatedRows = filteredRows.slice(start, end);
        
            paginatedRows.forEach(row => {
                const tr = document.createElement('tr');
                tr.className = 'hover:bg-gray-50 transition-colors duration-150 ease-in-out';
                tr.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=${encodeURIComponent(row.tenant_name)}&color=7F9CF5&background=EBF4FF" alt="${row.tenant_name}">
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900 font-bold">${row.tenant_name.toUpperCase()}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">${row.house}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">${row.appartment}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900 font-bold">${row.duration}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="${row.status_color} px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full text-white">
                            ${row.status}
                        </span>
                    </td>
                `;
                tableBody.appendChild(tr);
            });
        
            document.getElementById('table-info').textContent = `Showing ${start + 1} to ${end} of ${filteredRows.length} entries`;
        
            document.getElementById('prev-button').disabled = currentPage === 1;
            document.getElementById('next-button').disabled = end >= filteredRows.length;
        }
        
        function nextPage() {
            if ((currentPage * rowsPerPage) < filteredRows.length) {
                currentPage++;
                renderTable();
            }
        }
        
        function prevPage() {
            if (currentPage > 1) {
                currentPage--;
                renderTable();
            }
        }
        
        function sortTable(column) {
            if (sortColumn === column) {
                sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
            } else {
                sortColumn = column;
                sortDirection = 'asc';
            }
        
            filteredRows.sort((a, b) => {
                if (a[column] < b[column]) return sortDirection === 'asc' ? -1 : 1;
                if (a[column] > b[column]) return sortDirection === 'asc' ? 1 : -1;
                return 0;
            });
        
            currentPage = 1;
            renderTable();
            updateSortIndicators();
        }
        
        function updateSortIndicators() {
            document.querySelectorAll('.sort-indicator').forEach(indicator => {
                indicator.textContent = '';
            });
        
            const currentIndicator = document.querySelector(`th[onclick="sortTable('${sortColumn}')"] .sort-indicator`);
            if (currentIndicator) {
                currentIndicator.textContent = sortDirection === 'asc' ? ' ↑' : ' ↓';
            }
        }
        
        function filterTable() {
            const searchTerm = document.getElementById('search-input').value.toLowerCase();
            const statusFilter = document.getElementById('status-filter').value.toLowerCase();
        
            filteredRows = rows.filter(row => {
                const matchesSearch = Object.values(row).some(value => 
                    value.toString().toLowerCase().includes(searchTerm)
                );
                const matchesStatus = statusFilter === '' || row.status.toLowerCase() === statusFilter;
                return matchesSearch && matchesStatus;
            });
        
            currentPage = 1;
            renderTable();
        }
        </script>
@endsection