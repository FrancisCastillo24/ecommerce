<x-admin-layout :breadcrumbs="[
    ['name' => 'Dashboard', 'route' => route('admin.dashboard')],
    ['name' => 'Familias'],
]">

    @if ($families->count())

    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-700 bg-white border border-gray-200">
            <thead class="text-xs uppercase bg-gray-100 text-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3 border-b border-gray-200">ID</th>
                    <th scope="col" class="px-6 py-3 border-b border-gray-200">Name</th>
                    <th scope="col" class="px-6 py-3 border-b border-gray-200">Operaciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($families as $family)
                <tr class="border-b border-gray-200 bg-white">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ $family->id }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $family->name }}
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.families.edit', $family) }}" class="text-blue-600 hover:underline">Editar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{$families->links()}}
        </div>

        @else

        <div class="flex items-center p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50" role="alert">
            <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">Info alert!</span> Todavía no hay familias de registros agregadas
            </div>
        </div>

        @endif


    </div>

</x-admin-layout>