<x-app-layout>

    <div class="container py-8">
        @foreach ($categories as $category)
            <section class="mb-6">
                <div class="flex items-center mb-2">
                    <h1 class="text-lg uppercase font-semibold text-gray-700">
                        {{ $category->name }}
                    </h1>
                    <a href="{{route('categories.show', $category)}}" class="text-gray-700 text-sm hover:text-gray-400 hover:underline ml-2 font-semibold">Ver más</a>
                </div>
                @livewire('category-products', ['category' => $categories->first()])
            </section>
        @endforeach
    </div>

    @push('script')

        <script>
            Livewire.on('slider', function() {
                $(document).ready(function() {
                    $('.flexslider').flexslider({
                        animation: "slide",
                        animationLoop: true,
                        itemWidth: 210,
                        itemMargin: 20,
                        minItems: 1,
                        maxItems: 4
                    });
                });
            });
        </script>

    @endpush

</x-app-layout>
