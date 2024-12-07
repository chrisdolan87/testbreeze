@props(['item'])

<div class="w-full flex items-center border-b border-gray-300">
    <!-- Book details -->
    <div class="w-5/12 h-48 flex items-center py-4 gap-8">
        <a class="h-full" href="/books/{{ $item->book->slug }}">
            <img id="image" class="h-full my-auto shadow-md shadow-slate-800"
                src="{{ asset('storage/' . $item->book->image) }}" alt="Book image">
        </a>

        <div class="flex flex-col justify-between">
            <a class="text-md mb-2 font-bold hover:underline"
                href="/books/{{ $item->book->slug }}">{{ $item->book->title }}</a>

            <a class="text-sm mb-4 hover:underline"
                href="/authors/{{ $item->book->author->slug }}">{{ $item->book->author->name }}</a>

            <a class="text-xs mb-8 underline hover:no-underline"
                href="/genres/{{ $item->book->genre->slug }}">{{ $item->book->genre->name }}</a>

            <p class="text-xs">Seller:
                <a class="hover:underline"
                    href="/users/{{ $item->book->user->username }}">{{ $item->book->user->username }}</a>
            </p>
        </div>
    </div>

    <!-- Book price -->
    <p class="w-2/12 text-md text-center">£{{ number_format($item->book->price, 2) }}</p>

    <!-- Quantity controls -->
    <div class="w-2/12 flex text-md justify-center items-center">
        <!-- Decrease quantity button -->
        <form action="{{ route('basket.update', ['item' => $item->id, 'action' => 'decrease']) }}" method="POST">
            @csrf
            <button
                class="bg-gray-50 w-8 h-8 text-xl text-center content-center border-y border-l border-gray-300 rounded-s-lg"
                type="submit">-</button>
        </form>

        <p class="bg-gray-50 w-8 h-8 text-center content-center border border-gray-300">
            {{ $item->quantity }}
        </p>

        <!-- Increase quantity button -->
        <form action="{{ route('basket.update', ['item' => $item->id, 'action' => 'increase']) }}" method="POST">
            @csrf
            <button
                class="bg-gray-50 w-8 h-8 text-xl text-center content-center border-y border-r border-gray-300 rounded-e-lg"
                type="submit">+</button>
        </form>
    </div>

    <!-- Subtotal -->
    <p class="w-2/12 text-md text-center">£{{ number_format($item->quantity * $item->book->price, 2) }}</p>

    <!-- Remove button -->
    <div class="w-1/12 flex justify-end pr-4 hover:underline">
        <form action="/basket/remove/{{ $item->book->id }}" method="POST">
            @csrf
            @method('delete')
            <button class="w-fit flex flex-col justify-center items-center" type="submit">
                <img class="h-6" src="{{ asset('storage/images/trash.png') }}" alt="">
                <p class="text-xs">Remove</p>
            </button>
        </form>
    </div>
</div>
