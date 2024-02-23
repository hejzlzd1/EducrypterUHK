@php
    use App\Algorithms\CipherBase;
    use App\View\Components\GenerateInputButton;
@endphp
@extends("components/pageTemplate")
@section("title",__('tripleDesPageTexts.title'))
@section("comment",__('tripleDesPageTexts.metaComment'))
@section("content")

    <div class="anchor" id="info"></div>

    <section class="m-5">
        <div class="shadow-lg border rounded-4 p-5">
            <div>
                <div class="container">
                    <div class="row align-items-start">
                        <h1><i class="fa-solid fa-circle-info"></i> Triple DES</h1>
                        <hr/>
                        <div class="col-lg-6">
                            <p>@lang('tripleDesPageTexts.annotation')</p>
                        </div>
                        <div class="col-lg-6 m-t-5">
                            <a href="{{asset('img/tripleDesPage/tripleDes_' . App::getLocale() . '.png')}}"
                               target="_blank">
                                <img
                                    alt=""
                                    width="100%"
                                    title="@lang('baseTexts.clickToSeeInFullSize')"
                                    src="{{asset('img/tripleDesPage/tripleDes_' . App::getLocale() . '.png')}}"
                                />
                            </a>
                            <figure class="text-center schemaTitle">@lang('tripleDesPageTexts.blockSchema')</figure>
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
                                               placeholder="@lang('baseTexts.insertInputData')"
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
                                        @lang('simpleDesPageTexts.binaryKey') K1 & K3
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
                                <div class="col-lg-6 mt-2">
                                    <label class="form-label" for="key2">
                                        @lang('simpleDesPageTexts.binaryKey') K2
                                        <x-tooltipButton
                                            :tooltip="trans('simpleDesPageTexts.binaryKey')"></x-tooltipButton>
                                    </label>
                                    <div class="input-group">
                                        <input class="form-control binaryValidation" minlength="1" maxlength="10"
                                               type="text" id="key2"
                                               name="key2"
                                               placeholder="@lang('baseTexts.binaryInputPrompt')"
                                               @if(isset($data['key2'])) value="{{$data['key2']}}"
                                               @else value="" @endif>
                                        <x-generateInputButton
                                            type="{{ GenerateInputButton::TYPE_BINARY }}"
                                            size="10"
                                            target="#key2">
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
        @include('symmetricCiphers/results/tripleSimpleDesCipherResult')
    @endif
@endsection
