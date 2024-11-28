<x-app-layout>
    <section
        class="min-h-min h-full m-8 p-8 flex flex-col rounded-3xl bg-gray-100 border border-gray-300 shadow-lg gap-8">
        <form class="flex flex-col min-h-min h-fit"
            method="POST" action="/review" enctype="multipart/form-data">
            @csrf

            <!-- Hidden input to pass book id -->
            <input type="hidden" name="book_id" value="{{ $book_id }}"> 
            <input type="hidden" name="book_slug" value="{{ $book_slug }}"> 
            
            <!-- Hidden input to pass rating -->
            <input type="hidden" name="rating" value="1">

            <!-- Rating stars -->
            <div class="my-4">
                <x-input-label for="rating" :value="__('Rating')" />

                <div class="flex mt-2 gap-1">
                    <div class="w-8 h-8 rounded-md bg-contain bg-center bg-no-repeat bg-[url('/storage/app/public/images/star1.png')] hover:bg-[url('/storage/app/public/images/star2.png')]"></div>
                    <div class="w-8 h-8 rounded-md bg-contain bg-center bg-no-repeat bg-[url('/storage/app/public/images/star1.png')] hover:bg-[url('/storage/app/public/images/star2.png')]"></div>
                    <div class="w-8 h-8 rounded-md bg-contain bg-center bg-no-repeat bg-[url('/storage/app/public/images/star1.png')] hover:bg-[url('/storage/app/public/images/star2.png')]"></div>
                    <div class="w-8 h-8 rounded-md bg-contain bg-center bg-no-repeat bg-[url('/storage/app/public/images/star1.png')] hover:bg-[url('/storage/app/public/images/star2.png')]"></div>
                    <div class="w-8 h-8 rounded-md bg-contain bg-center bg-no-repeat bg-[url('/storage/app/public/images/star1.png')] hover:bg-[url('/storage/app/public/images/star2.png')]"></div>
                </div>

            </div>

            <!-- Review text -->
            <div class="mt-4">
                <x-input-label for="review" :value="__('Review')" />
                <textarea id="review" class="block mt-1 w-full" type="textarea" rows="10" cols="80" name="review"
                    :value="old('review')" required></textarea>
                <x-input-error :messages="$errors->get('review')" class="mt-2" />
            </div>

            <!-- Submit -->
            <div class="flex items-center justify-end mt-8">
                <button
                    class="min-w-40 w-fit h-10 px-8 mx-auto bg-green-500 rounded-md shadow-gray-400 shadow-md hover:bg-green-600"
                    type="submit">Post Review</button>
            </div>
        </form>
    </section>
</x-app-layout>
