<div>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        {{-- FONTAWESOME --}}
        <script src="https://kit.fontawesome.com/7d149bc2d8.js" crossorigin="anonymous"></script>
        {{-- FONTS --}}
        <link href="https://fonts.cdnfonts.com/css/cyberway-riders" rel="stylesheet">
        {{-- VITE --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <title>Presto.it</title>
    </head>

    <body>
        @if (Route::currentRouteName() == 'announcement.index')
            <x-navbar :categoryName="$categoryName" />
        @else
        <x-navbar />
        @endif

        <div class="@if (Route::currentRouteName() != 'home')@endif min-vh-100">
        {{ $slot }}
        </div>

<x-footer />
</body>

</html>

</div>
