<div>

    <section class="rounded-lg border-gray-100 bg-white shadow-lg mb-12">

        <header class="border-b border-gray-200 px-6 py-2">
            <div class="flex justify-between">
                <h1 class="text-lg font-semibold text-gray-700">Opciones</h1>
                <x-button wire:click="$set('openModal', true)">Nuevo</x-button>
            </div>
        </header>

        <div class="p-6">
            @if ($product->options->count())
                <div class="space-y-6">
                    @foreach ($product->options as $option)
                        <div wire:key="product-option-{{ $option->id }}"
                            class="p-6 rounded-lg border border-gray-200 relative">
                            <div class="absolute -top-3 px-4 bg-white">
                                <button onclick="confirmDeleteOption( {{ $option->id }} )">
                                    <i class="fa-solid fa-trash-can text-red-500 hover:text-red-600"></i>
                                </button>

                                <span class="ml-2">{{ $option->name }}</span>
                            </div>

                            <!-- Valores -->
                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach ($option->pivot->features as $feature)
                                    <div wire:key="option-{{ $option->id }}-feature-{{ $feature['id'] }}">
                                        @switch($option->type)
                                            @case(1)
                                                <span
                                                    class="bg-blue-100 text-blue-800 text-xs font-medium pl-2.5 pr-1.5 py-0.5 rounded-sm">
                                                    {{ $feature['description'] }}

                                                    <button class="ml-0.5"
                                                        onclick="confirmDeleteFeature( {{ $option->id }}, {{ $feature['id'] }})"><i
                                                            class="fa-solid fa-xmark hover:text-red-500"></i></button>
                                                </span>
                                            @break

                                            {{-- Color --}}
                                            @case(2)
                                                <div class="relative inline-block">
                                                    <span
                                                        class="inline-block h-6 w-6 shadow-lg rounded-full border-2 border-gray-300"
                                                        style="background-color: {{ $feature['value'] }};">
                                                    </span>
                                                    <button
                                                        class="absolute -top-2 -right-2 bg-red-500 hover:bg-red-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs shadow"
                                                        onclick="confirmDeleteFeature( {{ $option->id }}, {{ $feature['id'] }})">

                                                    </button>
                                                </div>
                                            @break

                                            {{-- Resto de las opciones --}}

                                            @default
                                        @endswitch
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex items-center p-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                    role="alert">
                    <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-medium">Info alert!</span> ¡No hay opciones para este producto!
                    </div>
                </div>

            @endif

        </div>

    </section>

    <section class="rounded-lg border-gray-100 bg-white shadow-lg">

        <header class="border-b border-gray-200 px-6 py-2">
            <div class="flex justify-between">
                <h1 class="text-lg font-semibold text-gray-700">Variantes</h1>
            </div>
        </header>

        <div class="p-6">
            <ul class="divide-y -my-4">
                @foreach ($product->variants as $item)
                    <li class="py-4 flex items-center">
                        <img src="{{ $item->image }}" class="w-12 h-12 object-cover object-bottom "> 

                        <p class="divide-x">
                            @foreach ($item->features as $feature)
                                <span class="px-3">
                                    {{ $feature->description }}
                                </span>
                            @endforeach
                        </p>

                        <a href="{{ route('admin.products.variants', [$product, $item]) }}" class="ml-auto btn btn-blue">Editar</a>
                    </li>
                @endforeach
            </ul>

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
                            <x-select class="w-full" wire:model="variant.features.{{ $index }}.id"
                                wire:change="feature_change({{ $index }})">
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

    @push('js')
        <script>
            function confirmDeleteFeature(option_id, feature_id) {
                Swal.fire({
                    title: "¿Estás seguro?",
                    text: "¡No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí, bórralo!",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.call('deleteFeature', option_id, feature_id)
                    }
                });
            }

            function confirmDeleteOption(option_id) {
                Swal.fire({
                    title: "¿Estás seguro?",
                    text: "¡No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí, bórralo!",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.call('deleteOption', option_id)
                    }
                });
            }
        </script>
    @endpush

</div>
