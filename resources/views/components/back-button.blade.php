@if(url()->previous())
    <a class="" href="{{ url()->previous() }}">
        <button class="min-w-40 w-fit h-10 px-4 bg-slate-300 border border-slate-300 rounded-lg shadow-slate-800 shadow-md hover:bg-slate-100">Go Back</button>
    </a>
@else
    <a class="" href="{{ route('home') }}">
        <button class="min-w-40 w-fit h-10 px-4 bg-slate-300 border border-slate-300 rounded-lg shadow-slate-800 shadow-md hover:bg-slate-100">Go Back</button>
    </a>
@endif