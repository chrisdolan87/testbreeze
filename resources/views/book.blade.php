<x-layout>

    <main
        class="max-w-7xl mx-auto p-6 lg:p-8 bg-gray-100">
        <section class="flex gap-8 mb-4 lg:flex-row sm:flex-col lg:items-stretch sm:items-center">
            <img id="image" class="max-w-60 shadow-lg shadow-gray-500" src="{{ asset('images/' . $book->image) }}"
                alt="">

            <div id="details" class="flex flex-col justify-between my-4">
                <div>
                    <h2 class="text-2xl mb-4">{{ $book->title }}</h2>

                    <h3 class="text-xl mb-8">{{ $book->author }}</h3>

                    <p class="text-md mb-8"><a class="underline hover:no-underline" href="/genres/{{ $book->genre->slug }}">{{ $book->genre->name }}</a></p>

                    <div class="flex mb-8 gap-8">
                        <p>Review Score: <span class="font-bold text-yellow-600">4.5/5</span></p>
                        <p class="w-fit underline hover:no-underline"><a class="underline hover:no-underline"
                                href="#">4 Reviews</a></p>
                    </div>

                    <h3 class="text-2xl mb-4">£{{ $book->price }}</h3>
                </div>

                <div class="flex gap-4 lg:justify-normal sm:justify-center">
                    <button class="w-40 h-10 bg-green-500 rounded-md shadow-gray-400 shadow-md hover:bg-green-600">Add
                        to basket</button>
                        
                    <button class="w-40 h-10 bg-yellow-200 rounded-md shadow-gray-400 shadow-md hover:bg-yellow-300">Add
                        to wish list</button>
                </div>
            </div>
        </section>

        <div class="my-4">{!! $book->description !!}</div>

        <a class="w-min mt-4" href="/"><button
                class="w-40 h-10 bg-gray-200 rounded-md shadow-gray-400 shadow-md hover:bg-gray-300">Go
                Back</button></a>

    </main>

</x-layout>
