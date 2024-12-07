<x-app-layout>
    <x-genre-menu :genres="$genres"/>

    <x-searchbar />

    <section class="w-full min-h-min h-full mx-auto p-8 flex flex-col md:items-start sm:items-center bg-white gap-8">

        <div class="max-w-6xl w-full mx-auto p-8 flex flex-col">
            <h2 class="text-2xl mb-4">Customer Reviews</h2>

            @if (count($reviews) > 0)
                @foreach ($reviews as $review)
                    <div class="w-full flex flex-col py-8 gap-2 border-t border-gray-400">
                        <p class="mb-2">Rating: <span class="font-bold text-yellow-600">{{ $review->rating }}/5</span>
                        </p>
                        <p class="w-fit mb-4">{{ $review->review }}</p>
                        <p class="text-xs">Reviewed by {{ $review->user->username }} on
                            {{ $review->created_at->format('d F Y') }}</p>

                        <!-- Buttons -->
                        @if (Auth::check()) <!-- Check if a user is logged in -->
                            @if ($review->user_id == Auth::user()->id || Auth::user()->is_admin == true)
                                <!-- If the review's user_id == the logged in user's id, display buttons to edit/delete the review -->
                                <div class="flex mt-2 gap-4 lg:justify-normal">
                                    <form action="/review/edit/{{ $review->id }}" method="GET">
                                        @csrf
                                        <input type="hidden" name="book_slug" value="{{ $book->slug }}">
                                        <x-submit-button text="Edit Review"
                                            class="bg-yellow-200 border-yellow-300 hover:bg-yellow-100" />
                                    </form>

                                    <form action="/review/delete/{{ $review->id }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <x-submit-button text="Delete Review"
                                            class="bg-red-300 border-red-400 hover:bg-red-200" />
                                    </form>
                                </div>
                            @endif
                        @endif

                    </div>
                @endforeach
            @else
                <p class="w-full flex flex-col py-8">Sorry, no readers have reviewed this book yet.</p>
            @endif

            @if (Auth::check() && $book->user_id != Auth::user()->id && Auth::user()->is_admin == false)
                <form action="/review/create/{{ $book->id }}" method="GET">
                    @csrf
                    <button class="w-full mt-4 pt-8 underline hover:no-underline border-t border-gray-400"
                        type="submit">Leave a Review</button>
                </form>
            @endif
            <div class="max-w-6xl w-full mx-auto mt-8">
                <x-back-button />
            </div>
        </div>


    </section>

</x-app-layout>
