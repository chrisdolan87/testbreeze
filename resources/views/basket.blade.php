<x-app-layout>

    <x-searchbar />

    <section
        class="min-h-min h-full m-8 p-8 flex flex-col md:items-start sm:items-center rounded-3xl bg-gray-100 border border-gray-300 shadow-lg gap-8">

        <div class="w-full flex flex-col">
            <h2 class="text-2xl mb-4">Your Basket</h2>

            <!-- Headings -->
            <div class="w-full pb-2 flex border-b-2 border-gray-300">
                <p class="w-4/12 text-left">Book</p>
                <p class="w-2/12 text-center">Price</p>
                <p class="w-2/12 text-center">Quantity</p>
                <p class="w-2/12 text-right">Subtotal</p>
            </div>

            <!-- Books in basket -->
            @foreach ($basket as $item)
                <x-basket-item :item="$item" />
            @endforeach

        </div>

    </section>

</x-app-layout>
