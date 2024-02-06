@php
    use App\Algorithms\CipherBase;
    use App\Algorithms\Output\Steps\NamedStep;
@endphp
@extends("components/pageTemplate")
@section("title",__('simpleAesPageTexts.title'))
@section("comment",__('simpleAesPageTexts.metaComment'))
@section("content")

    <div class="anchor" id="info"></div>

    <section class="m-5">
        <div class="shadow-lg border rounded-4 p-5">
            <div>
                <div class="container">
                    <div class="row align-items-start">
                        <h1><i class="fa-solid fa-circle-info"></i> Simple AES</h1>
                        <hr/>
                        <div class="col-lg-8">
                            <p>@lang('simpleAesPageTexts.annotation')</p>

                            <h4>@lang('simpleAesPageTexts.additionalSchemas')</h4>
                            <div id="carouselControls" class="carousel col-lg-8 mb-5" data-bs-ride="carousel" data-bs-interval="10000">
                                <div class="carousel-inner custom-carousel">
                                    <div class="carousel-item active">
                                        <a href="{{ asset('img/simpleAesPage/addKey.png' )}}" target="_blank">
                                            <img alt="" src="{{ asset('img/simpleAesPage/addKey.png') }}"
                                                 class="d-block w-100" title="@lang('baseTexts.clickToSeeInFullSize')">
                                        </a>
                                        <div class="label">
                                            @lang('simpleAesPageTexts.addKey')
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <a href="{{ asset('img/simpleAesPage/addKey.png') }}" target="_blank">
                                            <img alt="" src="{{ asset('img/simpleAesPage/addKey.png') }}"
                                                 class="d-block w-100" title="@lang('baseTexts.clickToSeeInFullSize')">
                                        </a>
                                        <div class="label">
                                            @lang('simpleAesPageTexts.addKey')
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
                        <div class="col-lg-4 m-auto">
                            <a href="{{asset('img/simpleAesPage/simpleAes_' . App::getLocale() . '.png')}}"
                               target="_blank">
                                <img
                                    alt=""
                                    width="100%"
                                    title="@lang('baseTexts.clickToSeeInFullSize')"
                                    src="{{asset('img/simpleAesPage/simpleAes_' . App::getLocale() . '.png')}}"
                                />
                            </a>
                            <figure class="text-center">
                                @lang('simpleAesPageTexts.blockSchema')
                            </figure>
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
                                        @lang('simpleAesPageTexts.binaryInput')
                                        <x-tooltipButton
                                            :tooltip="trans('baseTexts.binaryInputPrompt')"></x-tooltipButton>
                                    </label>
                                    <input class="form-control binaryValidation" minlength="1" maxlength="16" required
                                           type="text"
                                           id="text"
                                           name="text"
                                           placeholder="@lang('baseTexts.binaryInputPrompt')"
                                           @if(isset($data['text']))value="{{$data['text']}}"@endif>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="key">
                                        @lang('simpleAesPageTexts.binaryKey')
                                        <x-tooltipButton
                                            :tooltip="trans('baseTexts.binaryInputPrompt')"></x-tooltipButton>
                                    </label>
                                    <input class="form-control binaryValidation" minlength="1" maxlength="16"
                                           type="text" id="key"
                                           name="key"
                                           placeholder="@lang('baseTexts.binaryInputPrompt')"
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
                            @if($result->getOperation() === CipherBase::ALGORITHM_ENCRYPT)
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
                            @if($result->getOperation() === CipherBase::ALGORITHM_ENCRYPT)
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
                    <div class="accordion" id="simpleAESSteps">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#keyGeneration" aria-expanded="true"
                                        aria-controls="keyGeneration">
                                    <i class="fa-solid fa-key"></i> 
                                    @lang('simpleAesPageTexts.keyGeneration') - @lang('simpleAesPageTexts.binaryKey')
                                </button>
                            </h2>
                            <div id="keyGeneration" class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                    <div class="accordion" id="keyGenerationStepsAccordion">
                                        @foreach($result->getKeyGenerationSteps() as $keyGenerationStep)
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#keyGenerationStep{{$loop->index}}"
                                                            aria-expanded="false"
                                                            aria-controls="keyGenerationStep{{$loop->index}}">
                                                        {{$loop->index + 1}}
                                                        . {{$keyGenerationStep->getTranslatedActionName()}}
                                                    </button>
                                                </h2>
                                                <div id="keyGenerationStep{{$loop->index}}"
                                                     class="accordion-collapse collapse">
                                                    <div class="accordion-body">
                                                        <div class="d-flex flex-wrap">
                                                            <div class="col-md-6">
                                                                <h3>
                                                                    <i class="fa-solid fa-file-lines"></i>
                                                                    @lang('baseTexts.input')
                                                                </h3>
                                                                <p>{{$keyGenerationStep->getInput()}}</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <h3>
                                                                    <i class="fa-solid fa-file-lines"></i>
                                                                    @lang('baseTexts.output')
                                                                </h3>
                                                                {{$keyGenerationStep->getOutput()}}
                                                            </div>
                                                            @if ($keyGenerationStep->getImageUrl() !== null)
                                                                <div class="col-md-6">
                                                                    <img src="{{ $keyGenerationStep->getImageUrl() }}" alt="" width="100%" />
                                                                </div>
                                                            @endif
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
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#operationsSteps" aria-expanded="false"
                                        aria-controls="operationsSteps">
                                    <i class="fa-solid fa-gear"></i> {{CipherBase::getStringAlgorithmOperation($result->getOperation())}}
                                    - @lang('simpleDesPageTexts.binaryInput')
                                </button>
                            </h2>
                            <div id="operationsSteps" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <div class="accordion" id="stepsAccordion">
                                        @php /** @var NamedStep $step */ @endphp
                                        @foreach($result->getSteps() as $step)
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#step{{$loop->index}}"
                                                            aria-expanded="false"
                                                            aria-controls="step{{$loop->index}}">
                                                        {{$loop->index + 1}}. {{$step->getTranslatedActionName()}}
                                                    </button>
                                                </h2>
                                                <div id="step{{$loop->index}}"
                                                     class="accordion-collapse collapse">
                                                    <div class="accordion-body">
                                                        <div class="d-flex flex-wrap">
                                                            <div class="col-md-6">
                                                                <h3>
                                                                    <i class="fa-solid fa-file-lines"></i>
                                                                    @lang('baseTexts.input')
                                                                </h3>
                                                                <p>{{$step->getInput()}}</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <h3>
                                                                    <i class="fa-solid fa-file-lines"></i>
                                                                    @lang('baseTexts.output')
                                                                </h3>
                                                                {{$step->getOutput()}}
                                                            </div>
                                                            @if ($step->getImageUrl() !== null)
                                                                <div class="col-md-6">
                                                                    <img src="{{ $step->getImageUrl() }}" alt="" width="100%" />
                                                                </div>
                                                            @endif
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
        </section>
    @endif

    @include("components/footer")
@endsection
