    <?php
    $links = [
        [
            'icon' => 'fa-solid fa-gauge',
            'name' => 'Dashboard',
            'route' => 'admin.dashboard',
            'active' => request()->routeIs('admin.dashboard'),
        ],

        // Array de clases
        [
            // Familia de productos
            'name' => 'Familias',
            'icon' => 'fa-solid fa-box-open',
            'route' => 'admin.families.index',
            'active' => request()->routeIs('admin.families.*'),
        ],
        [
            // Familia de opciones
            'name' => 'Opciones',
            'icon' => 'fa-solid fa-cog',
            'route' => 'admin.options.index',
            'active' => request()->routeIs('admin.options.*'),
        ],
        [
            // Familia de categorias
            'name' => 'Categorias',
            'icon' => 'fa-solid fa-tags',
            'route' => 'admin.categories.index',
            'active' => request()->routeIs('admin.categories.*'),
        ],
        [
            // Familia de subcategorias
            'name' => 'Subcategorias',
            'icon' => 'fa-solid fa-tag',
            'route' => 'admin.subcategories.index',
            'active' => request()->routeIs('admin.subcategories.*'),
        ],
        [
            // Familia de productos
            'name' => 'Productos',
            'icon' => 'fa-solid fa-box',
            'route' => 'admin.products.index',
            'active' => request()->routeIs('admin.products.*'),
        ],
                [
            // Familia de covers (imagenes)
            'name' => 'Portadas',
            'icon' => 'fa-solid fa-images',
            'route' => 'admin.covers.index',
            'active' => request()->routeIs('admin.covers.*'),
        ],

    ];
    ?>

    <aside id="logo-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-[100dvh] pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0"
        :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
            <ul class="space-y-2 font-medium">

                @foreach ($links as $link)
                <li>
                    <a href="{{ route($link['route']) }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100group {{ $link['active'] ? 'bg-gray-100' : '' }}">

                        <span class="inline-flex w-6 h-6 justify-content-center items-center">
                            <i class="{{ $link['icon'] }}"></i>
                        </span>

                        <span class="ms-3">{{ $link['name'] }}</span>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </aside>