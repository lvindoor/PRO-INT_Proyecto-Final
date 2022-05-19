<div wire:init="loadPosts">
    @if (count($products))

        <div class="flexslider carousel" style="background-color: transparent; border: 0px">
            <ul class="slides">

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
        </div>

    @else
        <!-- Cargando -->
        <div class="mb-4 h-48 flex justify-center items-center bg-white shadow-xl border border-gray-100 rounded-lg">
            <img class="h-12 w-12" src="https://pcsupport.lenovo.com/esv4/images/loading.gif" alt="">
        </div>
    @endif
</div>
