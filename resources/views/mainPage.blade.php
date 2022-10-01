@extends("components/pageTemplate")
@section("title","Krypto aplikace - úvodní stránka")
@section("comment",__('mainPageTexts.metaComment'))
@section("content")
@include("components/menu")
<div class="vh-100">
    <h1>@lang('mainPageTexts.cryptoInNutshell')</h1>
    <p>@lang('mainPageTexts.annotation')</p>
    <p>@lang('mainPageTexts.annotationEnd')</p>
</div>

    @include("components/footer")
@endsection
