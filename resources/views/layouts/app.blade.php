<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        input[type="checkbox"] {
            display: none;
        }

        input[type="checkbox"]:checked~.modal,
        input[type="checkbox"]:checked~.modal-background {
            display: block;
        }

        .modal-background {
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            position: fixed;
            top: 0;
            left: 0;
            display: none;
            z-index: 9998;
        }

        .modal {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
            display: none;
            width: 300px;
            height: 300px;
            background-color: #fff;
            box-sizing: border-box;
            z-index: 9999;
        }

        .modal>p {
            padding: 15px;
            margin: 0;
        }

        .modal-header {
            background-color: #f9f9f9;
            border-bottom: 1px solid #dddddd;
            box-sizing: border-box;
            height: 50px;
        }

        .modal-header h3 {
            margin: 0;
            box-sizing: border-box;
            padding-left: 15px;
            line-height: 50px;
            color: #4d4d4d;
            font-size: 16px;
            display: inline-block;
        }

        .modal-header label {
            box-sizing: border-box;
            border-left: 1px solid #dddddd;
            float: right;
            line-height: 50px;
            padding: 0 15px 0 15px;
            cursor: pointer;
        }

        .modal-header label:hover img {
            opacity: 0.6;
        }

        /* below is optional, it is just an example for the blue button */
        .example-label {
            box-sizing: border-box;
            display: inline-block;
            padding: 10px;
            background-color: #375d91;
            color: #f9f9f9;
            font-size: 12px;
            font-weight: bold;
            cursor: pointer;
        }

        .example-label:hover {
            background-color: #3c669f;
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Content -->
        <main>
            @yield('page')
        </main>
    </div>


    @yield('page-script')

</body>

</html>
