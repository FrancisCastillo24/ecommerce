    <?php 
        $links = [
            [
                'icon' => 'fa-solid fa-gauge',
                'name' => 'Dashboard',
                'route' => 'admin.dashboard',
                'active' => request()->routeIs('admin.dashboard'),
            ]
        ];
    ?>
    
    <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-[100dvh] pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0" :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
            <ul class="space-y-2 font-medium">

                @foreach ($links as $link)
                    
                
                <li>
                    <a href="{{ route($link['route']) }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100group {{ $link['active'] ? 'bg-gray-100' : '' }}">

                        <span class="inline-flex w-6 h-6 justify-content-center items-center">
                            <i class="{{$link['icon']}}"></i>
                        </span>

                        <span class="ms-3">{{$link['name']}}</span>
                    </a>
                </li>


                @endforeach
            </ul>
        </div>
    </aside>