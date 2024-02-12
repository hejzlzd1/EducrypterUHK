@php
    use App\Algorithms\CipherBase;
@endphp
@extends("components/pageTemplate")
@section("title",__('vigenerePageTexts.title'))
@section("comment",__('vigenerePageTexts.metaComment'))
@section("content")

    <div class="anchor" id="info"></div>

    <section class="m-5">
        <div class="p-5 shadow-lg border rounded-4">
            <div class="">
                <div class="container">
                    <div class="row align-items-start">
                        <h1><i class="fa-solid fa-circle-info"></i> @lang('menuTexts.vigenereCipher')</h1>
                        <hr/>
                        <div class="col-lg-8">
                            <p>@lang('vigenerePageTexts.annotation')</p>
                        </div>

                        <div class="col-lg-4 m-auto">
                            <a href="{{ asset('img/vigenerePage/vigenere.svg') }}" target="_blank">
                                <img
                                    alt=""
                                    title="@lang('baseTexts.clickToSeeInFullSize')"
                                    width="100%"
                                    src="{{ asset('img/vigenerePage/vigenere.svg') }}"
                                />
                            </a>
                            <figure class="text-center">@lang("vigenerePageTexts.table")</figure>
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
                                    </label>
                                    <input class="form-control" maxlength="40" minlength="1" required type="text"
                                           id="text"
                                           name="text"
                                           placeholder="@lang('baseTexts.inputText')"
                                           @if(isset($data["text"]))value="{{$data["text"]}}"@endif>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="key">@lang('baseTexts.key')
                                        <x-tooltipButton :tooltip="trans('baseTexts.textInputOnly')"></x-tooltipButton>
                                    </label>
                                    <input class="form-control" maxlength="30"
                                           required type="text" id="key" name="key"
                                           placeholder="@lang('baseTexts.insertKey')" pattern="^[a-zA-Z]*$"
                                           @if(isset($data["key"]))value="{{$data["key"]}}" @else value="" @endif>
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
        @include('symmetricCiphers/results/vigenereCipherResult')
    @endif
@endsection
