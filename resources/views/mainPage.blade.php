@extends("components/pageTemplate")
@section("title","Krypto aplikace - úvodní stránka")
@section("comment",__('mainPageTexts.metaComment'))
@section("content")
@include("components/menu")

    <section class="">
        <div id="intro">
            <h1>@lang('mainPageTexts.cryptoInNutshell')</h1>
            <p>@lang('mainPageTexts.annotation')</p>
            <p>@lang('mainPageTexts.annotationEnd')</p>
        </div>
    </section>

    <section class="">
        <div id="symetric">
            <h1 >Symetric</h1>
        </div>
    </section>

<section class="">
    <div id="asymetric">
        <h1 id="asymetric">Asymetric</h1>
    </div>
</section>

<section class="">
    <h1 id="usage">Usage</h1>
</section>

<section class="">
    <h1 id="protocols">Protocols</h1>
</section>

<section class="">
    <h1 id="sslvstls">SSL vs TLS</h1>
    </section>

<section class="">
    <h1 id="certificates">Certificates</h1>
</section>

    @include("components/footer")
@endsection
