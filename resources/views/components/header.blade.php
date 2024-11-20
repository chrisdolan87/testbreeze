<div id="header" class="w-full min-h-20 relative top-0 flex justify-between bg-gray-200">

    <div id="logo" class="flex p-6 items-center">
        <a class="text-2xl font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
            href="/">
            Book Store</a>
    </div>

    @if (Route::has('login'))
        <div class="flex items-center p-6 text-right">
            @auth
                <a href="{{ url('/dashboard') }}"
                    class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
            @else
                <a href="{{ route('login') }}"
                    class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                    in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="ml-4 font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                @endif
            @endauth
        </div>
    @endif
</div>
