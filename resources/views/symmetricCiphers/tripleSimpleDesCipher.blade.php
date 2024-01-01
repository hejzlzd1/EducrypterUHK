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
                        <div class="col-lg-8">
                            <p>@lang('tripleDesPageTexts.annotation')</p>
                        </div>
                        <div class="col-lg-4 m-auto">
                            <a href="{{asset('img/tripleDesPage/tripleDes_' . App::getLocale() . '.png')}}"
                               target="_blank">
                                <img alt="" width="100%" title="@lang('baseTexts.clickToSeeInFullSize')"
                                     src="{{asset('img/tripleDesPage/tripleDes_' . App::getLocale() . '.png')}}"
                                     class="rounded-4"></a>
                            <figure class="text-center">@lang('tripleDesPageTexts.blockSchema')</figure>
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
                                        @lang('baseTexts.key') K1 & K3
                                        <x-tooltipButton
                                            :tooltip="trans('baseTexts.binaryInputPrompt')"></x-tooltipButton>
                                    </label>
                                    <input class="form-control binaryValidation" minlength="1" maxlength="10"
                                           type="text" id="key"
                                           name="key"
                                           placeholder="@lang('baseTexts.insertKey')"
                                           @if(isset($data['key'])) value="{{$data['key']}}" @else value="" @endif>
                                </div>
                                <div class="col-lg-6 mt-2">
                                    <label class="form-label" for="key2">
                                        @lang('baseTexts.key') K2
                                        <x-tooltipButton
                                            :tooltip="trans('baseTexts.binaryInputPrompt')"></x-tooltipButton>
                                    </label>
                                    <input class="form-control binaryValidation" minlength="1" maxlength="10"
                                           type="text" id="key2"
                                           name="key2"
                                           placeholder="@lang('baseTexts.insertKey')"
                                           @if(isset($data['key2'])) value="{{$data['key2']}}" @else value="" @endif>
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
            /** @var App\Algorithms\Output\TSDESOutput $result */
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
                        <h4><i class="fa-solid fa-key"></i> @lang('baseTexts.key') K1 & K3</h4>
                        <p>{{$result->getKey()}}</p>
                    </div>
                    <div class="col-lg-5">
                        <h4><i class="fa-solid fa-key"></i> @lang('baseTexts.key') K2</h4>
                        <p>{{$result->getKey2()}}</p>
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
                    <div class="accordion" id="outputs">
                        @foreach($result->getDesOutputs() as $simpleDES)
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#output{{$loop->index}}" aria-expanded="true"
                                            aria-controls="output{{$loop->index}}">
                                        <i class="fa-solid fa-circle-arrow-down"></i> 
                                        @lang('baseTexts.output') #{{ $loop->index + 1 }}
                                        => {{$simpleDES->getOutputValue()}}
                                    </button>
                                </h2>
                                <div id="output{{$loop->index}}" class="accordion-collapse collapse">
                                    <div class="accordion-body">

                                        <div class="row align-items-start">
                                            <div class="col-lg-5">
                                                <h4>
                                                    <i class="fa-solid fa-keyboard"></i>
                                                    @if($simpleDES->getOperation() === \App\Algorithms\CipherBase::ALGORITHM_ENCRYPT)
                                                        @lang('baseTexts.plainText')
                                                    @else
                                                        @lang('baseTexts.encryptedText')
                                                    @endif
                                                </h4>
                                                <p>{{$simpleDES->getInputValue()}}</p>
                                            </div>
                                            <div class="col-lg-5">
                                                <h4><i class="fa-solid fa-key"></i> @lang('baseTexts.key')</h4>
                                                <p>{{$simpleDES->getKey()}}</p>
                                            </div>
                                        </div>
                                        <div class="row align-items-start">
                                            <div class="col-lg">
                                                <h4>
                                                    <i class="fa-solid fa-circle-down"></i>
                                                    @if($simpleDES->getOperation() === \App\Algorithms\CipherBase::ALGORITHM_ENCRYPT)
                                                        @lang('baseTexts.encryptedText')
                                                    @else
                                                        @lang('baseTexts.plainText')
                                                    @endif
                                                    <x-copyButton
                                                        :textToCopy="$simpleDES->getOutputValue()"></x-copyButton>
                                                </h4>
                                                <p>{{$simpleDES->getOutputValue()}}</p>
                                            </div>
                                        </div>

                                        @php //Here starts real accordions with simple DES steps @endphp
                                        <div class="accordion" id="simpleDESSteps">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#keyGeneration{{$loop->index}}"
                                                            aria-expanded="false"
                                                            aria-controls="keyGeneration{{$loop->index}}">
                                                        <i class="fa-solid fa-key"></i> 
                                                        @lang('simpleDesPageTexts.keyGeneration')
                                                    </button>
                                                </h2>
                                                <div id="keyGeneration{{$loop->index}}"
                                                     class="accordion-collapse collapse">
                                                    <div class="accordion-body">
                                                        <div class="accordion" id="keyGenerationStepsAccordion">
                                                            @foreach($simpleDES->getKeyGenerationSteps() as $keyGenerationStep)
                                                                <div class="accordion-item">
                                                                    <h2 class="accordion-header">
                                                                        <button class="accordion-button collapsed"
                                                                                type="button"
                                                                                data-bs-toggle="collapse"
                                                                                data-bs-target="#keyGenerationStep{{$loop->index}}-{{$loop->parent->index}}"
                                                                                aria-expanded="false"
                                                                                aria-controls="keyGenerationStep{{$loop->index}}-{{$loop->parent->index}}">
                                                                            {{$loop->index + 1}}
                                                                            . {{$keyGenerationStep->getTranslatedActionName()}}
                                                                        </button>
                                                                    </h2>
                                                                    <div
                                                                        id="keyGenerationStep{{$loop->index}}-{{$loop->parent->index}}"
                                                                        class="accordion-collapse collapse">
                                                                        <div class="accordion-body">
                                                                            <div class="d-flex flex-wrap">
                                                                                <div class="col-md-5">
                                                                                    <h3>
                                                                                        <i class="fa-solid fa-file-lines"></i>
                                                                                        @lang('baseTexts.input')
                                                                                    </h3>
                                                                                    <p>{{$keyGenerationStep->getInput()}}</p>
                                                                                </div>
                                                                                <div class="col-md-5">
                                                                                    <h3>
                                                                                        <i class="fa-solid fa-file-lines"></i>
                                                                                        @lang('baseTexts.output')
                                                                                    </h3>
                                                                                    {{$keyGenerationStep->getOutput()}}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#operationsSteps{{$loop->index}}"
                                                            aria-expanded="false"
                                                            aria-controls="operationsSteps{{$loop->index}}">
                                                        <i class="fa-solid fa-gear"></i> {{\App\Algorithms\CipherBase::getStringAlgorithmOperation($result->getOperation())}}
                                                    </button>
                                                </h2>
                                                <div id="operationsSteps{{$loop->index}}"
                                                     class="accordion-collapse collapse">
                                                    <div class="accordion-body">
                                                        <div class="accordion" id="stepsAccordion">
                                                            @foreach($simpleDES->getSteps() as $step)
                                                                <div class="accordion-item">
                                                                    <h2 class="accordion-header">
                                                                        <button class="accordion-button collapsed"
                                                                                type="button"
                                                                                data-bs-toggle="collapse"
                                                                                data-bs-target="#step{{$loop->index}}-{{$loop->parent->index}}"
                                                                                aria-expanded="false"
                                                                                aria-controls="step{{$loop->index}}-{{$loop->parent->index}}">
                                                                            {{$loop->index + 1}}
                                                                            . {{$step->getTranslatedActionName()}}
                                                                        </button>
                                                                    </h2>
                                                                    <div
                                                                        id="step{{$loop->index}}-{{$loop->parent->index}}"
                                                                        class="accordion-collapse collapse">
                                                                        <div class="accordion-body">
                                                                            <div class="d-flex flex-wrap">
                                                                                <div class="col-md-5">
                                                                                    <h3>
                                                                                        <i class="fa-solid fa-file-lines"></i>
                                                                                        @lang('baseTexts.input')
                                                                                    </h3>
                                                                                    <p>{{$step->getInput()}}</p>
                                                                                </div>
                                                                                <div class="col-md-5">
                                                                                    <h3>
                                                                                        <i class="fa-solid fa-file-lines"></i>
                                                                                        @lang('baseTexts.output')
                                                                                    </h3>
                                                                                    {{$step->getOutput()}}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </section>
    @endif

    @include("components/footer")
@endsection
