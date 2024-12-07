<x-app-layout>
    <x-genre-menu :genres="$genres"/>

    <section class="w-full min-h-min h-full mx-auto p-8 flex flex-col md:items-start sm:items-center bg-white gap-8">
        <div class="max-w-5xl w-full mx-auto p-8 flex flex-col gap-8">
            <div
                class="max-w-5xl w-full min-h-min h-full mx-auto px-16 py-8 flex flex-col rounded-3xl bg-slate-100 border border-gray-300 shadow-md shadow-slate-700">
                <form class="flex flex-col min-h-min h-fit" method="POST" action="/upload/store"
                    enctype="multipart/form-data">
                    @csrf

                    <!-- Title -->
                    <div>
                        <x-input-label for="title" :value="__('Book Title')" />
                        <input id="title" class="block mt-1 w-full rounded-xl" type="text" name="title"
                            :value="old('title')" required autofocus autocomplete="title" />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <!-- Author -->
                    <div class="mt-4">
                        <x-input-label for="author" :value="__('Author')" />
                        <input id="author" class="block mt-1 w-full rounded-xl" type="text" name="author"
                            :value="old('author')" required />
                        <x-input-error :messages="$errors->get('author')" class="mt-2" />
                    </div>

                    <!-- Genre -->
                    <div class="mt-4">
                        <x-input-label for="genre" :value="__('Genre')" />
                        <input id="genre" class="block mt-1 w-full rounded-xl" type="text" name="genre"
                            :value="old('genre')" required />
                        <x-input-error :messages="$errors->get('genre')" class="mt-2" />
                    </div>

                    <!-- Description -->
                    <div class="mt-4">
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea id="description" class="block mt-1 w-full rounded-xl" type="textarea" rows="8" cols="80"
                            name="description" :value="old('description')" required></textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <!-- Image -->
                    <div class="mt-4">
                        <x-input-label for="image" :value="__('Image')" />
                        <input id="image" class="block mt-1 w-full" type="file" name="image" accept="image/*"
                            :value="old('image')" required />
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>

                    <!-- Price -->
                    <div class="mt-4">
                        <x-input-label for="price" :value="__('Price')" />
                        <input id="price" class="block mt-1 w-full rounded-xl" type="number" name="price"
                            :value="old('price')" step="0.01" min="0" required />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>

                    <!-- Submit -->
                    <div class="flex items-center justify-end mt-8">
                        <x-submit-button text="List Book For Sale"
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
