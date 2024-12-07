@props(['book'])

<article class="min-w-40 max-w-56 flex flex-col bg-gray-50 border border-gray-300 rounded-xl overflow-hidden shadow-md shadow-slate-800">

    <a class="min-w-40 min-h-56 h-2/3 flex justify-center mt-4" href="/books/{{ $book->slug }}">
        
        <img class="max-w-36 w-full max-h-56 h-full mx-4 object-contain shadow-md shadow-slate-800"
            src="{{ asset('storage/' . $book->image) }}" alt="">
    </a>

    <div class="min-h-1/3 h-fit mb-4 mx-4 mt-2 flex flex-col justify-between grow">
        <div>
            <a class="hover:underline" href="/books/{{ $book->slug }}">
                <p class="sm:text-sm md:text-base font-bold">{{ $book->title }}</p>
            </a>
            
            <a class="hover:underline" href="/authors/{{ $book->author->slug }}">
                <p class="sm:text-xs md:text-sm mb-4">{{ $book->author->name }}</p>
            </a>
        </div>

        <p class="sm:text-xs md:text-base">£{{ number_format($book->price, 2) }}</p>
    </div>

</article>
