<x-admin-layout :breadcrumbs="[['name' => 'Dashboard', 'route' => route('admin.dashboard')], ['name' => 'Portadas', 'route' => route('admin.covers.index')], ['name' => 'Nuevo']]">


    <form action="{{ route('admin.covers.store') }}" method="post" enctype="multipart/form-data">

        @csrf

        <figure class="relative mb-4">

            <div class="absolute top-8 right-8">
                <label class="flex items-center px-4 py-2 rounded-lg bg-gray-400 cursor-pointer text-black">
                    <i class="fas fa-camera mr-2"></i>
                    Actualizar imagen
                    <input type="file" class="hidden" accept="image/*" name="image"
                        onchange="previewImage(event, '#imgPreview')">
                </label>
            </div>

            <img src="{{ asset('img/not-image3.jpg') }}" class="h-96 aspect-[3/1] w-full object-cover object-center"
                alt="" id="imgPreview">
        </figure>

        <x-validation-errors class="mb-4"/>

        <div class="mb-4">
            <x-label>Título</x-label>

            <input type="text" name="title" class="w-full" value="{{ old('title') }}"
                placeholder="Por favor ingrese el título de la portada">
        </div>

        <div class="mb-4">
            <x-label>Fecha de inicio</x-label>

            <input type="date" name="start_at" class="w-full" value="{{ old('start_at', now()->format('Y-m-d')) }}">
        </div>

        <div class="mb-4">
            <x-label>Fecha de fin (opcional)</x-label>

            <input type="date" name="end_at" class="w-full" value="{{ old('end_at') }}">
        </div>

        <div class="mb-4 flex space-x-2">
            <label>
                <x-input type="radio" name="is_active" value="1" checked></x-input>Activo
            </label>

            <label>
                <x-input type="radio" name="is_active" value="0"></x-input>Inactivo
            </label>
        </div>

        <div class="flex justify-end">
            <x-button>Crear portada</x-button>
        </div>

    </form>

    @push('js')
        <script>
            function previewImage(event, querySelector) {

                //Recuperamos el input que desencadeno la acción
                let input = event.target;

                //Recuperamos la etiqueta img donde cargaremos la imagen
                let imgPreview = document.querySelector(querySelector);

                // Verificamos si existe una imagen seleccionada
                if (!input.files.length) return

                //Recuperamos el archivo subido
                let file = input.files[0];

                //Creamos la url
                let objectURL = URL.createObjectURL(file);

                //Modificamos el atributo src de la etiqueta img
                imgPreview.src = objectURL;

            }
        </script>
    @endpush
    
</x-admin-layout>
