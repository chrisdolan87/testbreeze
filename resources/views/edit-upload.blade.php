<x-app-layout>
    <x-genre-menu :genres="$genres"/>

    <section class="w-full min-h-min h-full mx-auto p-8 flex flex-col md:items-start sm:items-center bg-white gap-8">
        <div class="max-w-5xl w-full mx-auto p-8 flex flex-col gap-8">
            <div
                class="max-w-5xl w-full min-h-min h-full mx-auto px-16 py-8 flex flex-col rounded-3xl bg-slate-100 border border-gray-300 shadow-md shadow-slate-700">
                <form class="flex flex-col min-h-min h-fit" method="POST" action="/upload/update/{{ $book->id }}"
                    enctype="multipart/form-data">
                    @csrf

                    <!-- Title -->
                    <div>
                        <x-input-label for="title" :value="__('Book Title')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                            value="{{ $book->title }}" required autofocus autocomplete="title" />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <!-- Author -->
                    <div class="mt-4">
                        <x-input-label for="author" :value="__('Author')" />
                        <x-text-input id="author" class="block mt-1 w-full" type="text" name="author"
                            value="{{ $book->author->name }}" required />
                        <x-input-error :messages="$errors->get('author')" class="mt-2" />
                    </div>

                    <!-- Genre -->
                    <div class="mt-4">
                        <x-input-label for="genre" :value="__('Genre')" />
                        <x-text-input id="genre" class="block mt-1 w-full" type="text" name="genre"
                            value="{{ $book->genre->name }}" required />
                        <x-input-error :messages="$errors->get('genre')" class="mt-2" />
                    </div>

                    <!-- Description -->
                    <div class="mt-4">
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea id="description" class="block mt-1 w-full" type="textarea" rows="10" cols="80" name="description"
                            value="" required>{{ $book->description }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <!-- Image -->
                    <div class="mt-4">
                        <x-input-label for="image" :value="__('Image')" />
                        <x-text-input id="image" class="block mt-1 w-full p-2" type="file" name="image"
                            accept="image/*" :value="old('image')" />
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>

                    <!-- Price -->
                    <div class="mt-4">
                        <x-input-label for="price" :value="__('Price')" />
                        <x-text-input id="price" class="block mt-1 w-full" type="number" name="price"
                            value="{{ $book->price }}" step="0.01" min="0" required />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>

                    <!-- Submit -->
                    <div class="flex items-center justify-end mt-8">
                        <x-submit-button text="Update Book" class="bg-green-300 border-green-400 hover:bg-green-200" />
                    </div>
                </form>
            </div>

            <div class="max-w-5xl w-full mx-auto">
                <x-back-button />
            </div>
        </div>

    </section>
</x-app-layout>
