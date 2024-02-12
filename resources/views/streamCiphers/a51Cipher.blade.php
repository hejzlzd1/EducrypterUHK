@php
    use App\Algorithms\CipherBase;
    use App\View\Components\GenerateInputButton;
@endphp
@extends("components/pageTemplate")
@section("title",__('a51PageTexts.title'))
@section("comment",__('a51PageTexts.metaComment'))
@section("content")
    <div class="anchor" id="info"></div>

    <section class="m-5">
        <div class="shadow-lg border rounded-4 p-5">
            <div>
                <div class="container ">
                    <div class="row align-items-start">
                        <h1><i class="fa-solid fa-circle-info"></i> A5/1</h1>
                        <hr/>
                        <div class="col-lg-8">
                            <p>@lang('a51PageTexts.annotation')</p>
                        </div>

                        <div class="col-lg-4 m-auto">
                            <a href="{{ asset('img/a51Page/a51_' . App::getLocale() . '.png')}}" target="_blank">
                                <img alt="" title="@lang('baseTexts.clickToSeeInFullSize')" width="100%"
                                     src="{{ asset('img/a51Page/a51_' . App::getLocale() . '.png') }}">
                            </a>
                            <figure class="text-center">@lang("a51PageTexts.imageDescription")</figure>
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
                                        @lang('baseTexts.binaryInput')
                                        <x-tooltipButton
                                            :tooltip="trans('baseTexts.binaryInputPrompt')"></x-tooltipButton>
                                    </label>
                                    <div class="input-group">
                                        <input class="form-control binaryValidation" maxlength="64" minlength="1"
                                               required
                                               type="text"
                                               id="text" name="text"
                                               placeholder="@lang('baseTexts.binaryInputPrompt')"
                                               @if(isset($data['text'])) value="{{ $data['text'] }}" @endif />
                                        <x-generateInputButton
                                            type="{{ GenerateInputButton::TYPE_BINARY }}"
                                            size="20"
                                            target="#text">
                                        </x-generateInputButton>
                                    </div>

                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="key">
                                        @lang('baseTexts.key')
                                        <x-tooltipButton
                                            :tooltip="trans('baseTexts.binaryInputPrompt')"></x-tooltipButton>
                                    </label>
                                    <div class="input-group">
                                        <input class="form-control binaryValidation" min="1" max="64" type="text"
                                               id="key"
                                               name="key" placeholder="@lang('baseTexts.binaryInputPrompt')" required
                                               @if(isset($data['key'])) value="{{ $data['key'] }}"
                                               @else value="" @endif />
                                        <x-generateInputButton
                                            type="{{ GenerateInputButton::TYPE_BINARY }}"
                                            size="20"
                                            target="#key">
                                        </x-generateInputButton>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="row p-2">
                                <div class="col-lg-6">
                                    <label class="form-label" for="dataFrame">
                                        @lang('a51PageTexts.dataFrame')
                                        <x-tooltipButton
                                            :tooltip="trans('a51PageTexts.dataFrameNumberExplanation')"></x-tooltipButton>
                                    </label>
                                    <div class="input-group">
                                        <input class="form-control" type="number" max="4000" min="0" id="dataFrame"
                                               name="dataFrame" placeholder="@lang('a51PageTexts.inputDataFrame')"
                                               required
                                               @if(isset($data['dataFrame'])) value="{{ $data['dataFrame'] }}"
                                               @else value="" @endif />
                                        <x-generateInputButton
                                            type="{{ GenerateInputButton::TYPE_NUMBER }}"
                                            size="4000"
                                            target="#dataFrame">
                                        </x-generateInputButton>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="p-2">
                                <fieldset>
                                    <label>@lang('baseTexts.action')</label>
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
        @include('streamCiphers/results/a51CipherResult')
    @endif
@endsection
