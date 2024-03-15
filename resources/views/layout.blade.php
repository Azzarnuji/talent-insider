<!DOCTYPE html>
<html lang="en" data-theme="light">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.all.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.min.css">
        <script src="https://cdn.datatables.net/2.0.2/js/dataTables.min.js"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <title>{{ $title }}</title>
        @yield('addOnScript')
        @livewireStyles
    </head>

    <body>

        @yield('content')
        @livewireScripts
    </body>

</html>
