<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>

<body class="min-h-screen flex flex-col justify-between bg-gray-100">
    <x-header />

    <x-searchbar />

    {{ $slot }}

    <x-footer />
</body>

</html>
