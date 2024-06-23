@extends('layout')

@section('content')
    <div class="container mx-auto">

        <div class="mt-6">

            <div class="w-full flex items-center justify-between">
                <h2 class="text-xl font-semibold text-gray-700 leading-tight">Users</h2>
                <button id="openModalBtn" class="w-32 h-10 flex items-center bg-custom p-2 rounded-md shadow-2 text-white hover:text-bg-custom hover:bg-slate-50 transition-all duration-300 cursor-pointer" onclick="openModal()"><i class="fas fa-plus"></i> <h2>Add Tennant</h2></button>
            </div>

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
                        <tbody id="table-body">
                            {{-- Table rows will be dynamically generated here --}}
                        </tbody>
                    </table>
                    <div class="flex items-center justify-center bg-gray-50">
                      <div class="w-72">
                          <div id="table-info" class="px-5 py-2 mt-1 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
                              <span class="text-xs xs:text-sm text-gray-900">Showing 1 to 5 of 50 Entries</span>
                          </div>
                          <div class="px-5 py-2 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
                              <div class="inline-flex mt-1 xs:mt-0">
                                  <button id="prev-button" class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-l mr-2" onclick="prevPage()" disabled>Prev</button>
                                  <button id="next-button" class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-r" onclick="nextPage()">Next</button>
                              </div>
                          </div>
                      </div>
                  </div>                  
                </div>
            </div>
        </div>
    </div>
    
    <div id="addTenantModal" class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-black bg-opacity-50 hidden"> 
      {{-- SUBMIT TENNAT DATA --}}
    <form method="POST" action="{{route('tennant.store')}}" >
         @csrf
        <div class="relative py-3 sm:max-w-xl sm:mx-auto">
          <div class="relative px-4 py-10 bg-white mx-8 md:mx-0 shadow rounded-3xl sm:p-10">
            <div class="max-w-md mx-auto">
              <div class="flex items-center space-x-5">
                <div class="w-10 h-10 rounded-full shadow-xl grid place-items-center "> <i class="fas fa-user"></i></div>
                
                <div class="block pl-2 font-semibold text-xl self-start text-gray-700">
                  <h2 class="leading-relaxed">Add New Tennant</h2>
                  <p class="text-sm text-gray-500 font-normal leading-relaxed">Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
                </div>
              </div>
              <div class="divide-y divide-gray-200">
                <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                  <div class="form-group flex flex-col">
                    <label class="leading-loose">Name</label>
                    <input type="text" name="tenant_name" required class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="Name">
                      <div class="text-red-500 mt-2 text-sm">
                        @error('tenant_name')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                      </div>
                  </div>
                  <div id="housingSelectionContainer">
                    <div class="flex flex-col">
                      <label class="leading-loose">House</label>
                      <select id="housingSelect" name="house" class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">
                        <option disabled selected value=''>Choose...</option>
                        <option value="A" {{ old('house')=='A'? 'selected' :'' }}>A</option>
                        <option value="B" {{ old('house')=='B'? 'selected' :'' }}>B</option>
                        <option value="C" {{ old('house')=='C'? 'selected' :'' }}>C</option>
                        <option value="S" {{ old('house')=='S'? 'selected' :'' }}>S</option>
                      </select>
                    </div>
                    <div class="form-group flex flex-col">
                      <label class="leading-loose">Apartment Number</label>
                      <input type="number" name="appartment" id="aptNumberInput" min="1" max="40" class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="#">
                    </div>
                  </div>          
                                  
                
                  <div class="flex items-center space-x-4">
                    <div class="flex flex-col">
                      <label class="leading-loose">Start</label>
                      <div class="relative focus-within:text-gray-600 text-gray-400">
                        <input type="date" name="start_date" class="pr-4 pl-10 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="25/02/2020">
                        <div class="absolute left-3 top-2">
                          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                      </div>
                    </div>
                    <div class="form-group flex flex-col">
                      <label class="leading-loose">Duration</label>
                      <select id="durationSelect" name="duration" class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">
                          <option disabled selected value=''>Choose...</option>
                          <option value="3/12" {{ old('duration')=='3/12'? 'selected' :'' }}>3 months</option>
                          <option value="6/12" {{ old('duration')=='6/12'? 'selected' :'' }}>6 months</option>
                          <option value="12" {{ old('duration')=='12'? 'selected' :'' }}>1 year</option>
                          <option value="24" {{ old('duration')=='24'? 'selected' :'' }}>2 years</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group flex flex-col mt-20">
                    <label class="leading-loose">amount</label>
                    <div class="relative gap-8">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none ">&#x20B5;
                        </span>
                        <input type="text" name="amount" value="{{ old('amount') }}" required pattern="[0-9]*" class="px-8 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="Amount">
                        @error('amount')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                    </div>
                  </div>
                </div>
                <div class="pt-4 flex items-center space-x-4">
                    <button class="flex justify-center items-center w-full bg-red-500 text-gray-900 px-4 py-3 rounded-md focus:outline-none" onclick="closeModal()">
                      <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg> Cancel
                    </button>
                    <button type="submit" id="submitBtn" class="bg-blue-500 flex justify-center items-center w-full text-white px-4 py-3 rounded-md focus:outline-none">Save Tennant</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
    {{-- UPDATE TENNAT INFO --}}
    <div id="editTenantModal" class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-black bg-opacity-50 hidden"> 
      <form method="POST" id="editTenantForm">
          @csrf
          @method('PUT')
          <div class="relative py-3 sm:max-w-xl sm:mx-auto">
              <div class="relative px-4 py-10 bg-white mx-8 md:mx-0 shadow rounded-3xl sm:p-10">
                  <div class="max-w-md mx-auto">
                      <div class="flex items-center space-x-5">
                          <div class="w-10 h-10 rounded-full shadow-xl grid place-items-center "> 
                              <i class="fas fa-user"></i>
                          </div>
                          <div class="block pl-2 font-semibold text-xl self-start text-gray-700">
                              <h2 class="leading-relaxed">Update Tenant</h2>
                              <p class="text-sm text-gray-500 font-normal leading-relaxed">Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
                          </div>
                      </div>
                      <div class="divide-y divide-gray-200">
                          <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                              <div class="form-group flex flex-col">
                                  <label class="leading-loose">Name</label>
                                  <input type="text" name="tenant_name" id="editTenantName" required class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="Name">
                              </div>
                              <div class="flex items-center space-x-4">
                                  <div class="flex flex-col">
                                      <label class="leading-loose">Start</label>
                                      <div class="relative focus-within:text-gray-600 text-gray-400">
                                          <input type="date" name="start_date" id="editStartDate" class="pr-4 pl-10 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="25/02/2020">
                                          <div class="absolute left-3 top-2">
                                              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                              </svg>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="form-group flex flex-col">
                                      <label class="leading-loose">Duration</label>
                                      <select id="editDurationSelect" name="duration" class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">
                                          <option disabled selected value=''>Choose...</option>
                                          <option value="3/12">3 months</option>
                                          <option value="6/12">6 months</option>
                                          <option value="12">1 year</option>
                                          <option value="24">2 years</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="form-group flex flex-col mt-20">
                                  <label class="leading-loose">Amount</label>
                                  <div class="relative gap-8">
                                      <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none ">&#x20B5;</span>
                                      <input type="text" name="amount" id="editAmount" required pattern="[0-9]*" class="px-8 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="Amount">
                                  </div>
                              </div>
                          </div>
                          <div class="pt-4 flex items-center space-x-4">
                              <button type="button" class="flex justify-center items-center w-full text-gray-900 px-4 py-3 rounded-md focus:outline-none" onclick="closeEditModal()">
                                  <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                  </svg> Cancel
                              </button>
                              <button type="submit" id="submitEditBtn" class="bg-blue-500 flex justify-center items-center w-full text-white px-4 py-3 rounded-md focus:outline-none">Save</button>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </form>
  </div>
  
  
    <a href="" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Export Tenants</a>
  </div>
  <footer class="text-white text-center p-2 mt-auto" style="background-color: #031b44">
    <p>&copy; {{ date('Y') }} Blankson Obeng Designs. All rights reserved.</p>
</footer>
@endsection

<style>
  .bg-custom {
    background-color: #012561;
}

</style>

<script>
    function openModal() {
      document.getElementById('addTenantModal').style.display = 'flex';
    }

    function closeModals() {
      document.getElementById('addTenantModal').style.display = 'none';
      document.getElementById('editTenantModal').style.display = 'none';
    }

    //     function closeModal() {
    //   closeModals(); 
    // }

    // function closeEditModal() {
    //   closeModals(); 
    // }

  
</script>


{{-- SWEETALERT --}}
<script>
const rows = @json($tableData['rows']);
    const rowsPerPage = 5;
    let currentPage = 1;

    function displayTable() {
        const tableBody = document.getElementById("table-body");
        tableBody.innerHTML = "";
        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        const paginatedRows = rows.slice(start, end);
        paginatedRows.forEach(row => {
            const tr = document.createElement("tr");
            tr.innerHTML = `
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">${row.tenant_name.toUpperCase()}</td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">${row.house}</td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm font-bold">${row.end_date}</td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">&#8373; ${row.amount}</td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm"><span class="${row.status === 'New' ? 'bg-green-500' : 'bg-red-500'} w-12 h-6 py-2 px-4 text-white rounded-sm">${row.status.charAt(0).toUpperCase() + row.status.slice(1)}</span></td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    <button onclick="openEditModal(${row.id})" class="w-16 h-8 px-4 py-2 inline-flex items-center justify-center bg-custom text-white rounded-sm">Update</button>
                    <form action="/tennant/${row.id}" method="POST" style="display: inline-block;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="w-16 h-8 px-4 py-2 inline-flex items-center justify-center bg-red-700 hover:bg-red-700 text-white rounded-sm">Delete</button>
                    </form>

                </td>
            `;
            tableBody.appendChild(tr);
        });

        document.getElementById("table-info").textContent = `Showing ${start + 1} to ${end > rows.length ? rows.length : end} of ${rows.length} entries`;
        document.getElementById("prev-button").disabled = currentPage === 1;
        document.getElementById("next-button").disabled = end >= rows.length;
    }

    function prevPage() {
        if (currentPage > 1) {
            currentPage--;
            displayTable();
        }
    }

    function nextPage() {
        if ((currentPage * rowsPerPage) < rows.length) {
            currentPage++;
            displayTable();
        }
    }

    document.addEventListener("DOMContentLoaded", function () {
        displayTable();
    });

    function openModal() {
        document.getElementById("addTenantModal").style.display = "flex";
    }

    function closeModal() {
        document.getElementById("addTenantModal").style.display = "none";
    }

    function openEditModal(tenantId) {
        const tenant = rows.find(row => row.id === tenantId);
        if (tenant) {
            document.getElementById('editTenantName').value = tenant.tenant_name;
            document.getElementById('editStartDate').value = tenant.start_date;
            document.getElementById('editDurationSelect').value = tenant.duration;
            document.getElementById('editAmount').value = tenant.amount;

            const form = document.getElementById('editTenantForm');
            form.action = `/tennant/update/${tenantId}`;
            document.getElementById('editTenantModal').style.display = 'flex';
        }
    }

    function closeEditModal() {
        document.getElementById('editTenantModal').style.display = 'none';
    }

    document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('submitBtn').addEventListener('click', function (event) {
        event.preventDefault(); // Prevent default form submission

        const form = event.target.closest('form');
        const formData = new FormData(form);
        
        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
            body: formData,
        })
        .then(response => response.json().then(data => ({
            status: response.status,
            body: data
        })))
        .then(({status, body}) => {
            if (status === 409) {
                if (body.occupied) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Occupied',
                        text: 'The selected house and apartment are already occupied.',
                    });
                }
            } else if (status >= 200 && status < 300) {
                if (body.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Tenant added successfully.',
                        toast: true,
                        position: 'top-right',
                        timer: 3000,
                        timeProgressBar: true,
                        showConfirmButton: false,
                        width: '350px',
                        padding: '10px'
                    }).then(() => {
                        window.location.reload();
                    });
                }
            } else {
                throw new Error('Unexpected response');
               
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred. Please try again.',
            });
            window.loaction.reload()
        });
    });
});

</script>

