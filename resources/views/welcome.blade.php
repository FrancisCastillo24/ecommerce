<x-app-layout>

    @push('css')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />
        <style>
            body {
                overflow-x: hidden;
            }

            /* Hace que el slider ocupe todo el ancho sin los márgenes del layout */
            .swiper-fullwidth {
                position: relative;
                width: 100vw;
                left: 50%;
                right: 50%;
                margin-left: -50vw;
                margin-right: -50vw;
                max-width: 100vw;
            }

            /* Control de altura */
            .swiper {
                width: 100%;
                height: auto;
            }

            /* Slides con altura fija o proporcional */
            .swiper-slide {
                width: 100%;
                aspect-ratio: 3 / 1; /* ajusta proporción (3:1 → tipo banner) */
            }

            .swiper-slide img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                object-position: center;
                display: block;
            }
        </style>
    @endpush


    <!-- Slider -->
    <div class="swiper swiper-fullwidth mb-12">
        <div class="swiper-wrapper">
            @foreach ($covers as $cover)
                <div class="swiper-slide">
                    <img src="{{ $cover->image }}" alt="">
                </div>
            @endforeach
        </div>

        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>

    <x-container>

        <h1 class="text-2xl font-bold text-gray-700 mb-4">Ultimos productos</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

            @foreach ($lastProducts as $product)
                
                <article class="bg-white shadow rounded overflow-hidden">
                    <img src="{{ $product->image }}" class="w-full h-48 object-cover object-center" alt="">

                    <div class="p-4">
                        <h1 class="text-lg font-bold text-gray-700 line-clamp-2 min-h-[56px] mb-2">{{ $product->name }}</h1>

                        <p class="text-gray-600 mb-4">
                            {{ $product->price }} €
                        </p>

                        <a href="" class="btn btn-blue block w-full text-center">Ver más</a>
                    </div>
                </article>

            @endforeach

        </div>

    </x-container>


    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>

        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const swiper = new Swiper('.swiper', {
                    loop: true,
                    autoplay: {
                        delay: 5000,
                        disableOnInteraction: false,
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                });
            });
        </script>
    @endpush

</x-app-layout>
