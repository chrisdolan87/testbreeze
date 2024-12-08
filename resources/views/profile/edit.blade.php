<x-app-layout>

    <section class="w-full min-h-min h-full mx-auto p-8 flex flex-col md:items-start sm:items-center bg-white gap-8">

        <div class="max-w-5xl w-full mx-auto p-8 flex flex-col gap-8">

            <div
                class="max-w-2xl w-full min-h-min h-full mx-auto px-16 flex flex-col rounded-3xl bg-slate-100 border border-gray-300 shadow-md shadow-slate-700">
                <div class="max-w-xl py-8">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div
                class="max-w-2xl w-full min-h-min h-full mx-auto px-16 flex flex-col rounded-3xl bg-slate-100 border border-gray-300 shadow-md shadow-slate-700">
                <div class="max-w-xl py-8">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            @if (Auth::user()->is_admin == false)
                <div
                    class="max-w-2xl w-full min-h-min h-full mx-auto px-16 flex flex-col rounded-3xl bg-slate-100 border border-gray-300 shadow-md shadow-slate-700">
                    <div class="max-w-xl py-8">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            @endif
        </div>

        <div class="max-w-2xl w-full m-auto">
            <x-back-button />
        </div>

    </section>

</x-app-layout>
