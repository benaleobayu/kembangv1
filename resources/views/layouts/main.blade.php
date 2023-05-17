<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CMS Apa Aja</title>

    <!-- Custom styles for this template -->
    <link href="/asset/css/sidebars.css" rel="stylesheet">
    <link href="/asset/css/style.css?v2" rel="stylesheet">
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
    <script src="/asset/js/jquery.js"></script>
    


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>

    <main class="d-flex flex-nowrap">
        @include('layouts.sidebar')
    <div class="main-content overflow-auto px-3" style="width: 1920px; max-width:100%">

            @yield('content')
        </div>

        @include('layouts.alert')
      
    </main>
    @stack('alert_delete')
    @stack('alert_import')
    @stack('modal_selectName')

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="/asset/js/scripts.js"></script>
    <script src="/asset/js/sidebars.js"></script>
   
 
</body>

</html>
