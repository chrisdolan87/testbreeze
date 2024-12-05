<x-app-layout>
    <section
        class="min-h-min h-full my-8 p-8 flex flex-col rounded-3xl bg-gray-100 border border-gray-300 shadow-lg shadow-gray-300 gap-8">
        <form class="flex flex-col" method="POST" action="/review/update/{{ $review->id }}">
            @csrf

            <!-- Rating -->
            <div class="my-4">
                <x-input-label for="rating" :value="__('Rating')" />
                <input class="w-24 text-center pl-6" type="number" name="rating" value="{{ $review->rating }}" min="1"
                    max="5">
            </div>

            <!-- Review text -->
            <div class="mt-4">
                <x-input-label for="review" :value="__('Review')" />
                <textarea id="review" class="block mt-1 w-full" type="textarea" rows="10" cols="80" name="review"
                    required>{{ $review->review }}</textarea>
                <x-input-error :messages="$errors->get('review')" class="mt-2" />
            </div>

            <!-- Submit -->
            <div class="flex items-center justify-end mt-8">
                <x-submit-button text="Update Review" class="bg-green-300 border-green-400 hover:bg-green-200" />
            </div>
        </form>
    </section>

    <div class="my-8">
        <x-back-button />
    </div>
</x-app-layout>
