<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@section('title'){{ config('app.name', 'Laravel') }}@show</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('favicon.svg') }}" sizes="48x48" rel="icon">
    <link href="https://cdn.jsdelivr.net/gh/AmazonPython/Laravel-Forum@master/public/css/app.min.css" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/gh/AmazonPython/Laravel-Forum@master/public/js/app.min.js" defer></script>
</head>
<body>
    <div id="app">
        @include ('layouts.nav')

        <main class="py-4">
            @yield('content')
                <!-- Vue通知消息渲染 -->
                <flash message="{{ session('flash') }}"></flash>
            @include('partials.footer')
        </main>
    </div>
    <!-- tinymce editor js -->
    @section('js')@show
</body>
</html>
