<x-app-layout>

    @php
        /* SDK de Mercado Pago */
        require base_path('vendor/autoload.php');
        /* Agrega Credenciales */
        MercadoPago\SDK::setAccessToken(config('services.mercadopago.token'));

        /* Crea un objetos de preferencia */
        $preference = new MercadoPago\Preference();
        $shipments = new MercadoPago\Shipments();

        /* Crea los items de seleccionados */

        $shipments->cost = $order->shipping_cost;
        $shipments->mode = "not_specified";

        $preference->shipments = $shipments;

        foreach ($items as $product) {
            $item = new MercadoPago\Item();
            $item->title = $product->name;
            $item->quantity = $product->qty;
            $item->unit_price = $product->price;

            $products[] = $item;
        }

        /* Redirigir despues del pago correcto */

        $preference->back_urls = array(
            "success" => route('orders.pay', $order),
            "failure" => "",
            "pending" => "",
        );

        $preference->auto_return = "approved";
        $preference->items = $products;
        $preference->save();


    @endphp

    <div class="grid grid-cols-5 gap-6 container py-8">
        <div class="col-span-3">
            <div class="bg-white rounded-lg shadow-lg px-6 py-4 mb-6">
                <p class="text-gray-700 uppercase">
                    <span class="font-semibold">Número de orden:</span>
                    Orden-{{$order->id}}
                </p>
            </div>


            <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                <div class="grid grid-cols-2 gap-6">

                    <div>
                        <p class="text-gray-700 text-lg font-semibold uppercase">Envío</p>

                        @if ($order->shipping_type == 1) <!-- ¿Envio a paqueteria? -->
                            <p class="text-sm">Los productos deben ser recogidos en tienda</p>
                            <p class="text-sm">Calle falsa 123</p>
                        @else
                            <p class="text-sm">Los productos serán enviados a:</p>
                            <p class="text-sm">{{$order->address}}</p>
                            <p>{{$order->city->name}} - {{$order->district->name}}</p>
                        @endif
                    </div>

                    <div>
                        <p class="text-lg font-semibold uppercase">Datos de contacto</p>
                        <p class="text-sm">Persona que recibirá el producto: {{$order->contact}}</p>
                        <p class="text-sm">Telefono de contacto: {{$order->phone}}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg text-gray-700 shadow-lg p-6 mb-6">
                <p class="text-xl font-semibold mb-4">Resumen</p>

                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Total</th>

                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @foreach ($items as $item)
                            <tr>
                                <td>
                                    <div class="flex">
                                        <!--Sin imagenes-->
                                        <img src="{{ asset('images/product-test.jpg') }}" alt="" class="h-15 w-20 object-cover mr-4">
                                        <!--Con imagenes-->
                                        {{-- <img src="{{ $item->options->image }}" alt="" class="h-15 w-20 object-cover mr-4"> --}}
                                        <article>
                                            <h1 class="font-bold">{{$item->name}}</h1>
                                            <div class="flex text-xs">

                                                @isset ($item->options->color)
                                                    Color: {{__($item->options->color)}}
                                                @endisset

                                                @isset ($item->options->size)
                                                    Color: {{$item->options->size}}
                                                @endisset

                                            </div>
                                        </article>
                                    </div>
                                </td>
                                <td class="text-center">
                                    {{$item->price}} MXN
                                </td>
                                <td class="text-center">
                                    {{$item->qty}}
                                </td>
                                <td class="text-center">
                                    {{$item->price * $item->qty}} MXN
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>

        <div class="col-span-2">
            <div class="bg-white rounded-lg text-gray-700 shadow-lg p-6 ">
                <div class="flex justify-between items-center">
                    <img class="h-12" src="{{ asset('images/payment-methods.png') }}" alt="">
                    <div class="text-gray-700">
                        <p class="text-sm font-semibold">
                            Subtotal: {{ $order->total - $order->shipping_cost }} MXN
                        </p>
                        <p class="text-sm font-semibold">
                            Envío: {{ $order->shipping_cost }} MXN
                        </p>
                        <p class="text-lg font-semibold uppercase">
                            Total: {{ $order->total }} MXN
                        </p>

                        <div class="cho-container"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://sdk.mercadopago.com/js/v2"></script>

    <script>
        /* Agrega credenciales de SDK */
        const mp = new MercadoPago("{{ config('services.mercadopago.key') }}", {
            locale: 'es-AR'
        });

        /* Inicializa el checkout */
        mp.checkout({
            preference: {
                id: '{{ $preference->id }}'
            },
            render: {
                container: '.cho-container', // El boton de Mercado Pago
                label: 'Pagar', // Texto dentro del boton
            }
        });

    </script>

</x-app-layout>
