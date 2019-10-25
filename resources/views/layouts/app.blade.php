<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta charset="utf-8">

        <!-- tailwindCSS -->
        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">

        <!-- Icons -->
        <script type="text/javascript" src="https://kit.fontawesome.com/ae43e6eac8.js"></script>

        <!-- JQuery -->
        <script type="text/javascript" src="/js/jquery-3.4.1.js"></script>

        <!-- JavaScript -->
        <script type="text/javascript" src="/js/script.js"></script>

        <!-- Zooming -->
        <script type="text/javascript" src="{{ mix('/js/zooming-plugin.js') }}"></script>

        <title>Online Web Store | @yield('title') </title>
    </head>

    <body class="bg-catskill h-screen">
                @yield('left-menu')
        <div id="main" class="flex flex-col">
            @yield('header')
            <div>
                @yield('content')
            </div>
            @yield('footer')
        </div>
    </body>


</html>
