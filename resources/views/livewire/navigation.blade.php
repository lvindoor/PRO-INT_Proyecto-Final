<header class="bg-blue-900 sticky top-0 z-50" x-data="dropdown()">
    <!--Contenedor de menu-->
    <div class="container flex items-center h-16 justify-between md:justify-start">
        <a href="/" class="mx-6">
            <!--SpeedyLogo-->
            <x-jet-application-mark />
        </a>

        <!--Revisar como cambiar el color del texto-->
        <!--Boton Categorias-->
        <a :class="{ 'bg-white text-yellow-500': open }" x-on:click="show()"
            class="flex flex-col items-center justify-center px-6 md:px-4 bg-transparent text-white cursor-pointer font-semibold h-full">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <span class="text-sm hidden md:block">Categorías</span>
        </a>

        <!--Manda llamar el buscador-->
        <div class="flex-1 hidden md:block">
            @livewire('search')
        </div>

        <!--Opciones de sesion-->
        <div class="mx-6 relative hidden md:block">
            <!--Sesion Iniciada-->
            @auth
                <x-jet-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                            <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                                alt="{{ Auth::user()->name }}" />
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Gestionar Cuenta') }}
                        </div>

                        <x-jet-dropdown-link href="{{ route('profile.show') }}">
                            {{ __('Perfil') }}
                        </x-jet-dropdown-link>

                        <x-jet-dropdown-link href="{{ route('orders.index') }}">
                            Mis ordenes
                        </x-jet-dropdown-link>

                        <div class="border-t border-gray-100"></div>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf

                            <x-jet-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                {{ __('Cerrar Sesión') }}
                            </x-jet-dropdown-link>
                        </form>
                    </x-slot>
                </x-jet-dropdown>

                <!--invitado-->
            @else
                <x-jet-dropdown align="right" width="48">

                    <x-slot name="trigger">
                        <i class="fas fa-user-circle text-white text-2xl cursor-pointer"></i>
                    </x-slot>

                    <x-slot name="content">
                        <x-jet-dropdown-link href="{{ route('login') }}">
                            {{ __('Iniciar Sesión') }}
                        </x-jet-dropdown-link>

                        <x-jet-dropdown-link href="{{ route('register') }}">
                            {{ __('Registrate') }}
                        </x-jet-dropdown-link>

                    </x-slot>

                </x-jet-dropdown>

            @endauth
        </div>

        <div class="hidden md:block">
            @livewire('dropdown-cart')
        </div>

    </div>

    <!--Menu de categorias-->
    <!--Cambie : class="{'block': open, 'hidden': ! open}" por x-show="open" por infuncionalidad-->
    <nav id="navigation-menu" x-show="open" class="bg-gray-700 bg-opacity-25 w-full absolute">
        <!--Menu Computadora-->
        <div class="container h-full hidden md:block">
            <div x-on:click.away="close()" class="grid grid-cols-4 h-full relative">
                <ul class="bg-white">
                    @foreach ($categories as $category)
                        <li class="navigation-link text-gray-500 hover:bg-yellow-500 hover:text-white">
                            <a href="{{route('categories.show', $category)}}" class="py-2 px-4 text-sm flex items-center">
                                <span class="flex justify-center w-9">
                                    {!! $category->icon !!}
                                </span>

                                {{ $category->name }}
                            </a>

                            <div class="navigation-submenu bg-gray-100 absolute w-3/4 h-full top-0 right-0 hidden">
                                <x-navigation-subcategories :category="$category" />
                            </div>
                        </li>
                    @endforeach
                </ul>

                <div class="col-span-3 bg-gray-100">
                    <x-navigation-subcategories :category="$categories->first()" />
                </div>
            </div>
        </div>

        <!--Menu Movil-->
        <div class="bg-white h-full overflow-y-auto">
            <div class="container bg-gray-200 py-3 mb-2">
                @livewire('search')
            </div>

            <ul>
                @foreach ($categories as $category)
                    <li class="text-gray-500 hover:bg-yellow-500 hover:text-white">
                        <a href="{{route('categories.show', $category)}}" class="py-2 px-4 text-sm flex items-center">
                            <span class="flex justify-center w-9">
                                {!! $category->icon !!}
                            </span>

                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>

            <p class="text-gray-500 px-6 my-2">USUARIOS</p>

            <!--Llama la funcionalidad del carrito-->
            @livewire('cart-mobil')

            <!--Caso de sesion iniciada-->
            @auth
                <!--Redirecciona al perfil del usuario-->
                <a href="{{ route('profile.show') }}"
                    class="py-2 px-4 text-sm flex items-center text-gray-500 hover:bg-yellow-500 hover:text-white">
                    <span class="flex justify-center w-9">
                        <!--Icono Bootstrap user-->
                        <i class="bi bi-person"></i>
                    </span>

                    Perfil
                </a>

                <!--Cierra sesion y esconde las opciones anteriores-->
                <a href="" onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit() "
                    class="py-2 px-4 text-sm flex items-center text-gray-500 hover:bg-yellow-500 hover:text-white">
                    <span class="flex justify-center w-9">
                        <!--Icono Bootstrap logout-->
                        <i class="bi bi-box-arrow-right"></i>
                    </span>

                    Cerrar Sesión
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>

                <!--Caso de sesion no iniciada-->
            @else
                <!--Redirige al login-->
                <a href="{{ route('login') }}"
                    class="py-2 px-4 text-sm flex items-center text-gray-500 hover:bg-yellow-500 hover:text-white">
                    <span class="flex justify-center w-9">
                        <!--Icono Bootstrap logout-->
                        <i class="bi bi-person-check"></i>
                    </span>

                    Iniciar Sesión
                </a>

                <!--Redirige al registro-->
                <a href="{{ route('register') }}"
                    class="py-2 px-4 text-sm flex items-center text-gray-500 hover:bg-yellow-500 hover:text-white">
                    <span class="flex justify-center w-9">
                        <i class="bi bi-fingerprint"></i>
                    </span>

                    Registrate
                </a>
            @endauth

        </div>
    </nav>
</header>
