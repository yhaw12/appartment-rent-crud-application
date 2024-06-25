@extends('layout')

@section('content')
<div class="min-h-screen bg-gray-100">
    <div class="py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-4xl font-extrabold text-gray-900 text-center mb-10">Apartment Overview</h1>
            
            <!-- Status Summary -->
            <div class="bg-white shadow-lg rounded-lg p-6 mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Status Summary</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-green-100 p-4 rounded-lg">
                        <p class="text-green-800 font-semibold">Occupied</p>
                        <p class="text-3xl font-bold text-green-600">{{ $appartments->where('status', 'occupied')->count() }}</p>
                    </div>
                    <div class="bg-red-100 p-4 rounded-lg">
                        <p class="text-red-800 font-semibold">Vacant</p>
                        <p class="text-3xl font-bold text-red-600">{{ $appartments->where('status', 'vacant')->count() }}</p>
                    </div>
                    <div class="bg-blue-100 p-4 rounded-lg">
                        <p class="text-blue-800 font-semibold">Total</p>
                        <p class="text-3xl font-bold text-blue-600">{{ $appartments->count() }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Apartment List -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800">Apartment List</h2>
                </div>
                <div class="divide-y divide-gray-200">
                    @foreach ($appartments as $apartment)
                    <div class="p-6 flex items-center justify-between hover:bg-gray-50 transition duration-150 ease-in-out">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-12 w-12 rounded-full flex items-center justify-center {{ $apartment->status == 'vacant' ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }}">
                                <i class="fas {{ $apartment->status == 'vacant' ? 'fa-door-open' : 'fa-home' }} text-2xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900">{{ $apartment->house }}{{ $apartment->number }}</h3>
                                <p class="text-sm text-gray-500">Status: <span class="capitalize font-semibold {{ $apartment->status == 'vacant' ? 'text-red-600' : 'text-green-600' }}">{{ $apartment->status }}</span></p>
                            </div>
                        </div>
                        <button onclick="openTenantModal('{{ $apartment->tenant ? $apartment->tenant->tenant_name : '' }}', '{{ $apartment->house }}', '{{ $apartment->number }}', '{{ $apartment->status }}', '{{ $apartment->tenant ? $apartment->tenant->amount : '0.00' }}', '{{ $apartment->tenant ? $apartment->tenant->end_date : '' }}')" class="px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            View Details
                        </button>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Tenant Details Modal -->
    <div id="tenantDetails" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50 hidden transition-opacity duration-300">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 transform transition-all duration-300 scale-90 opacity-0" id="modalContent">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Tenant Details</h2>
                <div id="modalBody">
                    <!-- Content will be dynamically added here -->
                </div>
                <div class="mt-6">
                    <button onclick="closeTenantModal()" class="w-full bg-red-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                        Close
                    </button>
                </div>
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
            <div class="text-center py-6">
                <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="mt-4 text-xl font-semibold text-gray-700">No Tenant Found</p>
                <p class="mt-2 text-gray-500">This apartment is currently vacant.</p>
            </div>
        `;
    } else {
        modalBody.innerHTML = `
            <div class="space-y-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0 h-10 w-10 bg-indigo-600 rounded-full flex items-center justify-center">
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
                            <dd class="mt-1 text-sm text-gray-900">${house}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Apartment Number</dt>
                            <dd class="mt-1 text-sm text-gray-900">${apartmentNumber}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Amount Paid</dt>
                            <dd class="mt-1 text-sm font-medium text-green-600">&#x20B5;${amountPaid}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Rent Expires</dt>
                            <dd class="mt-1 text-sm text-gray-900">${formattedExpires}</dd>
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