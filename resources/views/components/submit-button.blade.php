@props(['text'])

<button {{ $attributes->merge(['class' => 'min-w-40 w-fit h-10 px-4 border rounded-lg shadow-md shadow-slate-800']) }} type="submit">
    {{ $text }}
</button>
