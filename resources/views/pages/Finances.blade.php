{{-- @extends('layout');

@section('content')
  <div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-6">Finance Management</h1>
    <table class="w-full whitespace-nowrap">
      <thead>
        <tr class="text-left text-sm font-semibold tracking-wide text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
          <th class="px-4 py-3">House</th>
          <th class="px-4 py-3">Total Income</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-900">
        @foreach ($financialData as $data)
          <tr class="text-gray-700 dark:text-gray-400">
            <td class="px-4 py-3">{{ $data['house'] }}</td>
            <td class="px-4 py-3">{{ number_format($data['total_income'], 2) }}</td>
          </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr class="text-right text-sm font-semibold tracking-wide text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
          <td colspan="1" class="px-4 py-3">Overall Total:</td>
          <td class="px-4 py-3">{{ number_format($overallTotalIncome, 2) }}</td>
        </tr>
      </tfoot>
    </table>
  </div>
@endsection --}}
