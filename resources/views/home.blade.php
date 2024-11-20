<x-layout>

    <main class="max-w-7xl mx-auto p-6 lg:p-8 bg-gray-100">
        <div class="flex justify-center">
            <section
                class="w-4/5 min-h-min h-full mx-auto mt-8 mb-16 grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 gap-x-4 gap-y-16">
                @foreach ($books as $book)
                    <a href="/books/{{ $book->slug }}">
                        <article
                            class="flex content-center items-center flex-col justify-between min-h-96 h-full p-4 hover:underline">

                            <img class="mx-auto mb-2 w-3/4 shadow-md shadow-gray-500"
                                src="{{ asset('images/' . $book->image) }}" alt="">
                            <div class="flex flex-col grow w-full justify-between px-2">
                                <div>
                                    <h1 class="text-lg font-bold mt-2">{{ $book->title }}</h1>
                                    <h2 class="text-sm mb-2">{{ $book->author }}</h2>
                                </div>
                                <h2 class="text-lg mb-2">£{{ $book->price }}</h2>
                            </div>
                            <button
                                class="w-full h-10 bg-green-400 rounded-md shadow-gray-400 shadow-md hover:bg-green-500">Add
                                to basket</button>

                        </article>
                    </a>
                @endforeach
            </section>
        </div>
    </main>

</x-layout>
