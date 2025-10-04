<x-admin-layout :breadcrumbs="[
    ['name' => 'Dashboard', 'route' => route('admin.dashboard')],
    ['name' => 'Productos', 'route' => route('admin.products.index')],
    ['name' => $product->name], // Aquí muestro en el cabecera el nombre de la familia que hemos seleccionado a editar
]">

    <!-- Creamos un componente desde la consola de comandos para editar los productos -->
    <!-- Usamos key para que Livewire sepa que este componente es ÚNICO y no lo confunda con otros que usen el mismo $product -->
    <div class="mb-12">
        @livewire('admin.products.product-edit', ['product' => $product], key('product-edit-' . $product->id))
    </div>

    @livewire('admin.products.product-variants', ['product' => $product], key('variants-' . $product->id))
</x-admin-layout>
