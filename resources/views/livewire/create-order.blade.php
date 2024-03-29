<div class="container py-8 grid grid-cols-5 gap-6">
    <div class="col-span-3">

        <div class="bg-white rounded-lg shadow p-6">
            <div class="mb-4">
                <x-jet-label value="Nombre de contacto" />
                <x-jet-input type="text"
                            wire:model.defer="contact"
                            placeholder="Ingrese el nombre de la persona que recibira el producto"
                            class="w-full" />
                <x-jet-input-error for="contact" />
            </div>

            <div>
                <x-jet-label value="Telefono de contacto" />
                <x-jet-input type="text"
                            wire:model.defer="phone"
                            placeholder="Ingrese un numero de telefono de contacto"
                            class="w-full" />
                <x-jet-input-error for="phone" />
            </div>
        </div>

        <div x-data="{ shipping_type: @entangle('shipping_type') }">

            <p class="mt-6 mb-3 text-lg text-gray-700 font-semibold">Envios</p>

            <label class="bg-white rounded-lg shadow px-6 py-4 flex items-center mb-4">
                <input x-model="shipping_type" type="radio" value="1" name="shipping_type" class="text-gray-600">
                <span class="ml-2 text-gray-700">
                    Recojo en tienda (Calle falsa 123)
                </span>

                <span class="font-semibold text-gray-700 ml-auto">
                    Gratis
                </span>
            </label>

            <div class="bg-white rounded-lg shadow">
                <label class="px-6 py-4 flex items-center">
                    <input x-model="shipping_type" type="radio" value="2" name="shipping_type" class="text-gray-600">
                    <span class="ml-2 text-gray-700">
                        Envio a domicilio
                    </span>
                </label>

                <div class="px-6 pb-6 grid grid-cols-2 gap-6 hidden" :class="{ 'hidden' : shipping_type != 2 }">
                    <!--Departamentos-->
                    <div>
                        <x-jet-label value="Departamento" />

                        <select class="form-control w-full" wire:model="department_id">

                            <option value="" disabled selected>Seleccione un departamento</option>

                            @foreach ($departments as $department)
                                <option value="{{$department->id}}">{{$department->name}}</option>

                            @endforeach
                        </select>

                        <x-jet-input-error for="department_id" />
                    </div>

                    <!--Ciudades-->
                    <div>
                        <x-jet-label value="Ciudad" />

                        <select class="form-control w-full" wire:model="city_id">

                            <option value="" disabled selected>Seleccione una ciudad</option>

                            @foreach ($cities as $city)
                                <option value="{{$city->id}}">{{$city->name}}</option>

                            @endforeach
                        </select>

                        <x-jet-input-error for="city_id" />
                    </div>

                    {{--Distritos--}}
                    <div>
                        <x-jet-label value="Distrito" />

                        <select class="form-control w-full" wire:model="district_id">

                            <option value="" disabled selected>Seleccione un distrito</option>

                            @foreach ($districts as $district)
                                <option value="{{$district->id}}">{{$district->name}}</option>

                            @endforeach
                        </select>

                        <x-jet-input-error for="district_id" />
                    </div>

                    <div>
                        <x-jet-label value="Dirección" />
                        <x-jet-input class="w-full" wire:model="address" type="text" />
                        <x-jet-input-error for="address" />
                    </div>

                    <div class="col-span-2">
                        <x-jet-label value="Referencia" />
                        <x-jet-input class="w-full" wire:model="references" type="text" />
                        <x-jet-input-error for="references" />
                    </div>
                </div>
            </div>
        </div>

        <div>
            <x-jet-button
                wire:loading.attr="disabled"
                wire:target="create_order"
                class="mt-6 mb-4"
                wire:click="create_order">
                Continuar con la compra
            </x-jet-button>

            <hr>
            <!--Aqui va un texto random donde iria la politica y privacidad-->
            <p class="text-sm text-gray-700 mt-2">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Labore ad quam magni autem pariatur exercitationem qui doloribus quidem expedita, earum, dolores repellat eius magnam numquam quo molestiae tempora odio dignissimos! <a href="" class="font-semibold text-yellow-500">Politicas y privacidad</a></a></p>
        </div>

    </div>

    <div class="col-span-2">
        <div class="bg-white rounded-lg shadow p-6">
            <ul>
                @forelse (Cart::content() as $item)
                    <li class="flex py-2 border-b border-gray-200">
                        <img class="h-15 w-20 object-cover mr-4" src="{{$item->options->image}}" alt="">
                        <article class="flex-1">
                            <h1 class="font-bold">{{$item->name}}</h1>

                            <div class="flex">
                                <p>Cant: {{$item->qty}}</p>

                                <!-- ¿Tiene color? -->
                                @isset($item->options['color'])
                                    <p class="ml-2">- Color: {{__($item->options['color'])}}</p>
                                @endisset

                                <!-- ¿Tiene talla? -->
                                @isset($item->options['size'])
                                    <p class="ml-2">{{__($item->options['size'])}}</p>
                                @endisset

                            </div>

                            <p>MXN {{$item->price}}</p>
                        </article>
                    </li>
                @empty
                    <li class="py-6 px-4">
                        <p class="text-center text-gray-600">
                            No tiene agregado ningun item en el carrito
                        </p>
                    </li>
                @endforelse
            </ul>

            <hr class="mt-4 mb-3">

            <div class="text-gray-700">
                <p class="flex justify-between items-center">
                    Subtotal
                    <span class="font-semibold">{{Cart::subtotal()}} MXN</span>
                </p>

                <p class="flex justify-between items-center">
                    Envio
                    <span class="font-semibold">
                        @if ($shipping_type == 1    /* ¿El tipo de envio es a paqueteria? */
                            || $shipping_cost == 0) <!-- ¿El costo de envio es 0? -->
                            Gratis
                        @else
                            {{$shipping_cost}} MXN
                        @endif
                    </span>
                </p>

                <hr class="mt-4 mb-3">

                <p class="flex justify-between items-center font-semibold">
                    <span class="text-lg">Total</span>
                    @if ($shipping_type == 1)   <!-- ¿El tipo de envio es a paqueteria? -->
                        {{Cart::subtotal()}} MXN
                    @else
                        {{Cart::subtotal() + $shipping_cost}} MXN
                    @endif

                </p>

            </div>
        </div>
    </div>
</div>
