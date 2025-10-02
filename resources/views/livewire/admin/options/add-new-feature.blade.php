<div>

    <form wire:submit="addFeature" class="flex space-x-4">

        <div class="flex-1">

            <x-label class="mb-1">Valor</x-label>

            <!--Elegimos un tipo-->
            @switch($option->type)
                @case(1)
                    <x-input wire:model="newFeature.value" class="w-full" placeholder="Ingrese un valor de la opción"></x-input>
                @break

                @case(2)
                    <div class="border border-gray-300 rounded-md h-[42px] flex items-center justify-between px-3">

                        {{ $newFeature['value'] ?: 'Seleccione un color' }}

                        <input wire:model="newFeature.value" type="color">
                    </div>
                @break

                @default
            @endswitch

        </div>

        <div class="flex-1">
            <x-label class="mb-1">Descripción</x-label>
            <x-input wire:model="newFeature.description" class="w-full" placeholder="Ingrese una descripción"></x-input>
        </div>

        <div class="pt-7">
            <x-button>Agregar</x-button>
        </div>

    </form>

</div>
