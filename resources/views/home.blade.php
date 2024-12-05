<x-app-layout>

    <x-searchbar />

    <section
        class="min-w-fit min-h-min h-full my-8 p-8 rounded-3xl bg-gray-100 border border-gray-300 shadow-lg shadow-gray-300">
        <div class="mb-8 grid lg:grid-cols-5 md:grid-cols-4 sm:grid-cols-3 gap-x-8 gap-y-8">
            @foreach ($books as $book)
            <x-book-card :book="$book" />
            @endforeach
        </div>

        {{ $books->links() }}
    </section>

    <div class="max-w-7xl my-8">
        <x-back-button />
    </div>

</x-app-layout>
