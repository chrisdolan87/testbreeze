<div class="w-full mx-auto flex justify-center bg-yellow-400 ">

    <div class="max-w-7xl w-full mx-auto px-2 flex justify-between overflow-auto">
        @foreach ($genres as $genre)
            <a class="genreLink px-4 py-2 text-center content-center hover:text-yellow-400 hover:underline" href="/genres/{{ $genre->slug }}">{{ $genre->name }}</a>
        @endforeach
    </div>

</div>

<style>
    .genreLink:hover {
        background-color:#00242A;
    }
</style>
