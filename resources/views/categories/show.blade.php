<x-app-layout>

    <div class="container py-8">

        <!-- Sin imagenes -->
        <figure class="mb-4">
            <img class="w-full h-80 object-cover object-center" src="{{ asset('images/category-test.jpg') }}" alt="">
        </figure>

        <!-- Con imagenes -->
        {{--<figure class="mb-4">
            <img class="w-full h-80 object-cover object-center" src="{{ Storage::url($category->image) }}" alt="">
        </figure>--}}

        <!-- Componente categoria -->

        @livewire('category-filter', ['category' => $category])

    </div>

</x-app-layout>
