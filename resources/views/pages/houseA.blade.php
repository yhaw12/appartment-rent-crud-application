@extends('layout')

@section('content')
<div class="relative min-h-screen bg-center bg-cover bg-fixed" style="background-image: url('/rent-banner.jpeg');">
    <div class="absolute inset-0 bg-black opacity-60"></div>
    <div class="relative z-10 flex items-center justify-center min-h-screen py-12">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-bold text-white text-center mb-8 animate-fade-in-down">Apartment Overview</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($appartments as $apartment)
                <div class="transform hover:scale-105 transition-all duration-300 ease-in-out">
                    <div class="card w-full h-full rounded-xl shadow-2xl overflow-hidden cursor-pointer {{ $apartment->status == 'vacant' ? 'bg-gradient-to-br from-red-400 to-red-600' : 'bg-gradient-to-br from-green-400 to-green-600' }}"
                         onclick="openTenantModal('{{ $apartment->tenant ? $apartment->tenant->tenant_name : '' }}', '{{ $apartment->house }}', '{{ $apartment->number }}', '{{ $apartment->status }}', '{{ $apartment->tenant ? $apartment->tenant->amount : '0.00' }}', '{{ $apartment->tenant ? $apartment->tenant->end_date : '' }}')">
                        <div class="card-body p-6 text-center">
                            <h5 class="card-title text-3xl font-bold text-white mb-2">{{ $apartment->house }}{{ $apartment->number }}</h5>
                            <p class="card-text text-lg text-white mt-2">Status: <span class="capitalize font-semibold">{{ $apartment->status }}</span></p>
                            <div class="mt-4">
                                <i class="fas {{ $apartment->status == 'vacant' ? 'fa-door-open' : 'fa-home' }} text-4xl text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Tenant Details Modal -->
<div id="tenantDetails" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-75 hidden transition-opacity duration-300">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 transform transition-all duration-300 scale-90 opacity-0" id="modalContent">
        <div class="p-6 bg-gradient-to-r from-blue-500 to-purple-600 rounded-t-2xl">
            <h2 class="text-3xl font-bold text-white text-center">Tenant Details</h2>
        </div>
        <div id="modalBody" class="p-6">
            <!-- Content will be dynamically added here -->
        </div>
        <div class="px-6 pb-6">
            <button onclick="closeTenantModal()" class="w-full bg-red-500 text-white px-6 py-3 rounded-lg text-lg font-semibold hover:bg-red-600 transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                Close
            </button>
        </div>
    </div>
</div>
</div>
@endsection


<script>
function openTenantModal(tenantName, house, apartmentNumber, status, amountPaid, expires) {
    const modalBody = document.getElementById('modalBody');
    const formattedExpires = expires ? new Date(expires).toLocaleDateString() : 'N/A';
    const modalContent = document.getElementById('modalContent');

    if (status === 'vacant') {
        modalBody.innerHTML = `
            <div class="text-center py-8">
                <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="mt-4 text-xl font-semibold text-gray-700">No Tenant Found</p>
                <p class="mt-2 text-gray-500">This apartment is currently vacant.</p>
            </div>
        `;
    } else {
        modalBody.innerHTML = `
            <div class="space-y-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 h-12 w-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium text-gray-900">${tenantName}</h3>
                        <p class="text-sm text-gray-500">Tenant</p>
                    </div>
                </div>
                <div class="border-t border-gray-200 pt-4">
                    <dl class="grid grid-cols-2 gap-x-4 gap-y-6">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">House</dt>
                            <dd class="mt-1 text-lg font-semibold text-gray-900">${house}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Apartment Number</dt>
                            <dd class="mt-1 text-lg font-semibold text-gray-900">${apartmentNumber}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Amount Paid</dt>
                            <dd class="mt-1 text-lg font-semibold text-green-600">&#x20B5;${amountPaid}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Rent Expires</dt>
                            <dd class="mt-1 text-lg font-semibold text-gray-900">${formattedExpires}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        `;
    }

    document.getElementById('tenantDetails').classList.remove('hidden');
    setTimeout(() => {
        modalContent.classList.remove('scale-90', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);
}

function closeTenantModal() {
    const modalContent = document.getElementById('modalContent');
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-90', 'opacity-0');
    setTimeout(() => {
        document.getElementById('tenantDetails').classList.add('hidden');
    }, 300);
}
</script>

<style>
@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translate3d(0, -20px, 0);
    }
    to {
        opacity: 1;
        transform: translate3d(0, 0, 0);
    }
}

.animate-fade-in-down {
    animation: fadeInDown 0.5s ease-out;
}
</style>