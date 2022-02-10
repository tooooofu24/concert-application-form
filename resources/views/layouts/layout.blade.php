<!doctype html>
<html lang="ja" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <meta name="description" content="ページの内容を表す文章" />

    <meta property="og:url" content="{{ route('application.index') }}" />
    <meta property="og:title" content="@yield('title')" />
    <meta property="og:description" content="/images/ticket-image.png" />
    <meta property="og:image" content="" />
    <meta property="og:site_name" content="音楽科卒業演奏会" />
    <meta property="og:locale" content="ja_JP" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Font Awsome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="h-100">
    <main class="h-100">
        <div id="app" class="h-100">
            @yield('content')
        </div>
    </main>


    <!-- JavaScript -->
    <script src="{{ asset('js/app.js') }}" defer></script>

</body>

</html>