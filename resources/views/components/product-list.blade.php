@props(['product'])

<li class="bg-white rounded-lg shadow mb-4">
    <article class="flex">

        <!--Sin imagenes-->
        <figure>
            <img class="h-48 w-56 object-cover object-center" src="{{ asset('images/product-test.jpg') }}" alt="">
        </figure>

        <!--Con imagenes-->
        {{-- <figure>
            <img class="h-48 w-56 object-cover object-center" src="{{ Storage::url($product->images->first()->url) }}" alt="">
        </figure> --}}

        <div class="flex-1 py-4 px-6 flex-col">
            <div class="flex justify-between mb-4">
                <div>
                    <h1 class="text-lg font-semibold text-gray-700">{{ $product->name }}</h1>
                    <p class="font-bold text-gray-700">MXN$ {{ $product->price }}</p>
                </div>

                <div class="flex items-center">
                    <ul class="flex text-sm">
                        <li><i class="bi bi-star-fill" style="color:#fdcf4b; margin-right: 5px;"></i></li>
                        <li><i class="bi bi-star-fill" style="color:#fdcf4b; margin-right: 5px;"></i></li>
                        <li><i class="bi bi-star-fill" style="color:#fdcf4b; margin-right: 5px;"></i></li>
                        <li><i class="bi bi-star-fill" style="color:#fdcf4b; margin-right: 5px;"></i></li>
                        <li><i class="bi bi-star-fill" style="color:#fdcf4b; margin-right: 5px;"></i></li>
                    </ul>

                    <span class="text-gray-700 text-sm">(24)</span> <!-- Pendiente Completa -->

                </div>

            </div>

            <div class="mt-10">
                <x-danger-link class="mt-10" href="{{ route('products.show', $product) }}">
                    Más información
                </x-danger-link>
            </div>
        </div>

    </article>
</li>
