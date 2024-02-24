<aside class="flex flex-col lg:w-64 w-16  h-screen px-4 py-8 overflow-y-auto bg-white border-r rtl:border-r-0 rtl:border-l dark:bg-gray-900 dark:border-gray-700"> 
    <a href="#">
      <img class="lg:w-auto lg:h-32 sm:h-14 sm:w-14" src="{{ url('/rentals.png') }}" alt="">
  </a>


  <div class="flex flex-col justify-between flex-1 mt-16">
      <nav>
                    <!-- Dashboard -->
        <a class="flex items-center px-4 py-2 text-gray-700 bg-gray-100 rounded-md dark:bg-gray-800 dark:text-gray-200 sm:flex-row sm:items-center" href="/dashboard">
            <i class="fas fa-home mr-2"></i> <!-- FontAwesome home icon -->
            <span class="mx-4 font-medium sm:hidden xl:flex">Dashboard</span>
        </a>

        <!-- Houses -->
        <div class="apartments-menu-item flex items-center px-4 py-2 mt-5 text-gray-600 transition-colors duration-300 transform rounded-md dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700 cursor-pointer">
            <i class="fas fa-building mr-2"></i> <!-- FontAwesome building icon -->
            <span class="mx-4 font-medium sm:hidden xl:block">Houses</span>
        </div>
        <ul class="apartments-dropdown h-auto hidden display:none mt-2 space-y-2 text-sm font-normal text-gray-600 dark:text-gray-300 bg-white border border-gray-200 divide-y divide-gray-100 rounded-lg shadow-lg dark:bg-gray-900 dark:border-gray-700 dark:divide-gray-700">
            <li><a href="/house/a" class="block px-4 py-2">House A</a></li>
            <li><a href="/house/b" class="block px-4 py-2">House B</a></li>
            <li><a href="/house/c" class="block px-4 py-2">House C</a></li>
            <li><a href="/house/stores" class="block px-4 py-2">Stores</a></li>
         </ul>

        <!-- Tennants -->
        <a class="flex items-center px-4 py-2 mt-5 text-gray-600 transition-colors duration-300 transform rounded-md dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700" href="/tennants">
            <i class="fas fa-users mr-2"></i> <!-- FontAwesome users icon -->
            <span class="mx-4 font-medium sm:hidden xl:block">Tennants</span>
        </a>

        <!-- Finances -->
        <a class="flex items-center px-4 py-2 mt-5 text-gray-600 transition-colors duration-300 transform rounded-md dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700" href="/finances">
            <i class="fas fa-chart-bar mr-2"></i> <!-- FontAwesome chart bar icon -->
            <span class="mx-4 font-medium sm:hidden xl:block">Finances</span>
        </a>

        <!-- Reports -->
        <a class="flex items-center px-4 py-2 mt-5  text-gray-600 transition-colors duration-300 transform rounded-md dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700" href="#">
            <i class="fas fa-file-alt mr-2"></i> <!-- FontAwesome file alt icon -->
            <span class="mx-4 font-medium mb-72 sm:hidden xl:block">Reports</span>
        </a>

        <!-- Logout -->
        <button type="submit">
            <a class="flex items-center px-4 py-2 mt-32 text-gray-600 transition-colors duration-300 transform rounded-md dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700" href="/logout">
                <i class="fas fa-sign-out-alt mr-2"></i> <!-- FontAwesome sign out alt icon -->
                <span class="mx-4 font-medium sm:hidden xl:block">Logout</span>
            </a>
        </button>
      </nav>


  </div>
</aside>

<script>
  document.querySelector('.apartments-menu-item').addEventListener('click', function(event) {
  event.preventDefault(); // Prevent the default action
  var dropdown = document.querySelector('.apartments-dropdown');
  dropdown.classList.toggle('hidden'); // Toggle the hidden class
});



</script>