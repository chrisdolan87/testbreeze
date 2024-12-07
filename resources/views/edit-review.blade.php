<x-app-layout>
    <x-genre-menu :genres="$genres"/>

    <section class="w-full min-h-min h-full mx-auto p-8 flex flex-col md:items-start sm:items-center bg-white gap-8">
        <div class="max-w-5xl w-full mx-auto p-8 flex flex-col gap-8">
            <div
                class="max-w-5xl w-full min-h-min h-full mx-auto px-16 py-8 flex flex-col rounded-3xl bg-slate-100 border border-gray-300 shadow-md shadow-slate-700">

                <form class="flex flex-col" method="POST" action="/review/update/{{ $review->id }}">
                    @csrf

                    <!-- Rating -->
                    <div class="">
                        <x-input-label for="rating" :value="__('Rating')" />
                        <input class="w-24 text-center pl-6" type="number" name="rating" value="{{ $review->rating }}"
                            min="1" max="5">
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
                        <x-submit-button text="Update Review"
                            class="bg-green-300 border-green-400 hover:bg-green-200" />
                    </div>
                </form>
            </div>
            <div class="max-w-5xl w-full mx-auto">
                <x-back-button />
            </div>
        </div>

    </section>
</x-app-layout>
