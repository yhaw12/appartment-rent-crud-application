@extends('layout')
@section('content')
<div id="appartmentList" class="w-full mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 p-4 cursor-pointer">
    @foreach ($appartments as $apartment) {{-- Corrected typo in variable name --}}
    <div class="card w-full h-auto rounded-lg shadow-lg overflow-hidden transition-transform duration-200 transform hover:scale-105 {{ $apartment->status == 'vacant' ? 'bg-red-200' : 'bg-green-200' }}" data-house="{{ $apartment->house }}" data-number="{{ $apartment->number }}" id="apartment-{{ $apartment->house }}-{{ $apartment->number }}" onclick="openTenantModal('{{ $apartment->tenant_name }}', '{{ $apartment->house }}', '{{ $apartment->number }}', '{{ $apartment->amount }}', '{{ $apartment->duration }}', '{{ $apartment->expiry_date }}')">
        <div class="card-body p-4">
            <h5 class="card-title text-center text-xl font-bold text-gray-800">{{ $apartment->house }}{{ $apartment->number }}</h5>
            <p class="card-text text-center text-sm text-gray-600">Status: <span class="capitalize">{{ $apartment->status }}</span></p>
            <!-- Display other apartment details as needed -->
        </div>
    </div>
    @endforeach
</div>

{{-- TENANT MODAL --}}
<div id="tenantModal" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <div  onclick="closeTenantModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-2 py-1 bg-blue-200 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-all cursor-pointer"   >
                        <i class="fas fa-times"></i>
                    </div>
                    
                </div>
                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Tenant Details</h3>
                <div class="mt-2 flex flex-col" id="tenantDetails"> <!-- Changed id to 'tenantDetails' -->
                    <!-- Tenant details will be inserted here dynamically -->
                </div>
            </div>
           
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    function openTenantModal(tenantName, house, number, amount, duration, expiryDate) {
        document.getElementById('tenantDetails').innerHTML = `
            <h2>${tenantName}</h2>
            <span>House: ${house}</span>
            <span>Apartment Number: ${number}</span>
            <span>Amount: ${amount}</span>
            <span>Duration: ${duration}</span>
            <span>Expiry Date: ${expiryDate}</span>
        `;
        document.getElementById('tenantModal').classList.add('block');
        document.getElementById('tenantModal').classList.remove('hidden');
    }

    function closeTenantModal() {
        document.getElementById('tenantModal').classList.add('hidden');
        document.getElementById('tenantModal').classList.remove('block');
    }
</script>
@endsection
