<x-app-layout>
    <section
        class="max-w-6xl min-h-min h-full my-8 px-8 py-8 flex flex-col rounded-3xl bg-gray-100 border border-gray-300 shadow-lg shadow-gray-300">
        <form class="flex flex-col" method="POST" action="/review/post/{{ $book_id }}">
            @csrf

            <!-- Rating -->
            <div>
                <x-input-label for="rating" :value="__('Rating')" class="" />
                <input class="w-24 text-center rounded-xl pl-6 border-gray-300" type="number" name="rating" :value="old('rating')" min="1"
                    max="5">
            </div>

            <!-- Review text -->
            <div class="mt-4">
                <x-input-label for="review" :value="__('Review')" />
                <textarea id="review" class="block mt-1 w-full rounded-xl border-gray-300" type="textarea" rows="10" cols="80"
                    name="review" :value="old('review')" required></textarea>
                <x-input-error :messages="$errors->get('review')" class="mt-2" />
            </div>

            <!-- Submit -->
            <div class="flex items-center justify-end mt-4">
                <x-submit-button text="Post Review" class="bg-green-300 border-green-400 hover:bg-green-200" />
            </div>
        </form>
    </section>

    <div class="max-w-6xl my-8">
        <x-back-button />
    </div>

</x-app-layout>
