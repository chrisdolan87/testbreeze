<a {{ $attributes->merge(['class' => 'dropdown-link block w-full px-4 py-2 text-start text-sm leading-5 bg-white hover:bg-yellow-400 transition duration-150 ease-in-out']) }} style="">{{ $slot }}</a>

<style>
    .dropdown-link {
        color:#00242A;
    }
    .dropdown-link:hover {
        background-color:#00242A;
        color: #ffffff;
    }
</style>