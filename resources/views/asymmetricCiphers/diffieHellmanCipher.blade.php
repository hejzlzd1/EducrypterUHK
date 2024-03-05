@php
    use App\Algorithms\CipherBase;
    use App\View\Components\GenerateInputButton;
@endphp
@extends("components/pageTemplate")
@section("title",__('diffieHellmanPageTexts.title'))
@section("comment",__('diffieHellmanPageTexts.metaComment'))
@section("content")
    <div class="anchor" id="info"></div>

    <section class="m-5">
        <div class="shadow-lg border rounded-4 p-5">
            <div>
                <div class="container ">
                    <div class="row align-items-start">
                        <h1><i class="fa-solid fa-circle-info"></i> Diffie-Hellman</h1>
                        <hr/>
                        <div class="col-lg-7">
                            <p>@lang('diffieHellmanPageTexts.annotation')</p>
                        </div>

                        <div class="col-lg-5 m-t-5">
                            <a href="{{ asset('img/diffieHellmanPage/diffie' . App::getLocale() . '.png') }}"
                               target="_blank">
                                <img alt="" width="100%" title="@lang('baseTexts.clickToSeeInFullSize')"
                                     src="{{ asset('img/diffieHellmanPage/diffieHellman_' . App::getLocale() . '.png') }}"
                                />
                            </a>
                            <figure class="text-center schemaTitle">@lang("diffieHellmanPageTexts.schema")</figure>
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
                                    <label class="form-label" for="base">
                                        @lang('diffieHellmanPageTexts.base')
                                        <x-tooltipButton
                                            :tooltip="trans('diffieHellmanPageTexts.inputBase')"></x-tooltipButton>
                                    </label>
                                    <fieldset class="input-group">
                                        <input class="form-control" min=1 max="99999" required type="number"
                                               id="base" name="base"
                                               placeholder="@lang('diffieHellmanPageTexts.inputBase')"
                                               @if(isset($data['base'])) value="{{ $data['base'] }}" @endif
                                        />
                                        <x-generateInputButton
                                            type="{{ GenerateInputButton::TYPE_NUMBER }}"
                                            size="1500"
                                            target="#base">
                                        </x-generateInputButton>
                                    </fieldset>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="modulus">
                                        @lang('diffieHellmanPageTexts.modulus')
                                        <x-tooltipButton
                                            :tooltip="trans('diffieHellmanPageTexts.inputModulus')"></x-tooltipButton>
                                    </label>
                                    <fieldset class="input-group">
                                        <input class="form-control primeNumber" min=1 max="99999" required type="number"
                                               id="modulus" name="modulus"
                                               placeholder="@lang('diffieHellmanPageTexts.inputModulus')"
                                               @if(isset($data['modulus'])) value="{{ $data['modulus'] }}" @endif
                                        />
                                        <x-generateInputButton
                                            type="{{ GenerateInputButton::TYPE_PRIME }}"
                                            size="1500"
                                            target="#modulus">
                                        </x-generateInputButton>
                                    </fieldset>
                                </div>
                            </fieldset>
                            <fieldset class="row p-2">
                                <div class="col-lg-6">
                                    <label class="form-label" for="keyA">
                                        @lang('diffieHellmanPageTexts.keyA')
                                        <x-tooltipButton
                                            :tooltip="trans('diffieHellmanPageTexts.inputKey')"></x-tooltipButton>
                                    </label>
                                    <fieldset class="input-group">
                                        <input class="form-control" min=1 max="99999" required type="number"
                                               id="keyA" name="keyA"
                                               placeholder="@lang('diffieHellmanPageTexts.inputKey')"
                                               @if(isset($data['keyA'])) value="{{ $data['keyA'] }}" @endif
                                        />
                                        <x-generateInputButton
                                            type="{{ GenerateInputButton::TYPE_NUMBER }}"
                                            size="5000"
                                            target="#keyA">
                                        </x-generateInputButton>
                                    </fieldset>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="keyB">
                                        @lang('diffieHellmanPageTexts.keyB')
                                        <x-tooltipButton
                                            :tooltip="trans('diffieHellmanPageTexts.inputKey')"></x-tooltipButton>
                                    </label>
                                    <fieldset class="input-group">
                                        <input class="form-control" max="99999" min=1 required type="number"
                                               id="keyB" name="keyB"
                                               placeholder="@lang('diffieHellmanPageTexts.inputKey')"
                                               @if(isset($data['keyB'])) value="{{ $data['keyB'] }}" @endif />
                                        <x-generateInputButton
                                            type="{{ GenerateInputButton::TYPE_NUMBER }}"
                                            size="5000"
                                            target="#keyB">
                                        </x-generateInputButton>
                                    </fieldset>
                                </div>
                            </fieldset>

                            @include('components.submitButton')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if(isset($result))
        @include('asymmetricCiphers/results/diffieHellmanCipherResult')
    @endif
@endsection
