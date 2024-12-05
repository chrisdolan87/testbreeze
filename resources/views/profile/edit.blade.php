<x-app-layout>

    <div
        class="max-w-2xl min-h-min h-full mx-auto -mt-8 px-16 pb-8 flex flex-col rounded-3xl bg-gray-100 border border-gray-300 shadow-lg shadow-gray-300">
        <div class="max-w-xl">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    <div
        class="max-w-2xl min-h-min h-full m-auto px-16 pb-8 flex flex-col rounded-3xl bg-gray-100 border border-gray-300 shadow-lg shadow-gray-300">
        <div class="max-w-xl">
            @include('profile.partials.update-password-form')
        </div>
    </div>

    @if (Auth::user()->is_admin == false)
        <div
            class="max-w-2xl min-h-min h-full m-auto px-16 pb-8 flex flex-col rounded-3xl bg-gray-100 border border-gray-300 shadow-lg shadow-gray-300">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    @endif

    <div class="max-w-2xl m-auto">
        <x-back-button />
    </div>

</x-app-layout>
