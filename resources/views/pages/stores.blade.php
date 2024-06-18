@extends('layout')

@section('content')

<div class="relative min-h-screen bg-center bg-cover" style="background-image: url('/rent-banner.jpeg');">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="relative z-10 flex items-center justify-center min-h-screen">
        <div class="w-full h-auto mx-auto grid grid-cols-2 md:grid-cols-3 gap-6 p-6 cursor-pointer">

            @foreach ($stores as $store)
            <div class="card w-full h-auto rounded-lg shadow-lg overflow-hidden transition-transform duration-300 transform hover:scale-110 {{ $store->status == 'vacant' ? 'bg-red-300' : 'bg-green-300' }}" onclick="openTenantModal('{{ $store->tenant ? $store->tenant->tenant_name : '' }}', '{{ $store->house }}', '{{ $store->number }}', '{{ $store->status }}', '{{ $store->tenant ? $store->tenant->amount : '0.00' }}', '{{ $store->tenant ? $store->tenant->end_date : '' }}')">
                <div class="card-body p-4">
                    <h5 class="card-title text-center text-2xl font-bold text-gray-800">{{ $store->house }}{{ $store->number }}</h5>
                    <p class="card-text text-center text-base text-gray-700 mt-2">Status: <span class="capitalize">{{ $store->status }}</span></p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

     <!-- Tenant Details Modal -->
     <div id="tenantDetails" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50 hidden">
        <div class="bg-white p-8 rounded-lg shadow-xl max-w-md mx-auto">
            <h2 class="text-2xl font-bold mb-6 text-center">Tenant Details</h2>
            <div id="modalContent" class="space-y-4">
                <!-- Content will be dynamically added here -->
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
        const modalContent = document.getElementById('modalContent');
        const formattedExpires = expires ? new Date(expires).toLocaleDateString() : '';
        if (status === 'vacant') {
            modalContent.innerHTML = '<p class="text-lg font-semibold text-center">No Tenant Found or Available</p>';
        } else {
            modalContent.innerHTML = `
                <div class="flex justify-between text-xl">
                    <p class="font-semibold font-bold">Tenant Name:</p>
                    <p>${tenantName}</p>
                </div>
                <div class="flex justify-between text-xl">
                    <p class="font-semibold font-bold">House:</p>
                    <p>${house}</p>
                </div>
                <div class="flex justify-between text-xl">
                    <p class="font-semibold font-bold">Appartment Number:</p>
                    <p>${appartmentNumber}</p>
                </div>
                <div class="flex justify-between text-xl">
                    <p class="font-semibold font-bold">Amount Paid:</p>
                    <p>&#x20B5;${amountPaid}</p>
                </div>
                <div class="flex justify-between text-xl">
                    <p class="font-semibold font-bold">Rent Expires:</p>
                    <p>${formattedExpires}</p>
                </div>
            `;
        }
        document.getElementById('tenantDetails').classList.remove('hidden');
    }

    function closeTenantModal() {
        document.getElementById('tenantDetails').classList.add('hidden');
    }
</script>

