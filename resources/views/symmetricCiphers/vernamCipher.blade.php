@php
    use App\View\Components\GenerateInputButton;
@endphp
@extends("components/pageTemplate")
@section("title",__('vernamPageTexts.title'))
@section("comment",__('vernamPageTexts.metaComment'))
@section("content")

    <div class="anchor" id="info"></div>

    <section class="m-5">
        <div class="p-5 shadow-lg border rounded-4">
            <div class="">
                <div class="container">
                    <div class="row align-items-start">
                        <h1><i class="fa-solid fa-circle-info"></i> @lang('menuTexts.vernamCipher')</h1>
                        <hr/>
                        <div class="col-lg-7">
                            <p>@lang('vernamPageTexts.annotation')</p>
                        </div>

                        <div class="col-lg-5 m-auto">
                            <a href="{{asset('img/vernamPage/vernam_' . App::getLocale() . '.png')}}" target="_blank">
                                <img
                                    alt=""
                                    title="@lang('baseTexts.clickToSeeInFullSize')"
                                    width="100%"
                                    src="{{asset('img/vernamPage/vernam_' . App::getLocale() . '.png')}}"
                                />
                            </a>
                            <figure class="text-center schemaTitle">@lang("vernamPageTexts.schema")</figure>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-2">
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
                                        @lang('baseTexts.text')
                                        <x-tooltipButton :tooltip="trans('baseTexts.binaryInput')"></x-tooltipButton>
                                    </label>
                                    <div class="input-group">
                                        <input class="form-control binaryValidation" maxlength="30" minlength="1"
                                               required
                                               type="text"
                                               id="text"
                                               name="text"
                                               placeholder="@lang('baseTexts.binaryInputPrompt')"
                                               @if(isset($data["text"]))value="{{$data["text"]}}"@endif>
                                        <x-generateInputButton
                                            type="{{ GenerateInputButton::TYPE_BINARY }}"
                                            size="30"
                                            target="#text">
                                        </x-generateInputButton>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="key">@lang('baseTexts.key')
                                        <x-tooltipButton :tooltip="trans('baseTexts.binaryInput')"></x-tooltipButton>
                                    </label>
                                    <div class="input-group">
                                        <input class="form-control binaryValidation" minlength="1" maxlength="30"
                                               required type="text" id="key" name="key"
                                               placeholder="@lang('baseTexts.binaryInputPrompt')"
                                               @if(isset($data["key"]))value="{{$data["key"]}}" @else value="" @endif>
                                        <x-generateInputButton
                                            type="{{ GenerateInputButton::TYPE_BINARY }}"
                                            size="30"
                                            target="#key">
                                        </x-generateInputButton>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="p-2">
                                <fieldset>
                                    <label>
                                        @lang("baseTexts.action")
                                        <x-tooltipButton
                                            :tooltip="trans('vernamPageTexts.keyMustBeSameLengthAsInput')"></x-tooltipButton>
                                    </label>
                                    <br/>
                                    <div class="form-check form-switch">
                                        <label class="form-check-label" for="encrypt">@lang('baseTexts.encrypt')</label>
                                        <input class="form-check-input" required type="radio"
                                               id="encrypt" name="action"
                                               value={{\App\Algorithms\CipherBase::ALGORITHM_ENCRYPT}}>
                                    </div>
                                    <div class="form-check form-switch">
                                        <label class="form-check-label" for="decrypt">@lang('baseTexts.decrypt')</label>
                                        <input class="form-check-input" required type="radio"
                                               id="decrypt" name="action"
                                               value={{\App\Algorithms\CipherBase::ALGORITHM_DECRYPT}}>
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
        @include('symmetricCiphers/results/vernamCipherResult')
    @endif
@endsection
