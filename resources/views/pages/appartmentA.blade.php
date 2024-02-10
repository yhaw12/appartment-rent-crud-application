@extends('layout')

@section('content')
<!-- This is the modal container -->
<div id="addTenantModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Backdrop, clickable to close the modal -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        
        <!-- Modal content -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="{{ route('tenants.store') }}" method="POST" class="p-6">
                @csrf
                <!-- Modal header -->
                <div class="mb-4">
                    <h2 class="text-lg font-semibold text-gray-700" id="modal-title">Add New Tenant</h2>
                </div>
                
                <!-- Modal body -->
                <div class="mb-4">
                    <!-- Your form fields go here -->
                    <label for="tenantName" class="block text-sm font-medium text-gray-700">Tenant Name</label>
                    <input type="text" name="tenantName" id="tenantName" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <!-- More fields... -->
                </div>
                
                <!-- Modal footer -->
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Save
                    </button>
                    <button type="button" onclick="closeModal()" class="ml-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="mt-20">    
    <div class="mt-6">
        <div class="w-full flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-700 leading-tight">Users</h2>
            <div class=" w-52 h-10 flex items-center bg-green-700  p-2 rounded-md shadow-2 cursor-pointer outline"><i class="fas fa-plus"></i> <h2>Add Tennant</h2></div>
        </div>


        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
              <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        @foreach ($tableData['headers'] as $header)
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">{{ $header }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tableData['rows'] as $row)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $row['user'] }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $row['role'] }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $row['created_at'] }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $row['status'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
                <div class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
                    <span class="text-xs xs:text-sm text-gray-900">Showing 1 to 4 of 50 Entries</span>

                    <div class="inline-flex mt-2 xs:mt-0">
                        <button class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-l">Prev</button>
                        <button class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-r">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</div>
@endsection