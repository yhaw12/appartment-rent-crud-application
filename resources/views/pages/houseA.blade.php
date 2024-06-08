@extends('layout')

@section('content')

<div class="relative min-h-screen bg-center bg-cover" style="background-image: url('/rent-banner.jpeg');">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="relative z-10 flex items-center justify-center min-h-screen">
        <div class="w-full h-auto mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 p-6 cursor-pointer">

            @foreach ($appartments as $apartment)
            <div class="card w-full h-auto rounded-lg shadow-lg overflow-hidden transition-transform duration-300 transform hover:scale-105 {{ $apartment->status == 'vacant' ? 'bg-red-300' : 'bg-green-300' }}" onclick="openTenantModal('{{ $apartment->tenant ? $apartment->tenant->tenant_name : '' }}', '{{ $apartment->house }}', '{{ $apartment->number }}', '{{ $apartment->status }}', '{{ $apartment->tenant ? $apartment->tenant->amount : '0.00' }}', '{{ $apartment->tenant ? $apartment->tenant->endDate : '' }}')">
                <div class="card-body p-6">
                    <h5 class="card-title text-center text-2xl font-bold text-gray-800">{{ $apartment->house }}{{ $apartment->number }}</h5>
                    <p class="card-text text-center text-base text-gray-700 mt-2">Status: <span class="capitalize">{{ $apartment->status }}</span></p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Tenant Details Modal -->
    <div id="tenantDetails" class="hidden fixed top-0 left-0 w-full h-full flex items-center justify-center z-50 bg-black bg-opacity-50">
        <div class="bg-white p-8 rounded-lg shadow-xl max-w-md mx-auto">
            <h2 class="text-2xl font-bold mb-6 text-center">Tenant Details</h2>
            <div class="text-center space-y-4">
                <p id="tenantName" class="text-lg font-semibold"></p>
                <p id="houseNumber" class="text-gray-700"></p>
                <p id="appartmentNumber" class="text-gray-700"></p>
                <p id="amountPaid" class="text-gray-700"></p>
                <p id="Expires" class="text-gray-700"></p>
            </div>
            <div class="mt-6">
                <button onclick="closeTenantModal()" class="w-full bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition duration-200">Close</button>
            </div>
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
                <p>Rent Expires: ${expires}</p>
            `;
        }
        document.getElementById('tenantDetails').classList.remove('hidden');
    }

    function closeTenantModal() {
        document.getElementById('tenantDetails').classList.add('hidden');
    }
</script>
