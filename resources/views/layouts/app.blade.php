<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
    @include('inc.message')
    <div id="app">
                @include('inc.navbar')
                <div class= "container">
                    @include('inc.message')
                    @yield('content')
                </div>
        </main>
    </div>

    <!-- Include CKEditor script -->
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script type="text/javascript">
      $(document).ready(function () {
             $('.ckeditor').ckeditor();
         });
    </script>
</body>
</html>
