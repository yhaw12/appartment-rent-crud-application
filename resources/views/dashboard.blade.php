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
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 cursor-pointer">
                    <div class="p-5">
                        <div class="flex items-center justify-between">
                            <div class="{{ $menu['color'] }} w-12 h-12 rounded-full flex items-center justify-center">
                                <i class="{{ $menu['icon'] }} text-white text-xl"></i>
                            </div>
                            <div class="text-right">
                                <p class="text-gray-500 text-sm font-medium uppercase">{{ $menu['name'] }}</p>
                                <p class="text-2xl font-bold text-gray-800">{{ number_format($menu['total']) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
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
    
        document.addEventListener('DOMContentLoaded', function() {
            renderTable();
            document.getElementById('search-input').addEventListener('input', filterTable);
            document.getElementById('status-filter').addEventListener('change', filterTable);
        });
    </script>
@endsection