@extends('layout')


@section('content')
    <div class=" container mx-auto">
          <div class="mt-6">
            <div class="w-full flex items-center justify-between">
                <h2 class="text-xl font-semibold text-gray-700 leading-tight">Users</h2>
                <button class=" w-52 h-10 flex items-center bg-green-700  p-2 rounded-md shadow-2 cursor-pointer outline"  onclick="openModal()"><i class="fas fa-plus"></i> <h2>Add Tennant</h2></button>
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
    <div id="addTenantModal" class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-black bg-opacity-50 hidden">
      
      <form action="/tennant" method="POST">
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
                  <div class="flex flex-col">
                    <label class="leading-loose">Name</label>
                    <input type="text" name="tenant_name" class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="Name">
                      <div class="text-red-500 mt-2 text-sm">
                        @error('tenant_name')
                            {{ $message }}
                        @enderror
                      </div>
                  </div>
                  <div class="">
                    <label for="House" class="block text-sm font-medium text-gray-700">Houses</label>
                    <select name="house" id="house" class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="Select a House" >
                        <option value="A">House A</option>
                        <option value="B">House B</option>
                        <option value="C">House C</option>
                        <option value="S">Stores</option>
                        {{-- <option value="">Other</option> --}}
                    </select>
      
                    <div class="mb-4">
                        <label for="Appartment" class="block text-sm font-medium text-gray-700">Appartments</label>   
                    <select name="Appartment" id="Appartment" class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="Select a House" >
                        <option value="1">Appartment 1</option>
                        <option value="2">Appartment 2</option>
                        <option value="3">Appartment 3</option>
                        <option value="4">Appartment 4</option>
                        <option value="5">Appartment 5</option>
                        <option value="6">Appartment 6</option>
                        <option value="7">Appartment 7</option>
                        <option value="8">Appartment 8</option>
                        <option value="9">Appartment 9</option>
                        <option value="10">Appartment 10</option>
                        <option value="11">Appartment 11</option>
                        <option value="12">Appartment 12</option>
                        
                        {{-- <option value="">Other</option> --}}
                    </select>
                  </div>
                  
                
                  <div class="flex items-center space-x-4">
                    <div class="flex flex-col">
                      <label class="leading-loose">Start</label>
                      <div class="relative focus-within:text-gray-600 text-gray-400">
                        <input type="text" class="pr-4 pl-10 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="25/02/2020">
                        <div class="absolute left-3 top-2">
                          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                      </div>
                    </div>
                    <div class="flex flex-col">
                      <label class="leading-loose">End</label>
                      <div class="relative focus-within:text-gray-600 text-gray-400">
                        <input type="text" class="pr-4 pl-10 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="26/02/2020">
                        <div class="absolute left-3 top-2">
                          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="flex flex-col mt-20">
                    <label class="leading-loose">Amount</label>
                    <div class="relative gap-8">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none ">&#x20B5;
                        </span>
                        <input type="text" value="" class="px-8 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="Amount">
                    </div>
                  </div>
                </div>
                <div class="pt-4 flex items-center space-x-4">
                    <button class="flex justify-center items-center w-full text-gray-900 px-4 py-3 rounded-md focus:outline-none" onclick="closeModal()">
                      <svg class="w-6 h-6 mr-3 bg-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg> Cancel
                    </button>
                    <button type="submit" id="submitBtn" class="bg-blue-500 flex justify-center items-center w-full text-white px-4 py-3 rounded-md focus:outline-none">Add Tennant</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection
<script>

// Functions to open and close the modal
function openModal() {
    document.getElementById('addTenantModal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('addTenantModal').classList.add('hidden');
}

document.addEventListener("DOMContentLoaded", function() {
        var form = document.querySelector("form");
        var submitButton = document.getElementById("submitBtn");

        // Function to open and close the modal
        function openModal() {
            document.getElementById('addTenantModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('addTenantModal').classList.add('hidden');
        }

        // Function to check if all required fields are filled
        function checkFields() {
            var isValid = true;
            var requiredFields = form.querySelectorAll("[required]");
            requiredFields.forEach(function(field) {
                if (!field.value) {
                    isValid = false;
                    field.classList.add('border-red-500');
                } else {
                    field.classList.remove('border-red-500');
                }
            });
            submitButton.disabled = !isValid;
            return isValid;
        }

        // Run initial check
        checkFields();

        // Recheck whenever an input field changes
        form.addEventListener("input", checkFields);

        // Handle form submission
        form.addEventListener("submit", function(event) {
            if (!checkFields()) {
                // Prevent default form submission if validation fails
                event.preventDefault();
                alert("Please fill in all required fields.");
            }
        });

        // Add event listeners to open and close modal
        document.getElementById("openModalBtn").addEventListener("click", openModal);
        document.getElementById("closeModalBtn").addEventListener("click", closeModal);
    });

</script>
