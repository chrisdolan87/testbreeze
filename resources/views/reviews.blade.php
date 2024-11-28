<x-app-layout>

    <x-searchbar />

    <section
        class="min-h-min h-full m-8 p-8 flex flex-col md:items-start sm:items-center rounded-3xl bg-gray-100 border border-gray-300 shadow-lg gap-8">

        <div id="details" class="w-full flex flex-col">
            <h2 class="text-2xl mb-4">Customer Reviews</h2>

            @if (count($reviews) > 0)
                @foreach ($reviews as $review)
                    <div class=" w-full flex flex-col py-8 gap-2 border-t border-gray-400">
                        <p class="mb-2">Rating: <span class="font-bold text-yellow-600">{{ $review->rating }}/5</span>
                        </p>
                        <p class="w-fit mb-4">{{ $review->review }}</p>
                        <p class="text-xs">Reviewed by {{ $review->user->username }} on
                            {{ $review->created_at->format('d F Y') }}</p>

                        <!-- Buttons -->
                        @if (Auth::check())
                            <!-- Check if a user is logged in -->
                            @if ($review->user_id == Auth::user()->id)
                                <!-- If the review's user_id == the logged in user's id, display buttons to edit/delete the review -->
                                <div class="flex mt-2 gap-4 lg:justify-normal">
                                    <form action="/review/edit/{{$review->id}}" method="GET">
                                        @csrf
                                        <input type="hidden" name="book_slug" value="{{ $book->slug }}">
                                        <button
                                            class="w-36 h-8 bg-yellow-300 border border-yellow-500 rounded-lg shadow-gray-400 shadow-md hover:bg-yellow-200"
                                            type="submit">Edit Review</button>
                                    </form>

                                    <form action="/review/delete/{{$review->id}}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" name="book_slug" value="{{ $book->slug }}">
                                        <button
                                            class="w-36 h-8 bg-red-400 border border-red-600 rounded-lg shadow-gray-400 shadow-md hover:bg-red-300"
                                            type="submit">Delete Review</button>
                                    </form>
                                </div>
                            @endif
                        @endif

                    </div>
                @endforeach
            @else
                <p>Sorry, no readers have reviewed this book yet.</p>
            @endif

            <form action="/review/create" method="GET">
                @csrf
                <input type="hidden" name="book_id" value="{{ $book->id }}">
                <input type="hidden" name="book_slug" value="{{ $book->slug }}">
                <button class="w-full mt-4 pt-8 underline hover:no-underline border-t border-gray-400"
                    type="submit">Leave a Review</button>
            </form>

        </div>

    </section>

    <a class="w-min mt-4" href="/books/{{ $book->slug }}"><button
            class="min-w-40 w-fit h-10 px-4 mt-8 mx-8 bg-gray-300 border border-gray-500 rounded-lg shadow-gray-400 shadow-md hover:bg-gray-200">
            Go Back</button>
    </a>

</x-app-layout>
