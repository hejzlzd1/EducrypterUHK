@extends("components/pageTemplate")
@section("title","Krypto aplikace - úvodní stránka")
@section("comment",__('mainPageTexts.metaComment'))
@section("content")
    @include("components/menu")

    <section class="m-5">
        <div id="intro">
            <div class="container shadow-lg border rounded-4 p-5">
                <div class="row align-items-start">
                    <h1>@lang('mainPageTexts.cryptoInNutshell')</h1>
                    <hr />
                    <div class="col-9">
                        <p>@lang('mainPageTexts.annotation')</p>
                    </div>

                    <div class="col-3 m-auto">
                        <img width="100%" src="{{asset("img/mainPage/cryptoInNutshell.jpg")}}" class="rounded-4">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="m-5">
        <div id="symetric">
            <div class="container shadow-lg border rounded-4 p-5">
                <div class="row align-items-start">
                    <h1>@lang('mainPageTexts.symetric')</h1>
                    <hr />
                    <div class="col-4 m-auto">
                        <img width="100%" src="{{asset("img/mainPage/symetric_".App::getLocale().".png")}}" class="rounded-4">
                    </div>
                    <div class="col-8">
                        <p>@lang('mainPageTexts.symetricInfo')</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="m-5">
        <div id="asymetric">
            <div class="container shadow-lg border rounded-4 p-5">
                <div class="row align-items-start">
                    <h1>@lang('mainPageTexts.asymetric')</h1>
                    <hr />
                    <div class="col-8">
                        <p>@lang('mainPageTexts.asymetricInfo')</p>
                    </div>

                    <div class="col-4 m-auto">
                        <img width="100%" src="{{asset("img/mainPage/asymetric_".App::getLocale().".png")}}" class="rounded-4">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="m-5">
        <div id="usage">
            <div class="container shadow-lg border rounded-4 p-5">
                <div class="row align-items-start">
                    <h1>@lang('mainPageTexts.usage')</h1>
                    <hr />
                    <div class="col-3 m-auto">
                        <img width="100%" src="{{asset("img/mainPage/personalInfo.jpg")}}" class="rounded-4">
                    </div>
                    <div class="col-9">
                        <p>@lang('mainPageTexts.usageInfo')</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="m-5">
        <div id="protocols">
            <div class="container shadow-lg border rounded-4 p-5">
                <div class="row align-items-start">
                    <h1>@lang('mainPageTexts.protocols')</h1>
                    <hr />
                    <div class="col-9">
                        <p>@lang('mainPageTexts.protocolsInfo')</p>
                    </div>

                    <div class="col-3 m-auto">
                        <img width="100%" src="{{asset("img/mainPage/protocols.webp")}}" class="rounded-4">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="m-5">
        <div id="sslvstls">
            <div class="container shadow-lg border rounded-4 p-5">
                <div class="row align-items-start">
                    <h1>SSL vs TLS</h1>
                    <hr />
                    <div class="col-4 m-auto">
                        <img width="100%" src="{{asset("img/mainPage/handshake.png")}}" class="rounded-4">
                        <figure class="text-center">Handshake</figure>
                    </div>
                    <div class="col-8">
                        <p>@lang('mainPageTexts.sslvstlsInfo')</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="m-5">
        <div id="certificates">
            <div class="container shadow-lg border rounded-4 p-5">
                <div class="row align-items-start">
                    <h1>@lang('mainPageTexts.certificates')</h1>
                    <hr />
                    <div class="col-9">
                        <p>@lang('mainPageTexts.certificatesInfo')</p>
                    </div>

                    <div class="col-3 m-auto">
                        <img width="100%" src="{{asset("img/mainPage/sslcert.webp")}}" class="rounded-4">
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include("components/footer")
@endsection
