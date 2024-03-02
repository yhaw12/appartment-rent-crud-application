@extends('layout')

@section('content')
<div id="appartmentList" class="w-full mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 p-4 cursor-pointer">
    @foreach ($appartments as $apartment)
    <div class="card w-full h-auto rounded-lg shadow-lg overflow-hidden transition-transform duration-200 transform hover:scale-105 {{ $apartment->status == 'vacant' ? 'bg-red-200' : 'bg-green-200' }}" onclick="openTenantModal('{{ $apartment->tenant ? $apartment->tenant->tenant_name : '' }}', '{{ $apartment->house }}', '{{ $apartment->number }}', '{{ $apartment->status }}', '{{ $apartment->tenant ? $apartment->tenant->amount : '0.00' }}', '{{ $apartment->tenant ? $apartment->tenant->endDate : '' }}')">
        <div class="card-body p-4">
            <h5 class="card-title text-center text-xl font-bold text-gray-800">{{ $apartment->house }}{{ $apartment->number }}</h5>
            <p class="card-text text-center text-sm text-gray-600">Status: <span class="capitalize">{{ $apartment->status }}</span></p>
            <!-- Display other apartment details as needed -->
        </div>
    </div>
    @endforeach
</div>

<!-- Tenant Details Modal -->
<div id="tenantDetails" class="hidden fixed top-0 left-0 w-full h-full flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white p-6 rounded shadow-lg max-w-md mx-auto shadow-xl">
        <h2 class="text-xl font-bold mb-4 text-center">Tenant Details</h2>
        <div class="text-center">
            <p id="tenantName" class="text-lg font-semibold"></p>
            <p id="houseNumber" class="text-gray-600"></p>
            <p id="appartmentNumber" class="text-gray-600"></p>
            <p id="amountPaid" class="text-gray-600"></p>
            <p id="Expires" class="text-gray-600"></p>
        </div>
        <div class="mt-4">
            <button onclick="closeTenantModal()" class="w-full bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Close</button>
        </div>
    </div>
</div>
@endsection

<script>
    function openTenantModal(tenantName, house, appartmentNumber, status, amountPaid, expires) {
        const modalContent = document.getElementById('tenantDetails').querySelector('.text-center');
        if (status === 'vacant') {
            modalContent.innerHTML = '<p class="text-lg font-semibold">No Tenant Found or Available</p>';
        } else {
            modalContent.innerHTML = `
                <p class="text-lg font-semibold">Tenant Name: ${tenantName}</p>
                <p>House: ${house}</p>
                <p>Appartment Number: ${appartmentNumber}</p>
                <p>Amount Paid: &#x20B5;${amountPaid}</p>
                <p>Rent Expires:${expires}</p>
            `;
        }
        document.getElementById('tenantDetails').classList.remove('hidden');
    }

    function closeTenantModal() {
        document.getElementById('tenantDetails').classList.add('hidden');
    }
</script>
