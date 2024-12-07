<x-app-layout>

    <section class="w-full min-h-min h-full mx-auto p-8 flex flex-col md:items-start sm:items-center bg-white gap-8">
        <div class="max-w-xl w-full mx-auto p-8 flex flex-col gap-8">
            <div
                class="w-full min-h-min h-full mx-auto px-16 py-8 flex flex-col rounded-3xl bg-slate-100 border border-gray-300 shadow-md shadow-slate-700">

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />

                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                            autocomplete="current-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox"
                                class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm shadow-slate-800 focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                                name="remember">
                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        {{-- @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                                href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif --}}

                        <x-primary-button class="">
                            {{ __('Log in') }}
                        </x-primary-button>

                    </div>
                </form>
                <div class="w-full flex justify-center items-center my-8">
                    <div class="w-full border-t border-slate-800"></div>
                    <div class="mx-4">or</div>
                    <div class="w-full border-t border-slate-800"></div>
                </div>

                <a href="/login/github">
                    <button
                        class="w-full relative px-2 py-2 bg-slate-300 border border-slate-300 rounded-lg shadow-slate-800 shadow-md hover:bg-slate-100 flex justify-between items-center">
                        <img class="w-8 absolute" src="{{ asset('storage/images/github_icon.png') }}" alt="">
                        <p class="w-full">Log in with GitHub</p>
                    </button>
                </a>
            </div>

            <div class="w-full mx-auto">
                <x-back-button />
            </div>
        </div>

    </section>
</x-app-layout>
