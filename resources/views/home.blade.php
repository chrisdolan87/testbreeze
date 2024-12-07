<x-app-layout>

    <x-genre-menu :genres="$genres"/>

    <x-searchbar />

    <section class="w-full min-h-min h-full mx-auto p-8 flex flex-col md:items-start sm:items-center bg-white gap-8">
        <div class="max-w-6xl w-full mx-auto p-8 flex flex-col gap-8">
            <div class="grid lg:grid-cols-5 md:grid-cols-4 sm:grid-cols-3 gap-8">
                @foreach ($books as $book)
                    <x-book-card :book="$book" />
                @endforeach
            </div>

            {{ $books->links() }}
            <div class="max-w-6xl w-full mx-auto mt-8">
                <x-back-button />
            </div>
        </div>

    </section>

</x-app-layout>
