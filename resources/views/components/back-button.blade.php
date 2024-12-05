@if(url()->previous())
    <a class="max-w-7xl" href="{{ url()->previous() }}">
        <button class="min-w-40 max-w-7xl w-fit h-10 px-4 bg-gray-100 border border-gray-300 rounded-lg shadow-gray-300 shadow-md hover:bg-gray-50">Go Back</button>
    </a>
@else
    <a class="max-w-7xl" href="{{ route('home') }}">
        <button class="min-w-40 w-fit h-10 px-4 bg-gray-100 border border-gray-300 rounded-lg shadow-gray-300 shadow-md hover:bg-gray-50">Go Back</button>
    </a>
@endif