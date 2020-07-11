<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link rel="icon" href="storage/images/logowow.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ str_replace('-', ' ', config('app.name', 'Laravel')) }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script>const whTooltips = {colorLinks: true, iconizeLinks: false, renameLinks: false};</script>
    <script src="https://wow.zamimg.com/widgets/power.js"></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
