@extends('layout')



@section('content')

    <!-- Membership Statistics Cards -->
 <div class="container mx-auto mt-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
    <!-- Cards -->

    @foreach ($menus as $menu)
  <div class="bg-white p-4 rounded shadow-lg">
    <div class="flex items-center">
        <div class="{{ $menu['color'] }} w-16 h-16 rounded-lg flex items-center justify-center mr-2">
            <i class="{{ $menu['icon'] }} text-white text-2xl"></i>
        </div>
        <div>
            <p class="text-gray-800">{{ $menu['name'] }}</p>
            <p class="text-xl font-semibold text-gray-900">{{ $menu['total'] }}</p>
        </div>
        </div>
    </div>
    @endforeach

  </div>
  

    <div class="mt-20">    
        <div class="mt-6">
            <h2 class="text-xl font-semibold text-gray-700 leading-tight">Users</h2>


            <div class="max-w-7xl mx-auto px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow-lg rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                @foreach ($tableData['headers'] as $header)
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-800 text-left text-xs font-semibold text-gray-100 uppercase tracking-wider">{{ $header }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($tableData['rows'] as $row)
                                <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }} hover:bg-gray-100">
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm">{{ $row['tenant_name'] }}</td>
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm">{{ $row['house'] }}</td>
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm">{{ $row['appartment'] }}</td>
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm">{{ $row['duration'] }}</td>
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                        <span class="{{ $row['status'] == 'New' ? 'bg-green-500' : 'bg-red-500' }} inline-block w-16 py-1 px-3 text-white rounded-full text-center">{{ ucfirst($row['status']) }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="px-5 py-5 bg-gray-100 border-t flex flex-col xs:flex-row items-center xs:justify-between">
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
@endsection

