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
                        <h1><i class="fa-solid fa-circle-info"></i> Simple DES</h1>
                        <hr/>
                        <div class="col-lg-8">
                            <p>@lang('simpleDesPageTexts.annotation')</p>
                        </div>

                        <div class="col-lg-4 m-auto">
                            <a href="{{asset("img/simpleDesPage/simpleDes_".App::getLocale().".png")}}" target="_blank">
                                <img width="100%"
                                     src="{{asset("img/simpleDesPage/simpleDes".App::getLocale().".png")}}"
                                     class="rounded-4"></a>
                            <figure class="text-center">@lang("simpleDesPageTexts.blockSchema")</figure>
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
                                    <label class="form-label" for="text">
                                        @lang('baseTexts.text')
                                        <x-tooltipButton
                                            :tooltip="trans('baseTexts.binaryInputPrompt')"></x-tooltipButton>
                                    </label>
                                    <input class="form-control binaryValidation" minlength="1" maxlength="8" required
                                           type="text"
                                           id="text"
                                           name="text"
                                           placeholder="@lang('baseTexts.insertInputData')"
                                           @if(isset($data['text']))value="{{$data['text']}}"@endif>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="key">
                                        @lang('baseTexts.key')
                                        <x-tooltipButton
                                            :tooltip="trans('baseTexts.binaryInputPrompt')"></x-tooltipButton>
                                    </label>
                                    <input class="form-control binaryValidation" minlength="1" maxlength="10"
                                           type="text" id="key"
                                           name="key"
                                           placeholder="@lang('baseTexts.insertKey')"
                                           @if(isset($data['key'])) value="{{$data['key']}}" @else value="" @endif>
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
        @php
        /** @var App\Algorithms\Output\BasicOutput $result */
        @endphp
        <section class="m-5 shadow-lg border rounded-4 p-5">
            <div class="container text-break">

                <h1 class=""><i class="fa-solid fa-comment"></i> @lang('baseTexts.cipherResult')</h1>
                <hr/>
                <div class="row align-items-start">
                    <div class="col-lg-5">
                        <h4>
                            <i class="fa-solid fa-keyboard"></i>
                            @if($result->getOperation() === \App\Algorithms\CipherBase::ALGORITHM_ENCRYPT)
                                @lang('baseTexts.plainText')
                            @else
                                @lang('baseTexts.encryptedText')
                            @endif
                        </h4>
                        <p>{{$result->getInputValue()}}</p>
                    </div>
                    <div class="col-lg-5">
                        <h4><i class="fa-solid fa-key"></i> @lang('baseTexts.key')</h4>
                        <p>{{$result->getKey()}}</p>
                    </div>
                </div>
                <div class="row align-items-start">
                    <div class="col-lg">
                        <h4>
                            <i class="fa-solid fa-circle-down"></i>
                            @if($result->getOperation() === \App\Algorithms\CipherBase::ALGORITHM_ENCRYPT)
                                @lang('baseTexts.encryptedText')
                            @else
                                @lang('baseTexts.plainText')
                            @endif
                            <x-copyButton :textToCopy="$result->getOutputValue()"></x-copyButton>
                        </h4>
                        <p>{{$result->getOutputValue()}}</p>
                    </div>
                </div>

                <hr/>

                <div class="mt-4">
                    <h1><i class="fa-solid fa-list-ol"></i> @lang('baseTexts.algorithmSteps')</h1>
                    <div class="accordion" id="sdesSteps">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#keyGenSteps" aria-expanded="true"
                                            aria-controls="stepKeygen">
                                        @lang('simpleDesPageTexts.keygen')
                                    </button>
                                </h2>
                                <div id="stepKeygen" class="accordion-collapse collapse"
                                     data-bs-parent="#stepKeygen">
                                    <div class="accordion-body">
                                        <div class="row align-items-start">
                                            :)
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#steps" aria-expanded="true"
                                            aria-controls="steps">
                                        @lang('baseTexts.action'): {{\App\Algorithms\CipherBase::getStringAlgorithmOperation($result->getOperation())}}
                                    </button>
                                </h2>
                                <div id="stepKeygen" class="accordion-collapse collapse"
                                     data-bs-parent="#sdesSteps">
                                    <div class="accordion-body">
                                        <div class="row align-items-start">
                                            :)
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>

            </div>
        </section>
    @endif

    @include("components/footer")
@endsection
