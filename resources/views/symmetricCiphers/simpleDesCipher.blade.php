@php
    use App\Algorithms\CipherBase;
    use App\View\Components\GenerateInputButton;
@endphp
@extends("components/pageTemplate")
@section("title",__('simpleDesPageTexts.title'))
@section("comment",__('simpleDesPageTexts.metaComment'))
@section("content")

    <div class="anchor" id="info"></div>

    <section class="m-5">
        <div class="shadow-lg border rounded-4 p-5">
            <div>
                <div class="container">
                    <div class="row align-items-start">
                        <h1><i class="fa-solid fa-circle-info"></i> S-DES</h1>
                        <hr/>
                        <div class="col-lg-7">
                            <p>@lang('simpleDesPageTexts.annotation')</p>
                            <h4>@lang('simpleDesPageTexts.keyGenerationInfoTitle')</h4>
                            <p>@lang('simpleDesPageTexts.keyGenerationInfo')</p>
                            <h4>@lang('simpleDesPageTexts.encryptionDecryptionInfoTitle')</h4>
                            <p>@lang('simpleDesPageTexts.encryptionDecryptionInfo')</p>
                            <h4>@lang('simpleDesPageTexts.differencesToDESTitle')</h4>
                            <p>@lang('simpleDesPageTexts.differencesToDES')</p>

                            <h4>@lang('simpleDesPageTexts.additionalSchemas')</h4>
                            <div id="carouselControls" class="carousel col-lg-8 mb-5" data-bs-ride="carousel"
                                 data-bs-interval="10000">
                                <div class="carousel-inner custom-carousel">
                                    <div class="carousel-item active">
                                        <a href="{{ asset('img/simpleDesPage/EP.png' )}}" target="_blank">
                                            <img alt="" src="{{ asset('img/simpleDesPage/EP.png') }}"
                                                 class="d-block w-100" title="@lang('baseTexts.clickToSeeInFullSize')">
                                        </a>
                                        <div class="label">
                                            @lang('simpleDesPageTexts.EP')
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <a href="{{ asset('img/simpleDesPage/IP.png') }}" target="_blank">
                                            <img alt="" src="{{ asset('img/simpleDesPage/IP.png') }}"
                                                 class="d-block w-100" title="@lang('baseTexts.clickToSeeInFullSize')">
                                        </a>
                                        <div class="label">
                                            @lang('simpleDesPageTexts.IP')
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <a href="{{ asset('img/simpleDesPage/IIP.png') }}" target="_blank">
                                            <img alt="" src="{{ asset('img/simpleDesPage/IIP.png') }}"
                                                 class="d-block w-100" title="@lang('baseTexts.clickToSeeInFullSize')">
                                        </a>
                                        <div class="label">
                                            @lang('simpleDesPageTexts.IIP')
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <a href="{{ asset('img/simpleDesPage/LS.png') }}" target="_blank">
                                            <img alt="" src="{{ asset('img/simpleDesPage/LS.png') }}"
                                                 class="d-block w-100" title="@lang('baseTexts.clickToSeeInFullSize')">
                                        </a>
                                        <div class="label">
                                            @lang('simpleDesPageTexts.shift')
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <a href="{{ asset('img/simpleDesPage/P4.png') }}" target="_blank">
                                            <img alt="" src="{{asset('img/simpleDesPage/P4.png')}}"
                                                 class="d-block w-100" title="@lang('baseTexts.clickToSeeInFullSize')">
                                        </a>
                                        <div class="label">
                                            @lang('simpleDesPageTexts.P4')
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <a href="{{ asset('img/simpleDesPage/P8.png') }}" target="_blank">
                                            <img alt="" src="{{ asset('img/simpleDesPage/P8.png') }}"
                                                 class="d-block w-100" title="@lang('baseTexts.clickToSeeInFullSize')">
                                        </a>
                                        <div class="label">
                                            @lang('simpleDesPageTexts.P8')
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <a href="{{ asset('img/simpleDesPage/P10.png') }}" target="_blank">
                                            <img alt="" src="{{ asset('img/simpleDesPage/P10.png') }}"
                                                 class="d-block w-100" title="@lang('baseTexts.clickToSeeInFullSize')">
                                        </a>
                                        <div class="label">
                                            @lang('simpleDesPageTexts.P10')
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <a href="{{ asset('img/simpleDesPage/sBoxes.png') }}" target="_blank">
                                            <img alt="" src="{{ asset('img/simpleDesPage/sBoxes.png') }}"
                                                 class="d-block w-100" title="@lang('baseTexts.clickToSeeInFullSize')">
                                        </a>
                                        <div class="label">
                                            @lang('simpleDesPageTexts.sBoxes')
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <a href="{{ asset('img/simpleDesPage/SW.png') }}" target="_blank">
                                            <img alt="" src="{{ asset('img/simpleDesPage/SW.png') }}"
                                                 class="d-block w-100" title="@lang('baseTexts.clickToSeeInFullSize')">
                                        </a>
                                        <div class="label">
                                            @lang('simpleDesPageTexts.swap')
                                        </div>
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselControls"
                                        data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselControls"
                                        data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-5 m-t-5">
                            <a href="{{asset('img/simpleDesPage/simpleDes_' . App::getLocale() . '.png')}}"
                               target="_blank">
                                <img
                                    alt=""
                                    width="100%"
                                    title="@lang('baseTexts.clickToSeeInFullSize')"
                                    src="{{asset('img/simpleDesPage/simpleDes_' . App::getLocale() . '.png')}}"
                                />
                            </a>
                            <figure class="text-center">
                                @lang('simpleDesPageTexts.blockSchema')
                            </figure>

                            <div class="mt-5">
                                <a href="{{ asset('img/simpleDesPage/roundFunction.png') }}" target="_blank">
                                    <img alt="" src="{{ asset('img/simpleDesPage/roundFunction.png') }}" width="100%"
                                         title="@lang('baseTexts.clickToSeeInFullSize')">
                                </a>
                                <figure class="text-center">
                                    @lang('simpleDesPageTexts.roundFunction')
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <div class="container">
                    <div class="row align-items-start">
                        <h1 class=""><i class="fa-regular fa-file-lines"></i> @lang('baseTexts.cipherForm')</h1>
                        <p class="text-black-50">@lang('baseTexts.formInfoDescription')</p>
                        <hr/>
                        <form action="" method="post">
                            @csrf
                            <fieldset class="row p-2">
                                <div class="col-lg-6">
                                    <label class="form-label" for="text">
                                        @lang('simpleDesPageTexts.binaryInput')
                                        <x-tooltipButton
                                            :tooltip="trans('baseTexts.binaryInputPrompt')"></x-tooltipButton>
                                    </label>
                                    <div class="input-group">
                                        <input class="form-control binaryValidation" minlength="1" maxlength="8"
                                               required
                                               type="text"
                                               id="text"
                                               name="text"
                                               placeholder="@lang('baseTexts.binaryInputPrompt')"
                                               @if(isset($data['text']))value="{{$data['text']}}"@endif>
                                        <x-generateInputButton
                                            type="{{ GenerateInputButton::TYPE_BINARY }}"
                                            size="8"
                                            target="#text">
                                        </x-generateInputButton>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="key">
                                        @lang('simpleDesPageTexts.binaryKey')
                                        <x-tooltipButton
                                            :tooltip="trans('baseTexts.binaryInputPrompt')"></x-tooltipButton>
                                    </label>
                                    <div class="input-group">
                                        <input class="form-control binaryValidation" minlength="1" maxlength="10"
                                               type="text" id="key"
                                               name="key"
                                               placeholder="@lang('baseTexts.binaryInputPrompt')"
                                               @if(isset($data['key'])) value="{{$data['key']}}" @else value="" @endif>
                                        <x-generateInputButton
                                            type="{{ GenerateInputButton::TYPE_BINARY }}"
                                            size="10"
                                            target="#key">
                                        </x-generateInputButton>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="p-2">
                                <fieldset>
                                    <label>@lang("baseTexts.action")</label>
                                    <br/>
                                    <div class="form-check form-switch">
                                        <label class="form-check-label" for="encrypt">@lang('baseTexts.encrypt')</label>
                                        <input class="form-check-input" required type="radio"
                                               id="encrypt" name="action"
                                               value={{CipherBase::ALGORITHM_ENCRYPT}}>
                                    </div>
                                    <div class="form-check form-switch">
                                        <label class="form-check-label" for="decrypt">@lang('baseTexts.decrypt')</label>
                                        <input class="form-check-input" required type="radio"
                                               id="decrypt" name="action"
                                               value={{CipherBase::ALGORITHM_DECRYPT}}>
                                    </div>
                                </fieldset>
                            </div>

                            @include('components.submitButton')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @if(isset($result))
        @include('symmetricCiphers/results/simpleDesCipherResult')
    @endif
@endsection
