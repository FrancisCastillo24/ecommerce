<x-admin-layout :breadcrumbs="[
    ['name' => 'Dashboard', 'route' => route('admin.dashboard')],
    ['name' => 'Subcategorías', 'route' => route('admin.subcategories.index')],
    ['name' => $subcategory->name], // Aparece en el sidebar el nombre de la categoría
]">

    <!-- Hay que pasar la subcategoría seleccionada para editar -->
    @livewire('admin.subcategories.subcategory-edit', compact('subcategory'))

</x-admin-layout>
