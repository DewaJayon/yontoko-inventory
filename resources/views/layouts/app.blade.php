<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Yontoko Inventory' }}</title>
    {{-- Jquery --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!-- CSS files -->
    @vite(['resources/css/app.css'])

    {{-- datatables --}}
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.8/datatables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.8/datatables.min.js"></script>

    {{-- sweetalert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
</head>

<body>
    @vite('resources/js/demo-theme.min.js')

    <div class="page">

        <!-- Sidebar -->
        @include('layouts.partials.sidebar')

        <!-- Navbar -->
        @include('layouts.partials.navbar')

        <div class="page-wrapper">

            @yield('content')

            @include('layouts.partials.footer')
        </div>
    </div>

    @vite(['resources/js/app.js'])

    @yield('scripts')
</body>

</html>
