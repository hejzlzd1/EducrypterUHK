@php
    use App\Algorithms\CipherBase;
    use App\View\Components\GenerateInputButton;
@endphp
@extends("components/pageTemplate")
@section("title",__('rsaPageTexts.title'))
@section("comment",__('rsaPageTexts.metaComment'))
@section("content")
    <div class="anchor" id="info"></div>

    <section class="m-5">
        <div class="shadow-lg border rounded-4 p-5">
            <div>
                <div class="container ">
                    <div class="row align-items-start">
                        <h1><i class="fa-solid fa-circle-info"></i> RSA</h1>
                        <hr/>
                        <div class="col-lg-8">
                            <p>@lang('rsaPageTexts.annotation')</p>
                        </div>

                        <div class="col-lg-4 m-auto">
                            <a href="{{ asset('img/rsaPage/rsa_' . App::getLocale() . '.png') }}" target="_blank">
                                <img alt="" width="100%" title="@lang('baseTexts.clickToSeeInFullSize')"
                                     src="{{ asset('img/rsaPage/rsa_' . App::getLocale() . '.png') }}"
                                />
                            </a>
                            <figure class="text-center">@lang("rsaPageTexts.schema")</figure>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pt-2">
                <div class="container">
                    <div class="row align-items-start">
                        <h1 class="">
                            <i class="fa-regular fa-file-lines"></i> @lang('baseTexts.cipherForm')
                        </h1>
                        <p class="text-black-50">
                            @lang('baseTexts.formInfoDescription')
                        </p>
                        <hr/>
                        <form action="" method="post">
                            @csrf
                            <fieldset class="row p-2">
                                <div class="col-lg-6">
                                    <label class="form-label" for="text">
                                        @lang('baseTexts.text')
                                        <x-tooltipButton :tooltip="trans('rsaPageTexts.inputTextTooltip')"></x-tooltipButton>
                                    </label>
                                    <div class="input-group">
                                    <input class="form-control" maxlength="40" minlength="1" required type="text"
                                           id="text" name="text"
                                           placeholder="@lang('baseTexts.text')"
                                           @if(isset($data['text'])) value="{{ $data['text'] }}" @endif
                                    />
                                        <x-generateInputButton
                                            type="{{ GenerateInputButton::TYPE_TEXT }}"
                                            size="40"
                                            target="#text">
                                        </x-generateInputButton>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="row p-2 disableOnEncrypt">
                                <div class="col-lg-6">
                                    <label class="form-label" for="publicKey">
                                        @lang('baseTexts.publicKey') N
                                        <x-tooltipButton
                                            :tooltip="trans('rsaPageTexts.inputPrivateKey')"></x-tooltipButton>
                                    </label>
                                    <input class="form-control disableOnEncrypt" min=1 required type="number"
                                           id="publicKey" name="publicKey"
                                           placeholder="@lang('rsaPageTexts.inputPublicKey')"
                                           @if(isset($data['publicKey'])) value="{{ $data['publicKey'] }}" @endif
                                    />
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="privateKey">
                                        @lang('baseTexts.privateKey') D
                                        <x-tooltipButton
                                            :tooltip="trans('rsaPageTexts.inputPrivateKey')"></x-tooltipButton>
                                    </label>
                                    <input class="form-control disableOnEncrypt" min=1 required type="number"
                                           id="privateKey" name="privateKey"
                                           placeholder="@lang('rsaPageTexts.inputPrivateKey')"
                                           @if(isset($data['privateKey'])) value="{{ $data['privateKey'] }}" @endif />
                                </div>
                            </fieldset>

                            <fieldset class="row p-2 disableOnDecrypt">
                                <div class="col-lg-6">
                                    <label class="form-label" for="primeNumber1">
                                        @lang('rsaPageTexts.primeNumber') p
                                        <x-tooltipButton
                                            :tooltip="trans('rsaPageTexts.insertPrimeNumberTooltip')"></x-tooltipButton>
                                    </label>
                                    <div class="input-group">
                                    <input class="form-control primeNumber disableOnDecrypt"
                                           placeholder="@lang('rsaPageTexts.insertPrimeNumber')" min="13" type="number"
                                           id="primeNumber1" name="primeNumber1"
                                           @if(isset($data['primeNumber1'])) value="{{ $data['primeNumber1'] }}"
                                           @endif required/>
                                    <x-generateInputButton
                                        type="{{ GenerateInputButton::TYPE_PRIME }}"
                                        size="1000"
                                        target="#primeNumber1">
                                    </x-generateInputButton>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="primeNumber2">
                                        @lang('rsaPageTexts.primeNumber') q
                                        <x-tooltipButton
                                            :tooltip="trans('rsaPageTexts.insertPrimeNumberTooltip')"></x-tooltipButton>
                                    </label>
                                    <div class="input-group">
                                    <input class="form-control primeNumber disableOnDecrypt"
                                           placeholder="@lang('rsaPageTexts.insertPrimeNumber')" min="23" type="number"
                                           id="primeNumber2" name="primeNumber2"
                                           @if(isset($data['primeNumber2'])) value="{{ $data['primeNumber2'] }}"
                                           @endif required/>
                                        <x-generateInputButton
                                            type="{{ GenerateInputButton::TYPE_PRIME }}"
                                            size="1000"
                                            target="#primeNumber2">
                                        </x-generateInputButton>
                                </div>
                                </div>
                                <div id="error-dialog" style="display: none;"
                                     class="text-danger">@lang('rsaPageTexts.noPrimeNumbers')
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
                                               value={{ CipherBase::ALGORITHM_ENCRYPT }}>
                                    </div>
                                    <div class="form-check form-switch">
                                        <label class="form-check-label" for="decrypt">@lang('baseTexts.decrypt')</label>
                                        <input class="form-check-input" required type="radio"
                                               id="decrypt" name="action"
                                               value={{ CipherBase::ALGORITHM_DECRYPT }}>
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
        @include('asymmetricCiphers/results/rsaCipherResult')
    @endif
@endsection
