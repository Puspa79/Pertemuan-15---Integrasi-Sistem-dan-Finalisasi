<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-size: 17px !important;
        }

        p,
        td,
        th,
        label,
        input,
        select,
        textarea {
            font-size: 17px !important;
        }

        .btn {
            font-size: 16px !important;
        }

        small,
        .small {
            font-size: 14px !important;
        }

        h1 {
            font-size: 2.2rem !important;
        }

        h2 {
            font-size: 1.8rem !important;
        }

        h3 {
            font-size: 1.5rem !important;
        }

        h4 {
            font-size: 1.3rem !important;
        }

        h5 {
            font-size: 1.15rem !important;
        }

        h6 {
            font-size: 1.05rem !important;
        }

        /* Override class Tailwind yang bikin tulisan kecil */
        .text-sm {
            font-size: 15px !important;
        }

        .text-xs {
            font-size: 13px !important;
        }

        .text-base {
            font-size: 17px !important;
        }

        .text-lg {
            font-size: 19px !important;
        }

        .text-xl {
            font-size: 21px !important;
        }

        .text-2xl {
            font-size: 24px !important;
        }

        .text-3xl {
            font-size: 28px !important;
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen">
        @include('layouts.navigation')

        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main>
            {{ $slot }}
        </main>
    </div>
    @stack('scripts')
</body>

</html>
