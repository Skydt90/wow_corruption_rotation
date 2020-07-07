<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} :: Admin</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script>const whTooltips = {colorLinks: true, iconizeLinks: false, renameLinks: false};</script>
    <script src="https://wow.zamimg.com/widgets/power.js"></script>
    
    <script src="https://kit.fontawesome.com/5da4c152e6.js" crossorigin="anonymous"></script>
    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            background-color: rgb(15, 16, 29);
        }
        img {
            height: 23px;
            width:  auto;
        }
        .card {
            background-color: rgb(30, 32, 58);
            border-radius: 1%;
        }
        .card-header {
            cursor: pointer;
        }
        .table > thead {
            background-color: rgb(15, 16, 29);
        }
        .table > tbody > tr > td, .table > tbody > tr > th, .table > thead > tr > td, .table > thead > tr > th {
            border: 0px;
        }
        .table > tbody tr:hover {
            background-color: rgb(36, 39, 70);
        }
        </style>
</head>
<body>
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
