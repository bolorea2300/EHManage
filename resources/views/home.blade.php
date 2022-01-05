<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <title>EHManage</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body>
    <div id="app">
        <div>
            @auth
            <?php
            $auth = Auth::user();
            ?>
            <base-component :auth='{{ $auth }}'></base-component>
            @endauth

            @guest
            <h1>まずは<a href="/">ログイン</a>してください</h1>
            @endguest
        </div>
    </div>
</body>

</html>