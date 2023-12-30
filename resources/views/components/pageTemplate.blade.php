<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield("title")</title>
    <meta name="description" content="@yield("comment")">
    <meta name="keywords"
          content="uhk, fim, kryptografie, kryptologie, šifrování, diplomová práce, ceasarova abeceda, uhk fim, dešifrování, šifrovací aplikace, uhk aplikace">
    <meta name="robots" content="index,follow">
    <meta name="googlebot" content="snippet,archive">
    <meta name="Author" content="Zdeněk Hejzlar">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
<div id="wrapper">
    @include("components/flashMessage")
    @include("components/menu")
    @yield("content")

    <div>
        @if(App::getLocale() == "cz")
            <a href="{{route("changeLang", ['locale' => "en"])}}"
               class="back-to-top d-flex align-items-center justify-content-center"><img width="40px"
                                                                                         src="{{asset('/img/en.png')}}"/></a>
        @else
            <a href="{{route("changeLang", ['locale' => "cz"])}}"
               class="back-to-top d-flex align-items-center justify-content-center"><img width="40px"
                                                                                         src="{{asset("/img/cz.png")}}"/></a>
        @endif
    </div>
</div>
</body>

</html>
