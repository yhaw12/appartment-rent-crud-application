{{-- @extends('layout')

@section('content')
<div class="mt-20">    
    <div class="mt-6">
        <h2 class="text-xl font-semibold text-gray-700 leading-tight">Users</h2>


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
@endsection --}}