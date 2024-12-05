<x-app-layout>

    <x-searchbar />

    <section
        class="max-w-6xl min-h-min h-full my-8 p-8 flex flex-col md:items-start sm:items-center rounded-3xl bg-gray-100 border border-gray-200 shadow-lg shadow-gray-300 gap-8">

        <div class="w-full flex flex-col">
            <h2 class="text-2xl mb-4">Your Basket</h2>

            @if (count($basket) > 0)
                <!-- Headings -->
                <div class="w-full pb-2 flex border-b-2 border-gray-300">
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
                <div class="w-full flex justify-end my-8">
                    <form action="#" method="GET">
                        @csrf
                        <x-submit-button text="Checkout" class="bg-green-300 border-green-400 hover:bg-green-200" />
                    </form>
                </div>
            @else
                <p>Your basket is empty</p>
            @endif
        </div>
    </section>

    <div class="my-8">
        <x-back-button />
    </div>

</x-app-layout>
