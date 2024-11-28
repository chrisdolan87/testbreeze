<x-app-layout>

    <x-searchbar />

    <!-- My Books for Sale -->
    <section class="flex flex-col min-h-min h-full bg-gray-100 m-8 p-8 rounded-3xl border border-gray-300 shadow-lg">

        <h2 class="text-2xl mb-8">My Books for Sale</h2>

        @if (session('book-deleted'))
            <div class="p-4 mb-8 bg-green-500 border border-green-700 rounded-xl text-center alert alert-success">ihgvsujhvs
                {{ session('book-deleted') }}
            </div>
        @endif

        @if (count($books) == 0)
            <p>You have no books listed for sale.</p>
        @else
            <div class="mb-8 grid lg:grid-cols-5 md:grid-cols-4 sm:grid-cols-3 gap-x-8 gap-y-8">
                @foreach ($books as $book)
                    <x-book-card :book="$book" />
                @endforeach
            </div>
        @endif

        {{ $books->links() }}

        <div class="w-full flex justify-center">
            <a href="/upload">
                <button
                    class="min-w-40 w-fit h-10 px-8 mx-auto mt-8 bg-green-500 rounded-md shadow-gray-400 shadow-md hover:bg-green-600">
                    List a Book for Sale</button>
            </a>
        </div>
    </section>

    <!-- Wish list -->
    <section class="flex flex-col min-h-min h-full bg-gray-100 m-8 p-8 rounded-3xl border border-gray-300 shadow-lg">
        <h2 class="text-2xl mb-8">My Wish List</h2>

        <div class="mb-8 grid lg:grid-cols-5 md:grid-cols-4 sm:grid-cols-3 gap-x-8 gap-y-8">
            @foreach ($wishlist as $book)
                <x-book-card :book="$book" />
            @endforeach
        </div>

        {{ $wishlist->links() }}
    </section>

</x-app-layout>
