<div>
    <section class="rounded-lg bg-white shadow-lg">
        <header class="border-b border-gray-200 px-6 py-2">
            <h1 class="text-lg font-semibold text-gray-700">Opciones</h1>
        </header>

        <div class="p-6">
            <div class="space-y-6">
                @foreach ($options as $option)
                <div class="relative p-6 rounded-lg border border-gray-200">
                    <!-- Etiqueta flotante -->
                    <div class="absolute -top-3 left-4 bg-white px-4">
                        <span class="text-gray-600 font-medium">
                            {{ $option->name }}
                        </span>
                    </div>

                    <!-- Valores -->
                    <div class="flex flex-wrap gap-2">
                        @foreach ($option->features as $feature)
                        @switch($option->type)
                        @case(1)
                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-sm">
                            {{ $feature->description }}
                        </span>
                        @break

                        @case(2)
                        <span class="inline-block h-6 w-6 shadow-lg rounded-full border-2 border-gray-300 mr-4" style="background-color: {{ $feature->value }};">

                        </span>
                        @break

                        @default
                        <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded-sm">
                            {{ $feature->description }}
                        </span>
                        @endswitch
                        @endforeach
                    </div>
                </div>
                @endforeach


            </div>
        </div>
    </section>
</div>