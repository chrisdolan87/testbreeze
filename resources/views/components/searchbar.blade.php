<div class="w-full p-8 flex justify-center" style="background:#00242A">

    <form action="/search" method="get" class="max-w-2xl w-full">
        <input class="w-full rounded-xl border border-slate-800 shadow shadow-slate-800" type="text" name="search" id="search" placeholder="Search for title, author, genre..." value="{{ request('search') }}">
    </form>

</div>
