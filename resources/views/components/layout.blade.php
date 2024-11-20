<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Book Marketplace</title>
</head>

<body class="min-h-screen flex flex-col bg-gray-100">
    <x-header></x-header>

    <section>
        {{ $slot }}
    </section>

    <x-footer></x-footer>
</body>

</html>
