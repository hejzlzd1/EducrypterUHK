<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield("title")</title>
        <meta name="description" content="@yield("comment")">
        <meta name="keywords" content="uhk, fim, kryptografie, kryptologie, šifrování, diplomová práce, ceasarova abeceda, uhk fim, dešifrování, šifrovací aplikace, uhk aplikace">
        <meta name="robots" content="index,follow">
        <meta name="googlebot" content="snippet,archive">
        <meta name="Author" content="Zdeněk Hejzlar">

        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>

    <body>
    <div id="wrapper">
    @include("components/flashMessage")

    @yield("content")
    </div>
    </body>

</html>
