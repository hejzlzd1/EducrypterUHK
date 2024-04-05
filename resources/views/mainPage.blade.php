@extends("components/pageTemplate")
@section("title",__("mainPageTexts.mainPageTitle"))
@section("comment",__('mainPageTexts.metaComment'))
@section("content")


    <div class="anchor" id="intro"></div>
    @if( env('INFO_BANNER', false) )
        <section class="mainContent">
        <div class="container shadow-lg rounded-4 p-5 border">
            <h1>
                <i class="fa-regular fa-circle-question"></i> @lang('mainPageTexts.infoBannerTitle')
            </h1>
            <hr />
            <p>
                @lang('mainPageTexts.infoBanner')
            </p>
        </div>
        </section>
    @endif

    <section class="mainContent">
        <div>
            <div class="container shadow-lg border rounded-4 secondaryBox p-5">
                <div class="row align-items-start">
                    <h1>@lang('mainPageTexts.cryptoInNutshell')</h1>
                    <hr />
                    <div class="col-lg-9">
                        <p>@lang('mainPageTexts.annotation')</p>
                    </div>

                    <div class="col-lg-3 m-auto">
                        <img alt="" width="100%" src="{{ asset('img/mainPage/cryptoInNutshell.jpg') }}" class="rounded-4">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="anchor" id="symmetric"></div>

    <section class="mainContent">
        <div>
            <div class="container shadow-lg border rounded-4 secondaryBox p-5">
                <div class="row align-items-start">
                    <h1>@lang('mainPageTexts.symmetric')</h1>
                    <hr />
                    <div class="col-lg-4 m-auto">
                        <a href="{{ 'img/mainPage/symmetric_' . App::getLocale() . '.png'}}" target="_blank">
                            <img alt="" width="100%" title="@lang('baseTexts.clickToSeeInFullSize')" src="{{ asset('img/mainPage/symmetric_' . App::getLocale() . '.png') }}" class="rounded-4">
                        </a>
                    </div>
                    <div class="col-lg-8">
                        <p>@lang('mainPageTexts.symmetricInfo')</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="anchor" id="asymmetric"></div>

    <section class="mainContent">
        <div>
            <div class="container shadow-lg border rounded-4 secondaryBox p-5">
                <div class="row align-items-start">
                    <h1>@lang('mainPageTexts.asymmetric')</h1>
                    <hr />
                    <div class="col-lg-8">
                        <p>@lang('mainPageTexts.asymmetricInfo')</p>
                    </div>

                    <div class="col-lg-4 m-auto">
                        <a href="{{ 'img/mainPage/asymmetric_' . App::getLocale() . '.png' }}" target="_blank">
                            <img alt="" title="@lang('baseTexts.clickToSeeInFullSize')" width="100%" src="{{ asset('img/mainPage/asymmetric_' . App::getLocale() . '.png') }}" class="rounded-4">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="anchor" id="usage"></div>

    <section class="mainContent">
        <div>
            <div class="container shadow-lg border rounded-4 secondaryBox p-5">
                <div class="row align-items-start">
                    <h1>@lang('mainPageTexts.usage')</h1>
                    <hr />
                    <div class="col-lg-3 m-auto">
                        <img width="100%" alt="" src="{{ asset('img/mainPage/personalInfo.jpg') }}" class="rounded-4">
                    </div>
                    <div class="col-lg-9">
                        <p>@lang('mainPageTexts.usageInfo')</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="anchor" id="protocols"></div>

    <section class="mainContent">
        <div>
            <div class="container shadow-lg border rounded-4 secondaryBox p-5">
                <div class="row align-items-start">
                    <h1>@lang('mainPageTexts.protocols')</h1>
                    <hr />
                    <div class="col-lg-9">
                        <p>@lang('mainPageTexts.protocolsInfo')</p>
                    </div>

                    <div class="col-lg-3 m-auto">
                        <img width="100%" alt="" src="{{ asset('img/mainPage/protocols.webp') }}" class="rounded-4">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="anchor" id="sslvstls"></div>

    <section class="mainContent">
        <div>
            <div class="container shadow-lg border rounded-4 secondaryBox p-5">
                <div class="row align-items-start">
                    <h1>SSL vs TLS</h1>
                    <hr />
                    <div class="col-lg-4 m-auto">
                        <a href="{{ asset('img/mainPage/handshake.png') }}" target="_blank">
                            <img alt="" title="@lang('baseTexts.clickToSeeInFullSize')" width="100%" src="{{ asset('img/mainPage/handshake.png') }}" class="rounded-4">
                        </a>
                        <figure class="text-center">Handshake</figure>
                    </div>
                    <div class="col-lg-8">
                        <p>@lang('mainPageTexts.sslvstlsInfo')</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="anchor" id="certificates"></div>

    <section class="mainContent">
        <div>
            <div class="container shadow-lg border rounded-4 secondaryBox p-5">
                <div class="row align-items-start">
                    <h1>@lang('mainPageTexts.certificates')</h1>
                    <hr />
                    <div class="col-lg-9">
                        <p>@lang('mainPageTexts.certificatesInfo')</p>
                    </div>

                    <div class="col-lg-3 m-auto">
                        <img width="100%" alt="" src="{{ asset('img/mainPage/sslcert.webp') }}" class="rounded-4">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
