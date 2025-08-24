<x-admin-layout :breadcrumbs="[
    ['name' => 'Dashboard', 'route' => route('admin.dashboard')],
    ['name' => 'Productos', 'route' => route('admin.products.index')],
    ['name' => $product->name], // Aquí muestro en el cabecera el nombre de la familia que hemos seleccionado a editar
]">

    <!--Creamos un componente desde la consola de comandos para editar los productos-->
    @livewire('admin.products.product-edit', ['product' => $product])
</x-admin-layout>