<aside class="flex flex-col lg:w-64 w-16 h-screen px-4 py-8 overflow-y-none bg-white border-r rtl:border-r-0 rtl:border-l dark:bg-gray-900 dark:border-gray-700"> 
    <div class="lg:flex lg:items-center lg:justify-between relative">
        <!-- Image Container -->
        <div class="lg:flex lg:justify-start">
            <a href="#">
                <img class="lg:w-auto lg:h-auto sm:w-auto sm:h-auto" src="{{ url('/rentals.png') }}" alt="">
            </a>
        </div>
        <!-- Menu Bar Container -->
        {{-- <div class="lg:flex lg:justify-end hidden">
            <span class="w-7 absolute top-0 left-2 float-right cursor-pointer ">
                <i class="fas fa-bars" id="sidebarIcon"></i>
            </span>
        </div> --}}
    </div>

    <div class="flex flex-col mt-10 justify-between flex-1 transition-all duration-300">
        <nav>
            <!-- Dashboard -->
            <div class="flex items-center justify-center px-4 py-2 mt-2 text-gray-600 transition-colors duration-300 transform rounded-md dark:text-gray-400 hover:bg-light-blue hover:text-white cursor-pointer" style="color: #012561;">
                <a href="/dashboard" class="flex items-center">
                    <i class="fas fa-home mr-2"></i>
                    <span class="mx-4 font-medium hidden lg:block">Dashboard</span>
                </a>
            </div>      
            <!-- Houses -->
            <div class="apartments-menu-item flex items-center justify-center px-4 py-2 mt-5 text-gray-600 transition-colors duration-300 transform rounded-md dark:text-gray-400 hover:bg-light-blue hover:text-white cursor-pointer" style="color: #012561;">
                <i class="fas fa-building mr-2 p-2"></i> 
                <span class="mx-4 font-medium hidden lg:block">Houses</span>
            </div>
            <ul class="apartments-dropdown h-auto md:w-auto w-10 hidden list-none mt-2 space-y-2 text-sm font-normal text-gray-600 dark:text-gray-300 bg-white border border-gray-200 divide-y divide-gray-100 rounded-lg shadow-lg dark:bg-gray-900 dark:border-gray-700 dark:divide-gray-700 dark:text-gray-400 cursor-pointer">
                <li class="flex items-center px-1 py-1 md:px-4 md:py-2 hover:bg-light-blue hover:text-white cursor-pointer" style="color: #012561;">
                    <i class="fas fa-building mr-2 hidden lg:block"></i>
                    <a href="/house/a" class="flex-1 font-bold">A</a>
                </li>
                <li class="flex items-center px-1 py-1 md:px-4 md:py-2 hover:bg-light-blue hover:text-white cursor-pointer" style="color: #012561;">
                    <i class="fas fa-building mr-2 hidden lg:block"></i>
                    <a href="/house/b" class="flex-1 font-bold">B</a>
                </li>
                <li class="flex items-center px-1 py-1 md:px-4 md:py-2 hover:bg-light-blue hover:text-white cursor-pointer" style="color: #012561;">
                    <i class="fas fa-building mr-2 hidden lg:block"></i>
                    <a href="/house/c" class="flex-1 font-bold">C</a>
                </li>
                <li class="flex items-center px-1 py-1 md:px-4 md:py-2 hover:bg-light-blue hover:text-white cursor-pointer" style="color: #012561;">
                    <i class="fas fa-building mr-2 hidden lg:block"></i>
                    <a href="/house/stores" class="flex-1 font-bold">S</a>
                </li>
            </ul>

            <!-- Tenants -->
            <div class="flex items-center justify-center px-4 py-2 mt-5 text-gray-600 transition-colors duration-300 transform rounded-md dark:text-gray-400 hover:bg-light-blue hover:text-white cursor-pointer" style="color: #012561;">
                <a href="/tennants" class="flex items-center">
                    <i class="fas fa-users mr-2 p-2"></i>
                    <span class="mx-4 font-medium hidden lg:block">Tennants</span>
                </a>
            </div>

            <!-- Finances -->
            <div class="flex items-center justify-center px-4 py-2 mt-5 text-gray-600 transition-colors duration-300 transform rounded-md dark:text-gray-400 hover:bg-light-blue hover:text-white cursor-pointer" style="color: #012561;">
                <a href="/finances" class="flex items-center">
                    <i class="fas fa-chart-bar mr-2 p-2"></i>
                    <span class="mx-4 font-medium hidden lg:block">Finances</span>
                </a>
            </div>

            <!-- Reports -->
            <div class="flex items-center justify-center px-4 py-2 mt-5 mb-12 text-gray-600 transition-colors duration-300 transform rounded-md dark:text-gray-400 hover:bg-light-blue hover:text-white cursor-pointer" style="color: #012561;">
                <a href="#" class="flex items-center">
                    <i class="fas fa-file-alt mr-2 p-2"></i>
                    <span class="mx-4 font-medium hidden lg:block">Reports</span>
                </a>
            </div>

            <!-- Logout -->
            <form action="/logout" method="POST" style="display: inline;">
                @csrf
                <div class="flex items-center justify-center px-4 py-2 mt-32 text-gray-600 transition-colors duration-300 transform rounded-md dark:text-gray-400 hover:bg-light-blue hover:text-white cursor-pointer" style="color: #012561;">
                    <button type="submit" class="flex items-center">
                        <i class="fas fa-sign-out-alt mr-2 p-2"></i>
                        <span class="mx-4 font-medium hidden lg:block">Logout</span>
                    </button>
                </div>
            </form>
        </nav>
    </div>
</aside>

<style>
.apartments-dropdown {
    overflow-y: hidden;
}

.hover\:bg-light-blue:hover {
    background-color: #a9b2c0 !important;
    color: white !important;
}
</style>

<script>
document.querySelector('.apartments-menu-item').addEventListener('click', function(event) {
    event.preventDefault(); 
    var dropdown = document.querySelector('.apartments-dropdown');
    dropdown.classList.toggle('hidden');
});
</script>
