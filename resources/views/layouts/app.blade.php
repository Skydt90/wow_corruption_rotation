<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link rel="icon" href="{{ asset('storage/images/logowow.png') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script>const whTooltips = {colorLinks: true, iconizeLinks: false, renameLinks: false};</script>
    <script src="https://wow.zamimg.com/widgets/power.js"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            color: rgb(228, 168, 2);
            background-image: url({{ asset('storage/images/panel.jpg') }});
            background-color: #170e09;
        }
        a {
            color: rgb(228, 168, 2);
            text-decoration: none !important;
        }
        a:hover {
            color: rgb(255, 255, 255);
        }
        img:not(#logo) {
            height: 23px;
            width:  auto;
        }
        .card {
            background-image: url({{ asset('storage/images/panel2.jpg') }});
            background-color: rgb(30, 32, 58);
            border: 1.5px solid #170e09;
            border-radius: 0.5%;
            transition: transform .3s;
        }
        .card:hover {
            /*transform: scale(1.02);*/
        }
        .card-header {
            cursor: pointer;
        }
        .table {
            color: rgb(228, 168, 2);
        }
        .table > thead {
            background-color: rgb(33, 21, 16)
        }
        .table > tbody > tr > td, .table > tbody > tr > th, .table > thead > tr > td, .table > thead > tr > th {
            border: 0;
        }
        .table > tbody tr:hover {
            background-color: rgb(33, 21, 16);
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
