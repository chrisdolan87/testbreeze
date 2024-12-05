<div class="max-w-2xl w-full mx-auto -mt-8 flex justify-center">

    <form action="/search" method="get" class="w-full">
        <input class="w-full rounded-xl border border-gray-300 shadow-md shadow-gray-300" type="text" name="search" id="search" placeholder="Search for title, author, genre..." value="{{ request('search') }}">
    </form>

</div>
