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
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
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
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Tenants</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full whitespace-nowrap">
                    <thead>
                        <tr class="bg-gray-50">
                            @foreach ($tableData['headers'] as $header)
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ $header }}
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
        const rowsPerPage = 10;
        let currentPage = 1;
    
        function renderTable() {
            const tableBody = document.getElementById('table-body');
            tableBody.innerHTML = '';
    
            const start = (currentPage - 1) * rowsPerPage;
            const end = Math.min(start + rowsPerPage, rows.length);
            const paginatedRows = rows.slice(start, end);
    
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
                                <div class="text-sm font-medium text-gray-900">${row.tenant_name}</div>
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
                        <div class="text-sm text-gray-900">${row.duration}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="${row.status_color} px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full text-white">
                            ${row.status}
                        </span>
                    </td>
                `;
                tableBody.appendChild(tr);
            });
    
            document.getElementById('table-info').textContent = `Showing ${start + 1} to ${end} of ${rows.length} entries`;
    
            document.getElementById('prev-button').disabled = currentPage === 1;
            document.getElementById('next-button').disabled = end >= rows.length;
        }
    
        function nextPage() {
            if ((currentPage * rowsPerPage) < rows.length) {
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
    
        document.addEventListener('DOMContentLoaded', function() {
            renderTable();
        });
    </script>
@endsection