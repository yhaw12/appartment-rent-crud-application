@extends('layout')

@section('content')
    <!-- Membership Statistics Cards -->
    <div class="container mx-auto mt-8 mr-5 grid grid-cols-2 md:grid-cols-3 gap-4">
        <!-- Cards -->
        @foreach ($menus as $menu)
            <div class="bg-white p-4 rounded cursor-pointer shadow-lg transition-transform duration-300 transform hover:scale-110">
                <div class="flex items-center ">
                    <div class="{{ $menu['color'] }} w-12 h-12 md:w-16 md:h-16 rounded-lg flex items-center justify-center mr-2">
                        <i class="{{ $menu['icon'] }} text-white text-sm md:text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-800 text-sm md:text-lg">{{ $menu['name'] }}</p>
                        <p class="text-sm md:text-xl font-semibold text-gray-900">{{ $menu['total'] }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div id="table-container" class="overflow-x-scroll max-h-[600px]">
        <table class="w-full whitespace-nowrap">
            <!-- Table structure goes here -->
            <thead>
                <tr>
                    @foreach ($tableData['headers'] as $header)
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-800 text-left text-xs font-semibold text-gray-100 uppercase tracking-wider">{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody id="table-body" class="bg-white divide-y divide-gray-200">
                <!-- Table rows will be dynamically inserted here -->
            </tbody>
        </table>
    </div>

    
    <div class="mt-12">
        <h2 class="text-xl font-semibold text-gray-700 leading-tight">Users</h2>
    </div>

    <div id="table-container" class="inline-block min-w-full shadow-lg rounded-sm overflow-x-auto">
        <table class="min-w-full leading-normal">
            
        </table>
        <div class="px-5 py-5 bg-gray-100 border-t flex flex-col xs:flex-row items-center xs:justify-between">
            <span id="table-info" class="text-xs xs:text-sm text-gray-900"></span>
            <div class="inline-flex mt-2 xs:mt-0">
                <button id="prev-button" class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-l" onclick="prevPage()">Prev</button>
                <button id="next-button" class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-r" onclick="nextPage()">Next</button>
            </div>
        </div>
    </div>

    
<!-- Include custom CSS for hiding the scrollbar -->
<style>
    #table-container::-webkit-scrollbar {
        display: none; /* Hide scrollbar for Chrome, Safari, and Opera */
    }
</style>
    
    <script>
        const rows = @json($tableData['rows']);
        const rowsPerPage = 4;
        let currentPage = 1;
    
        function renderTable() {
            const tableBody = document.getElementById('table-body');
            tableBody.innerHTML = '';
    
            const start = (currentPage - 1) * rowsPerPage;
            const end = start + rowsPerPage;
            const paginatedRows = rows.slice(start, end);
    
            paginatedRows.forEach(row => {
                const tr = document.createElement('tr');
                tr.className = currentPage % 2 === 0 ? 'bg-gray-50 hover:bg-gray-100' : 'bg-white hover:bg-gray-100';
                tr.innerHTML = `
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">${row.tenant_name}</td>
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">${row.house}</td>
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">${row.appartment}</td>
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">${row.duration}</td>
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                        <span class="${row.status_color} inline-block w-16 py-1 px-3 text-white rounded-full text-center">${row.status.charAt(0).toUpperCase() + row.status.slice(1)}</span>
                    </td>
                `;
                tableBody.appendChild(tr);
            });
    
            document.getElementById('table-info').textContent = `Showing ${start + 1} to ${end} of ${rows.length} Entries`;
    
            document.getElementById('prev-button').disabled = currentPage === 1;
            document.getElementById('next-button').disabled = end >= rows.length;
        }
    
        function nextPage() {
            if (currentPage * rowsPerPage < rows.length) {
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
