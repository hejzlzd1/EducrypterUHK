@php
    use App\Algorithms\CipherBase;
    use App\View\Components\GenerateInputButton;
@endphp
@extends("components/pageTemplate")
@section("title",__('blowfishPageTexts.title'))
@section("comment",__('blowfishPageTexts.metaComment'))
@section("content")

    <div class="anchor" id="info"></div>

    <section class="mainContent">
        <div class="shadow-lg border rounded-4 secondaryBox p-5">
            <div>
                <div class="container">
                    <div class="row align-items-start">
                        <h1><i class="fa-solid fa-circle-info"></i> Blowfish</h1>
                        <hr/>
                        <div class="col-lg-8">
                            <p>@lang('blowfishPageTexts.annotation')</p>
                        </div>

                        <div class="col-lg-4 m-auto">
                            <a href="{{asset("img/blowfishPage/blowfish_".App::getLocale().".png")}}" target="_blank">
                                <img alt=""
                                     title="@lang('baseTexts.clickToSeeInFullSize')"
                                     width="100%"
                                     src="{{asset("img/blowfishPage/blowfish_".App::getLocale().".png")}}"
                                />
                            </a>
                            <figure class="text-center schemaTitle">@lang("blowfishPageTexts.blockSchema")</figure>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="container">
                    <div class="row align-items-start">
                        <h1 class=""><i class="fa-regular fa-file-lines"></i> @lang('baseTexts.cipherForm')</h1>
                        <p class="text-black-50">@lang('baseTexts.formInfoDescription')</p>
                        <hr/>
                        <form action="" method="post">
                            @csrf
                            <fieldset class="row p-2">
                                <div class="col-lg-6">
                                    <label class="form-label" for="text">@lang('baseTexts.text')</label>
                                    <div class="input-group">
                                    <input class="form-control" minlength="1" maxlength="400" required type="text"
                                           id="text"
                                           name="text"
                                           placeholder="@lang('baseTexts.inputText')"
                                           @if(isset($data['text']))value="{{$data['text']}}"@endif>
                                    <x-generateInputButton
                                        type="{{ GenerateInputButton::TYPE_TEXT }}"
                                        size="30"
                                        target="#text">
                                    </x-generateInputButton>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="key">
                                        @lang('baseTexts.key')
                                        <x-tooltipButton :tooltip="trans('baseTexts.textInputOnly')"></x-tooltipButton>
                                    </label>
                                    <div class="input-group">
                                    <input class="form-control" maxlength="30" type="text" id="key" name="key"
                                           required
                                           placeholder="@lang('baseTexts.insertKey')" pattern="^[a-zA-Z ]*$"
                                           @if(isset($data['key'])) value="{{$data['key']}}" @else value="" @endif>
                                        <x-generateInputButton
                                            type="{{ GenerateInputButton::TYPE_TEXT }}"
                                            size="30"
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

    @if(isset($data))
        @include('symmetricCiphers/results/blowfishCipherResult')
    @endif
@endsection
