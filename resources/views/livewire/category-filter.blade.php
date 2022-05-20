<div>
    <div class="bg-white rounded-lg shadow-lg mb-6">
        <div class="px-6 py-2 flex justify-between items-center">
            <h1 class="font-semibold text-gray-700 uppercase">
                {{$category->name}}
            </h1>

            <div class="grid grid-cols-5"> <!-- Fallas con grid -->
                <div class="col-span-3"></div> <!-- Toma 3 columnas para dejar 2 columnas (Unica solución) -->
                <div class="rounded-md p-2 {{ $view == 'list' ? 'bg-gray-200' : '' }}"
                    wire:click="$set('view', 'list')">
                    <i class="bi bi-list-task cursor-pointer" style="padding: 5px;"></i>
                </div>
                <div class="rounded-md p-2 {{ $view == 'grid' ? 'bg-gray-200' : '' }}"
                    wire:click="$set('view', 'grid')">
                    <i class="bi bi-border-all cursor-pointer" style="padding: 5px;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 mt-5 gap-6">
        <aside>
            <h2 class="font-semibold text-xl text-center mb-4 pl-2">Subcategorias</h2>
            <ul class="divide-y divide-gray-200">
                @foreach ($category->subcategories as $subcategory)
                    <li class="py-2 pl-3" style="border-bottom: 1px solid #dadada;">
                        <a class="cursor-pointer text-gray-600 hover:text-gray-400 capitalize
                            {{ $subcategoryFilter == $subcategory->name ? 'text-blue-900 font-bold' : '' }} "
                            wire:click="$set('subcategoryFilter','{{$subcategory->name}}')">
                            {{$subcategory->name}}
                        </a>
                    </li>
                @endforeach
            </ul>

            <h2 class="font-semibold text-center mt-4 mb-4 pl-2">Marcas</h2>
            <ul>
                @foreach ($category->brands as $brand)
                    <li class="py-1 pl-3" style="border-bottom: 1px solid #dadada;">
                        <a class="cursor-pointer text-sm text-gray-600 hover:text-gray-400 capitalize
                        {{ $brandFilter == $brand->name ? 'text-blue-900 font-bold' : '' }} "
                        wire:click="$set('brandFilter','{{$brand->name}}')">
                            {{$brand->name}}
                        </a>
                    </li>
                @endforeach
            </ul>

            <x-jet-button class="mt-10" wire:click="clear()">
                Eliminar filtros
            </x-jet-button>

        </aside>

        <div class="md:col-span-2 lg:col-span-3">

            @if ($view == 'grid')

                <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($products as $product)
                        <li class="bg-white rounded-lg shadow">
                            <article>
                                <!--Sin imagenes-->
                                <figure>
                                    <img class="h-48 w-full object-cover object-center" src="{{ asset('images/product-test.jpg') }}" alt="">
                                </figure>

                                <!--Con imagenes-->
                                {{-- <figure>
                                <img class="h-48 w-full object-cover object-center" src="{{ Storage::url($product->images->first()->url) . 'image.jpg' }}" alt="">
                                </figure> --}}

                                <div class="py-4 px-6">
                                    <h1 class="text-lg font-semibold">
                                        <a href="{{ route('products.show', $product) }}">
                                            {{Str::limit($product->name, 20)}}
                                        </a>
                                    </h1>
                                    <p class="font-bold text-gray-700">
                                        MXN$ {{$product->price}}
                                    </p>
                                </div>
                            </article>
                        </li>
                    @endforeach
                </ul>

            @else

                <ul>
                    @foreach ($products as $product)
                        <x-product-list :product="$product" />
                    @endforeach
                </ul>

            @endif

            <div class="mt-4">
                {{$products->links()}}
            </div>

        </div>
    </div>

</div>
