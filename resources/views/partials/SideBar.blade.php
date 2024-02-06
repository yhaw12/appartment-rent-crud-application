<div class="h-screen flex gap-4 transition-all duration-300">
    <div class="bg-[#01AC9C] w-66 text-gray-100 px-4 duration-300">
        <div class="py-3 flex justify-end">
            <i class="fas fa-bars cursor-pointer" onclick="toggleSidebar()"></i>
        </div>

        <div class="w-full flex items-center justify-center">
            <img class="cursor-pointer w-36" src="{{ asset('dgi-clinics.png') }}" />
        </div>

        <div class="mt-4 mb-auto flex flex-col gap-4 relative">
            @foreach($menus as $menu)
                <div class="group flex flex-col items-start text-sm font-medium p-2 hover:bg-[#F8981D] rounded-md relative">
                    <a href="{{ url($menu['link']) }}">
                        <div onclick="toggleSubMenu('{{ $menu['name'] }}')" class="group flex items-center w-full h-auto scroll-behavior-smooth mb-auto cursor-pointer">
                            <div class="mr-4">
                                <i class="{{ $menu['icon'] }}"></i>
                            </div>
                            <h2 class="whitespace-pre duration-500">
                                {{ $menu['name'] }}
                            </h2>
                            @if($menu['dropdown'])
                                <i class="{{ $openSubMenu === $menu['name'] ? 'fas fa-chevron-down' : 'fas fa-chevron-right' }}"></i>
                            @endif
                        </div>
                    </a>

                    @if($menu['dropdown'] && $openSubMenu === $menu['name'])
                        <div class="pl-6 flex flex-col transition-height duration-700 ease-in-out">
                            @foreach($menu['subMenu'] as $subMenu)
                                <a href="{{ url($subMenu['link']) }}" class="group flex items-center text-sm font-medium px-2 py-1 hover:bg-gray-800 rounded-md">
                                    <h2 class="whitespace-pre duration-500">
                                        {{ $subMenu['name'] }}
                                    </h2>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>

