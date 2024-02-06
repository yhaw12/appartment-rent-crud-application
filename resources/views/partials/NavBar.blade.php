<div class="w-auto flex shadow relative">
    <div class="w-full h-20 flex items-center justify-between px-10  mr-1">
        {{-- <h1 class="">{{ $pageName }}</h1> --}}
        <div class="flex flex-row items-center">
            <div class="inline-flex items-center px-2 justify-between">
                <i class="fas fa-sun"></i>
                <i class="fas fa-moon" onclick="darkMode()"></i>
            </div>

            {{-- <div>{{ $profileName }}</div> --}}
            <svg onclick="toggleDrawer()" id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="w-2.5 h-2.5 ml-2.5 cursor-pointer" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="m1 1 4 4 4-4" />
            </svg>
        </div>
    </div>

    {{-- <div id="dropdown" class="z-10 bg-white divide-y divide-gray-100 rounded-sm w-44 dark:bg-gray-200 absolute top-full right-0 mt-1 shadow-md {{ $openDrawer ? '' : 'hidden' }}"> --}}
        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white text-black"> Dashboard</a></li>
            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white text-black"> Settings </a></li>
            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white text-black">Earnings</a></li>
            {{-- <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white text-black">Sign out</a></li> --}}
        </ul>
    {{-- </div> --}}
</div>
{{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> --}}
    {{-- @csrf --}}
{{-- </form> --}}

