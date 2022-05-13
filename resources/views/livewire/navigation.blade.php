<style>
    #navigation-menu{
        height: calc(100vh - 4rem);
    }
</style>

<header class="bg-blue-900 sticky top-0">
    <div class="container flex items-center h-16">
        <a href="/" class="mx-6">
            <x-jet-application-mark />
        </a>

        <a class="flex flex-col items-center justify-center px-4 text-white cursor-pointer font-semibold h-full">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <span>Categorías</span>
        </a>

        @livewire('search')

        <div class="mx-6 relative">
            @auth

                <x-jet-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                            <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
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

                        <div class="border-t border-gray-100"></div>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf

                            <x-jet-dropdown-link href="{{ route('logout') }}"
                                    @click.prevent="$root.submit();">
                                {{ __('Cerrar Sesión') }}
                            </x-jet-dropdown-link>
                        </form>
                    </x-slot>
                </x-jet-dropdown>

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

        @livewire('dropdown-cart')

    </div>

    <nav id="navigation-menu" class="bg-gray-700 bg-opacity-25 w-full absolute">
        <div class="container h-full">
            <div class="grid grid-cols-4 h-full relative">
                <ul class="bg-white">
                    @foreach ($categories as $category)
                        <li class="text-gray-500 hover:bg-yellow-500 hover:text-white">
                            <a href="" class="py-2 px-4 text-sm flex items-center">
                                <span class="flex justify-center w-9">
                                    {!!$category->icon!!}
                                </span>

                                {{$category->name}}
                            </a>

                            <div class="bg-blue-500 absolute w-3/4 h-full top-0 right-0 hidden">
                            </div>
                        </li>
                    @endforeach
                </ul>

                <div class="col-span-3 bg-gray-100">
                    <div class="grid grid-cols-4 py-4 px-4">
                        <div>
                            <p class="text-lg font-bold text-center text-gray-500 mb-3">Subcategorias</p>

                            <ul>
                                @foreach ($categories->first()->subcategories as $subcategory)
                                    <li>
                                        <a href="" class="text-gray-500 inline-block font-semibold py-1 px-4 hover:text-yellow-500">
                                            {{$subcategory->name}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="col-span-3">

                            <img class="h-64 w-full object-cover object-center" src="{{Storage::url($categories->first()->image)}}" alt="">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
