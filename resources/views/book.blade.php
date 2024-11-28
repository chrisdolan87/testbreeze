<x-app-layout>

    <x-searchbar />

    <section
        class="min-h-min h-full m-8 p-8 flex flex-col md:items-start sm:items-center rounded-3xl bg-gray-100 border border-gray-300 shadow-lg gap-8">
        <div class="h-full flex md:flex-row sm:flex-col gap-8 md:items-start sm:items-center">
            <img id="image" class="max-w-60 shadow-lg shadow-gray-500" src="{{ asset('storage/' . $book->image) }}"
                alt="">

            <div id="details" class="flex flex-col justify-between gap-8">
                <div>
                    <h2 class="text-2xl mb-2">{{ $book->title }}</h2>

                    <h3 class="text-lg mb-4">
                        <a href="/authors/{{ $book->author->slug }}">By {{ $book->author->name }}</a>
                    </h3>

                    <p class="text-md mb-8">
                        <a class="underline hover:no-underline"
                            href="/genres/{{ $book->genre->slug }}">{{ $book->genre->name }}</a>
                    </p>

                    <div class="flex mb-2 gap-8">
                        <p>Rating:
                            <span class="font-bold text-yellow-600">
                                {{ number_format($book->reviews->avg('rating'), 0) }}/5
                            </span>
                        </p>

                        <p class="w-fit underline hover:no-underline"><a class="underline hover:no-underline"
                                href="/reviews/{{ $book->slug }}">{{ count($book->reviews) }} Reviews</a></p>
                    </div>

                    <form action="/review/create" method="GET">
                        @csrf
                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                        <input type="hidden" name="book_slug" value="{{ $book->slug }}">
                        <button class="w-fit mb-8 underline hover:no-underline" type="submit">Leave a Review</button>
                    </form>

                    <h3 class="text-2xl mb-4">£{{ $book->price }}</h3>
                    <p>Seller: <a class="hover:underline"
                            href="/users/{{ $book->user->username }}">{{ $book->user->username }}</a></p>
                </div>

                <!-- Buttons -->
                @if (Auth::check()) <!-- Check if a user is logged in -->
                    @if ($book->user_id == Auth::user()->id)
                        <!-- If the book's user_id == the logged in user's id, display buttons to edit/delete the listing -->
                        <div class="flex gap-4 lg:justify-normal sm:justify-center">
                            <button
                                class="w-40 h-10 bg-yellow-300 border border-yellow-500 rounded-lg shadow-gray-400 shadow-md hover:bg-yellow-200">
                                Edit Listing</button>

                            <form action="/upload/delete/{{ $book->id }}" method="POST">
                                @csrf
                                <button
                                    class="w-40 h-10 bg-red-400 border border-red-600 rounded-lg shadow-gray-400 shadow-md hover:bg-red-300"
                                    type="submit">
                                    Delete Book</button>
                            </form>
                        </div>
                    @else
                        <!-- If the book does not belong to the logged in user, display normal buttons -->
                        <div class="flex gap-4 lg:justify-normal sm:justify-center">
                            <!-- Check if book is already in user's basket. If so, render remove button. If not, render add button -->
                            @if (Auth::user()->basket()->where('book_id', $book->id)->exists())
                                <form action="/basket/remove/{{ $book->id }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button
                                        class="min-w-40 w-fit h-10 px-4 bg-red-400 border border-red-600 rounded-lg shadow-gray-400 shadow-md hover:bg-red-300"
                                        type="submit">
                                        Remove from basket</button>
                                </form>
                            @else
                                <form action="/basket/add/{{ $book->id }}" method="POST">
                                    @csrf
                                    <button
                                        class="min-w-40 w-fit h-10 px-4 bg-green-500 border border-green-700 rounded-lg shadow-gray-400 shadow-md hover:bg-green-400"
                                        type="submit">
                                        Add to basket</button>
                                </form>
                            @endif

                            <!-- Check if book is already in user's wishlist. If so, render remove button. If not, render add button -->
                            @if (Auth::user()->wishlist->contains($book->id))
                                <form action="/wishlist/remove/{{ $book->id }}" method="POST">
                                    @csrf
                                    <button
                                        class="min-w-40 w-fit h-10 px-4 bg-pink-400 border border-pink-600 rounded-lg shadow-gray-400 shadow-md hover:bg-pink-300"
                                        type="submit">Remove from Wishlist</button>
                                </form>
                            @else
                                <form action="/wishlist/add/{{ $book->id }}" method="POST">
                                    @csrf
                                    <button
                                        class="min-w-40 w-fit h-10 px-4 bg-pink-400 border border-pink-600 rounded-lg shadow-gray-400 shadow-md hover:bg-pink-300"
                                        type="submit">Add to Wishlist</button>
                                </form>
                            @endif

                        </div>
                    @endif
                @else
                    <!-- If no user is logged in, display normal buttons -->
                    <div class="flex gap-4 lg:justify-normal sm:justify-center">
                        <form action="/basket/add/{{ $book->id }}" method="POST">
                            @csrf
                            <button
                                class="min-w-40 w-fit h-10 px-4 bg-green-500 border border-green-700 rounded-lg shadow-gray-400 shadow-md hover:bg-green-400"
                                type="submit">
                                Add to basket</button>
                        </form>

                        <form action="/wishlist/add/{{ $book->id }}" method="POST">
                            @csrf
                            <button
                                class="min-w-40 w-fit h-10 px-4 bg-pink-400 border border-pink-600 rounded-lg shadow-gray-400 shadow-md hover:bg-pink-300"
                                type="submit">Add to Wishlist</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>

        <div class="w-full my-4">{!! $book->description !!}</div>
    </section>

    <a class="w-min mt-4" href="/"><button
            class="min-w-40 w-fit h-10 px-4 mt-8 mx-8 bg-gray-300 border border-gray-500 rounded-lg shadow-gray-400 shadow-md hover:bg-gray-200">
            Go Back</button>
    </a>

</x-app-layout>
