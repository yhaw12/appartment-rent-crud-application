@extends('layouts.app')

@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">Finance Page</h1>
        <div class="grid grid-cols-2 gap-4">
          <div class="bg-white shadow rounded p-4">
            <h2 class="text-2xl font-bold mb-2">Total Amount Paid by Each Tenant</h2>
            <table class="w-full table-auto">
                <thead>
                    <tr class="border-b">
                        <th class="text-left py-2 px-4">Tenant</th>
                        <th class="text-right py-2 px-4">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tenants as $tenant)
                        <tr>
                            <td class="text-left py-2 px-4">{{ $tenant }}</td>
                            <td class="text-right py-2 px-4">{{ $totals[$tenant] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="bg-white shadow rounded p-4">
            <h2 class="text-2xl font-bold mb-2">Average Amount Paid per House</h2>
            <table class="w-full table-auto">
                <thead>
                    <tr class="border-b">
                        <th class="text-left py-2 px-4">House</th>
                        <th class="text-right py-2 px-4">Average</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($houses as $house)
                        <tr>
                            <td class="text-left py-2 px-4">{{ $house }}</td>
                            <td class="text-right py-2 px-4">{{ $averages[$house] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-span-2 bg-white shadow rounded p-4">
            <h2 class="text-2xl font-bold mb-2">Chart of Amounts Paid by Tenants</h2>
            <canvas id="chart" class="chart"></canvas>
        </div>

        </div>
        
        <div class="col-span-2 bg-white shadow rounded p-4">
            <h2 class="text-2xl font-bold mb-2">Chart of Amounts Paid by Tenants</h2>
            <canvas id="chart"></canvas>
        </div>
    </div>
@endsection


@push('scripts')
<script>
  // Assuming 'data' is passed as an array of amounts paid by tenants
  // and 'labels' is an array of tenant names passed from the controller
  let data = @json($data); // Use @json to safely pass PHP array to JavaScript
  let labels = @json($tenants); // Assuming $tenants is an array of tenant names

  // Create a new chart instance
  let chart = new Chart(document.getElementById('chart'), {
      type: 'bar',
      data: {
          labels: labels,
          datasets: [{
              label: 'Amount',
              data: data,
              backgroundColor: 'rgba(59,  130,  246,  0.5)',
              borderColor: 'rgba(59,  130,  246,  1)',
              borderWidth:  1
          }]
      },
      options: {
          scales: {
              y: {
                  beginAtZero: true
              }
          }
      }
  });
</script>
@endpush
