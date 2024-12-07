<x-app-layout>
    <x-genre-menu :genres="$genres"/>

    <x-searchbar />

    <section class="w-full min-h-min h-full mx-auto p-8 flex flex-col md:items-start sm:items-center bg-white gap-8">

        <div class="max-w-5xl w-full mx-auto p-8 flex flex-col gap-8">
            <div class="h-96 flex md:flex-row sm:flex-col gap-8 md:items-start sm:items-center">
                <img class="max-w-72 max-h-96 shadow-md shadow-slate-800" src="{{ asset('storage/' . $book->image) }}"
                    alt="Book image">

                <div class="h-full flex flex-col justify-between">
                    <div class="">
                        <p class="text-2xl mb-2">{{ $book->title }}</p>
                        <p class="text-lg mb-4">By
                            <a class="underline hover:no-underline"
                                href="/authors/{{ $book->author->slug }}">{{ $book->author->name }}</a>
                        </p>
                        <a class="text-md underline hover:no-underline"
                            href="/genres/{{ $book->genre->slug }}">{{ $book->genre->name }}</a>
                    </div>

                    <div>
                        <div class="flex mb-2 gap-8">
                            <p>Rating:
                                <span class="font-bold text-yellow-600">
                                    {{ number_format($book->reviews->avg('rating'), 0) }}/5
                                </span>
                            </p>

                            <a class="underline hover:no-underline"
                                href="/reviews/{{ $book->slug }}">{{ count($book->reviews) }} Reviews</a>
                        </div>

                        @if (Auth::check() && $book->user_id != Auth::user()->id && Auth::user()->is_admin == false)
                            <form action="/review/create/{{ $book->id }}" method="GET">
                                @csrf
                                <button class="w-fit underline hover:no-underline" type="submit">Leave a
                                    Review</button>
                            </form>
                        @endif
                    </div>

                    <div>
                        <p class="text-2xl mb-4">£{{ $book->price }}</p>

                        <p>Seller:
                            <a class="hover:underline"
                                href="/users/{{ $book->user->username }}">{{ $book->user->username }}</a>
                        </p>
                    </div>

                    <!-- Buttons -->
                    @if (Auth::check())
                        <!-- Check if a user is logged in -->
                        @if ($book->user_id == Auth::user()->id || Auth::user()->is_admin == true)
                            <!-- If the book's user_id == the logged in user's id, display buttons to edit/delete the listing -->
                            <div class="flex gap-4 lg:justify-normal sm:justify-center">
                                <form action="/upload/edit/{{ $book->id }}" method="GET">
                                    @csrf
                                    <x-submit-button text="Edit Book"
                                        class="bg-yellow-200 border-yellow-300 hover:bg-yellow-100" />
                                </form>


                                <form action="/upload/delete/{{ $book->id }}" method="POST">
                                    @csrf
                                    <x-submit-button text="Delete Book"
                                        class="bg-red-300 border-red-400 hover:bg-red-200" />
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
                                        <x-submit-button text="Remove from Basket"
                                            class="bg-red-300 border-red-400 hover:bg-red-200" />
                                    </form>
                                @else
                                    <form action="/basket/add/{{ $book->id }}" method="POST">
                                        @csrf
                                        <x-submit-button text="Add to Basket"
                                            class="bg-green-300 border-green-400 hover:bg-green-200" />
                                    </form>
                                @endif

                                <!-- Check if book is already in user's wishlist. If so, render remove button. If not, render add button -->
                                @if (Auth::user()->wishlist->contains($book->id))
                                    <form action="/wishlist/remove/{{ $book->id }}" method="POST">
                                        @csrf
                                        <x-submit-button text="Remove from Wishlist"
                                            class="bg-pink-300 border-pink-400 hover:bg-pink-200" />
                                    </form>
                                @else
                                    <form action="/wishlist/add/{{ $book->id }}" method="POST">
                                        @csrf
                                        <x-submit-button text="Add to Wishlist"
                                            class="bg-pink-300 border-pink-400 hover:bg-pink-200" />
                                    </form>
                                @endif

                            </div>
                        @endif
                    @else
                        <!-- If no user is logged in, display normal buttons -->
                        <div class="flex gap-4 lg:justify-normal sm:justify-center">
                            <form action="/basket/add/{{ $book->id }}" method="POST">
                                @csrf
                                <x-submit-button text="Add to Basket"
                                    class="bg-green-300 border-green-400 hover:bg-green-200" />
                            </form>

                            <form action="/wishlist/add/{{ $book->id }}" method="POST">
                                @csrf
                                <x-submit-button text="Add to Wishlist"
                                    class="bg-pink-300 border-pink-400 hover:bg-pink-200" />
                            </form>
                        </div>
                    @endif
                </div>
            </div>

            <div class="w-full">{!! $book->description !!}</div>
            <div class="max-w-5xl w-full mx-auto mt-8">
                <x-back-button />
            </div>
        </div>

    </section>


</x-app-layout>
