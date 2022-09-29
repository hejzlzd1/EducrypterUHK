@extends("components/pageTemplate")
@section("title","Krypto aplikace - úvodní stránka")
@section("comment")
    'Úvodní stránka výukové webové aplikace. Tato aplikace se zaměřuje na výuku kryptografie a je projektem diplomové práce na téma "Zabezpečení TLS".'
@endsection
@section("content")

<div class="vh-100">
    <h1>@lang('mainPageTexts.cryptoInNutshell')</h1>
    <p>@lang('mainPageTexts.annotation')</p>
    <p>@lang('mainPageTexts.annotationEnd')</p>
</div>

    @include("components/footer")
@endsection
