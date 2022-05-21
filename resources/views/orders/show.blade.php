<x-app-layout>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="bg-white rounded-lg shadow-lg px-12 py-8 mb-6 flex items-center">

            <div class="relative">
                <div class="{{ ($order->status >= 2 && $order->status != 5) ? 'bg-blue-400' : 'bg-gray-400'}} {{-- ¿Orden pagada y no anulada? --}}
                     rounded-full h-12 w-12  flex items-center justify-center">
                    <i class="bi bi-check-lg" style="color: white;"></i>
                </div>
                <div class="absolute -left-1.5 mt-0.5">
                    <p>Recibido</p>
                </div>
            </div>

            <div class="{{ ($order->status >= 3 && $order->status != 5) ? 'bg-blue-400' : 'bg-gray-400'}} {{-- ¿Orden enviada y no anulada? --}}
                    h-1 flex-1 mx-2">
            </div>

            <div class="relative">
                <div class="{{ ($order->status >= 3 && $order->status != 5) ? 'bg-blue-400' : 'bg-gray-400'}} {{-- ¿Orden enviada y no anulada? --}}
                    rounded-full h-12 w-12 flex items-center justify-center">
                    <i class="bi bi-truck" style="color: white"></i>
                </div>
                <div class="absolute -left-1 mt-0.5">
                    <p>Enviado</p>
                </div>
            </div>

            <div class="{{ ($order->status >= 4 && $order->status != 5) ? 'bg-blue-400' : 'bg-gray-400'}} {{-- ¿Orden entregada y no anulada? --}}
                h-1 flex-1 mx-2">
            </div>

            <div class="relative">
                <div class="{{ ($order->status >= 4 && $order->status != 5) ? 'bg-blue-400' : 'bg-gray-400'}} {{-- ¿Orden entregada y no anulada? --}}
                    rounded-full h-12 w-12 flex items-center justify-center">
                    <i class="bi bi-check-lg" style="color: white;"></i>
                </div>
                <div class="absolute -left-2 mt-0.5">
                    <p>Entregado</p>
                </div>
            </div>
        </div>

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

</x-app-layout>
