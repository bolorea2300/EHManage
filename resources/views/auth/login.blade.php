<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <title>SPAサンプル</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body>
    <div id="app">
        <login-component></login-component>
    </div>
</body>

</html>

<template>
    <v-app id="inspire">
        <form action="/login" method="POST">
            <input type="hidden" name="_token" :value="csrf" />
            <v-text-field name="email" label="メールアドレス" required></v-text-field>
            <v-text-field name="password" label="パスワード" required></v-text-field>
            <v-btn type="submit" block v-bind="attrs" v-on="on">
                ログイン
            </v-btn>
        </form>
    </v-app>
</template>

<script>
    export default {
    data: () => ({
        csrf: document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content"),
    }),
};
</script>