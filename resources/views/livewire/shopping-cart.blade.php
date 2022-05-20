<div class="container py-8">
    <section class="bg-white rounded-lg shadow-lg p-6 text-gray-700">
        <h1 class="text-lg font-semibold uppercase mb-6">Carro de compras</h1>

        @if (Cart::count()) <!-- ¿Tenemos productos en el carrito de compras? -->

            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th></th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (Cart::content() as $item)
                        <tr>
                            <td>
                                <div class="flex">
                                    <!--Sin imagenes-->
                                    <img class="h-15 w-20 object-cover mr-4" src="{{ asset('images/product-test.jpg') }}" alt="">
                                    <!--Con imagenes-->
                                    {{-- <img class="h-15 w-20 object-cover mr-4" src="{{ $item->options->image }}" alt=""> --}}
                                    <div>
                                        <p class="font-bold">{{ $item->name }}</p>

                                        @if ($item->options->color) <!-- ¿Almacena un color? -->
                                            <span>
                                                Color: {{ __($item->options->color) }}
                                            </span>
                                        @endif

                                        @if ($item->options->size) <!-- ¿Almacena una talla? -->
                                            <span class="mx-1">-</span>
                                            <span>
                                            {{ __($item->options->size) }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <td class="text-center">
                                <span>MXN {{ $item->price }}</span>
                                <x-danger-link class="ml-4"
                                    wire:click="delete('{{$item->rowId}}')"
                                    wire:loading.class="opacity-25"
                                    wire:target="delete('{{$item->rowId}}')">
                                    <i class="bi bi-trash3-fill"></i>
                                </x-danger-link>
                            </td>

                            <td>
                                <div class="flex justify-center">
                                    @if ($item->options->size) <!-- ¿El producto tiene talla? -->
                                        @livewire('update-cart-item-size', ['rowId' => $item->rowId], key($item->rowId))
                                    @elseif ($item->options->color) <!-- ¿El producto tiene color? -->
                                        @livewire('update-cart-item-color', ['rowId' => $item->rowId], key($item->rowId))
                                    @else <!-- Producto común -->
                                        @livewire('update-cart-item', ['rowId' => $item->rowId], key($item->rowId))
                                    @endif
                                </div>
                            </td>

                            <td class="text-center">
                                MXN {{ $item->price * $item->qty }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <a class="text-sm cursor-pointer hover:underline mt-3 inline-block"
                wire:click="destroy">
                <i class="bi bi-trash3-fill"></i>
                Borrar carrito de compras
            </a>
        @else

            <div class="flex flex-col items-center">
                <x-cart color='#312e81' size='40' />
                <p class="text-lg text-gray-700 mt-4 uppercase">
                    Tu carro de compras está vacío
                </p>
                <x-button-link class="mt-4 w-60 font-bold shadow" href="/"
                    style="background-color: #fdcf4b; color: #464646;">
                    Ir al inicio
                </x-button-link>
            </div>

        @endif

    </section>

    @if (Cart::count()) <!-- ¿Tenemos productos en el carrito de compras? -->
        <div class="bg-white rounded-lg shadow-lg px-6 py-4 mt-4">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-700">
                        <span class="font-bold text-lg">Total:</span>
                        MXN {{ Cart::subTotal() }}
                    </p>
                </div>
                <div>
                    <x-button-link color='blue'>
                        Continuar
                    </x-button-link>
                </div>
            </div>
        </div>
    @endif

</div>
