<div>

    <section class="rounded-lg border-gray-100 bg-white shadow-lg">

        <header class="border-b border-gray-200 px-6 py-2">
            <div class="flex justify-between">
                <h1 class="text-lg font-semibold text-gray-700">Opciones</h1>
                <x-button wire:click="$set('openModal', true)">Nuevo</x-button>
            </div>
        </header>

        <div class="p-6">

        </div>

    </section>

    <x-dialog-modal wire:model="openModal">

        <x-slot name="title">Agregar nueva opción</x-slot>
        <x-slot name="content">

            <x-validation-errors class="mb-4"></x-validation-errors>

            <div class="mb-4">
                <x-label class="mb-1">Opción</x-label>
        
                {{-- live para mostrar las opciones en tiempo real, uso change para cuando cambie de opción, se limpie el select valor y no se mantenga con la anterior decisión --}}
                <x-select class="w-full" wire:model.live="variant.option_id" wire:change="updateVariantOptionId">
                    <option value="" disabled>Selecciona una opción</option>

                    @foreach ($options as $option)
                        <option value="{{ $option->id }}">{{ $option->name }}</option>
                    @endforeach

                </x-select>
            </div>

            <div class="flex items-center mb-6">

                <hr class="flex-1">
                <span class="mx-4">Valores</span>
                <hr class="flex-1">

            </div>

            <ul class="mb-4 space-y-4">

                @foreach ($variant['features'] as $index => $feature)
                    {{-- Cada uno tiene sus respectivas llaves --}}
                    <li wire:key="variant-feature-{{ $index }}"
                        class="relative border border-gray-200 rounded-lg p-6">

                        <div class="absolute -top-3 bg-white px-4">
                            <button wire:click="removeFeature({{ $index }})">
                                <i class="fa fa-solid fa-trash-can text-red-500 hover:text-red-600"></i>
                            </button>
                        </div>

                        <div>
                            <x-label class="mb-1">Valores</x-label>
                            {{-- Enlazamos opción y valores con wire:model --}}
                            <x-select class="w-full" wire:model="variant.features.{{ $index }}.id" wire:change="feature_change({{ $index }})">
                                <option value="">Selecciona un valor</option>

                                @foreach ($this->features as $feature)    
                                    <option value="{{ $feature->id }}">{{ $feature->description }}</option>
                                @endforeach

                            </x-select>
                        </div>

                    </li>
                @endforeach

            </ul>

            <div class="flex justify-end">
                <x-button wire:click="addFeature">Agregar valor</x-button>
            </div>

        </x-slot>
        <x-slot name="footer">
            <x-danger-button wire:click="$set('openModal', false)">Cancelar</x-danger-button>
            <x-button class="ml-2" wire:click="save">Guardar</x-button>
        </x-slot>

    </x-dialog-modal>

</div>
