@php
    /** @var App\Algorithms\Output\SDESOutput $result */
    use App\Algorithms\CipherBase;
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
            @if(strlen($data["key"]) !== strlen($result->getKey()))
                <div class="col-lg-5">
                    <h4><i class="fa-solid fa-key"></i> @lang('baseTexts.formattedKey') </h4>
                    <p>{{$result->getKey()}}</p>
                    <p class="text-black-50">@lang('baseTexts.keyFormatted')</p>
                </div>
            @endif
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
            <div class="accordion" id="simpleDESSteps">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#keyGeneration" aria-expanded="false"
                                aria-controls="keyGeneration">
                            <i class="fa-solid fa-key"></i> 
                            @lang('simpleDesPageTexts.keyGeneration') - @lang('simpleDesPageTexts.binaryKey')
                        </button>
                    </h2>
                    <div id="keyGeneration" class="accordion-collapse collapse">
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
                                                            <img src="{{ $keyGenerationStep->getImageUrl() }}" alt=""
                                                                 width="100%"/>
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
                                                            <img src="{{ $step->getImageUrl() }}" alt="" width="100%"/>
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
