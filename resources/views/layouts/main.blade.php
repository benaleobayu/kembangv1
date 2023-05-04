<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CMS Apa Aja</title>

    <!-- Custom styles for this template -->
    <link href="/asset/css/sidebars.css?v2" rel="stylesheet">
    <link href="/asset/css/style.css?v2" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>

    <main class="d-flex flex-nowrap">
        @include('layouts.sidebar')
    <div class="main-content overflow-auto px-3" style="width: 1920px; max-width:100%">

            @yield('content')
        </div>
    </main>

    <script src="/asset/js/jquery.js"></script>
    <script src="/asset/js/scripts.js"></script>
    <script src="/asset/js/sidebars.js"></script>
 
</body>

</html>
