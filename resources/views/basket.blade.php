<x-app-layout>
    <x-genre-menu :genres="$genres"/>

    <x-searchbar />

    <section class="w-full min-h-min h-full mx-auto p-8 flex flex-col md:items-start sm:items-center bg-white gap-8">

        <div class="max-w-5xl w-full mx-auto p-8 flex flex-col">
            <h2 class="text-2xl font-bold mb-8">Your Basket</h2>

            @if (count($basket) > 0)
                <!-- Headings -->
                <div class="w-full flex mb-2 text-lg border-b-2 border-gray-300">
                    <p class="w-5/12 text-left">Book</p>
                    <p class="w-2/12 text-center">Price</p>
                    <p class="w-2/12 text-center">Quantity</p>
                    <p class="w-2/12 text-center">Subtotal</p>
                </div>

                <!-- Books in basket -->
                @php
                    $total = 0;
                @endphp
                
                @foreach ($basket as $item)
                    <x-basket-item :item="$item" />
                    @php
                        $total = $total + $item->quantity * $item->book->price;
                    @endphp
                @endforeach

                <!-- Total -->
                @if (count($basket) > 0)
                <div class="flex justify-end mt-8 text-right font-bold">
                    <p class="pr-8">Total</p>
                    <p>£{{ number_format($total, 2) }}</p>
                </div>
                @endif

                <!-- Checkout button -->
                <div class="w-full flex justify-end mt-8">
                    <form action="#" method="GET">
                        @csrf
                        <x-submit-button text="Checkout" class="bg-green-300 border-green-400 hover:bg-green-200" />
                    </form>
                </div>
            @else
                <p>Your basket is empty</p>
            @endif
            <div class="max-w-5xl w-full mx-auto mt-8">
                <x-back-button />
            </div>
        </div>

    </section>
</x-app-layout>
