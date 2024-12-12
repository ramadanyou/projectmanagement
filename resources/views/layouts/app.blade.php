<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .cursor-pointer {
            cursor: pointer !important;
        }
    </style>
</head>

<body style="font-family: 'Figtree', sans-serif;">

    <div class="min-vh-100 d-flex flex-column bg-light">
        <!-- Include Navbar or Header -->
        @include('layouts.header')

        <!-- Page Heading -->
        @hasSection('header')
            <header class="border-bottom mt-2">
                <div class="container py-2">
                    @yield('header')
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main class="flex-grow-1 py-4">
            <div class="container">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
