<x-app-layout>
    <x-genre-menu :genres="$genres"/>

    <x-searchbar />

    <section class="w-full min-h-min h-full mx-auto p-8 flex flex-col md:items-start sm:items-center bg-white gap-8">

        @if (Auth::user()->is_admin == false)
            <!-- My Books for Sale -->

            <div class="max-w-6xl w-full mx-auto p-8 flex flex-col gap-8">

                <h2 class="text-2xl">My Books for Sale</h2>

                @if (session('book-deleted'))
                    <div
                        class="p-4 mb-8 bg-green-500 border border-green-600 rounded-xl text-center alert alert-success">
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
                        <x-submit-button text="List Book For Sale"
                            class="bg-green-300 border-green-400 hover:bg-green-200" />
                    </a>
                </div>
            </div>


            <!-- Wish list -->

            <div class="max-w-6xl w-full mx-auto p-8 flex flex-col gap-8">
                <h2 class="text-2xl">My Wish List</h2>
                @if (count($wishlist) == 0)
                    <p>Your wishlist is empty.</p>
                @else
                    <div class="mb-8 grid lg:grid-cols-5 md:grid-cols-4 sm:grid-cols-3 gap-x-8 gap-y-8">
                        @foreach ($wishlist as $book)
                            <x-book-card :book="$book" />
                        @endforeach
                    </div>

                    {{ $wishlist->links() }}
                @endif
            </div>
        @else
            <!-- All Users table -->

            <div class="max-w-6xl w-full mx-auto p-8 flex flex-col gap-8">

                <h2 class="text-2xl">All Users</h2>

                <table class="w-full text-left">
                    <tr class="border-b-2 border-gray-300 leading-10">
                        <th class="">Name</th>
                        <th class="">Username</th>
                        <th class="">Email</th>
                        <th class="text-center">Is Admin</th>
                        <th class="text-center">Delete</th>
                    </tr>

                    @foreach ($users as $user)
                        <tr class="leading-10">
                            <td class="">{{ $user->name }}</td>
                            <td class="">{{ $user->username }}</td>
                            <td class="">{{ $user->email }}</td>
                            @if ($user->is_admin == true)
                                <td class="text-center">Yes</td>
                            @else
                                <td class="text-center">No</td>
                            @endif
                            <td class="text-center underline hover:no-underline">
                                <form action="/admin/deleteProfile/{{ $user->id }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="underline hover:no-underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>

                <a class="mt-8 mx-auto" href="/admin/createAdmin"><x-submit-button text="Create New Admin User"
                        class="bg-green-300 border-green-400 hover:bg-green-200" /></a>
            </div>

        @endif

        <div class="max-w-6xl w-full mx-auto p-8">
            <x-back-button />
        </div>
    </section>

</x-app-layout>
