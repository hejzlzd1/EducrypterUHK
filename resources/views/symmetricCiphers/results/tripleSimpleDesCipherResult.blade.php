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
                <p>{{ $result->getInputValue() }}</p>
            </div>
            <div class="col-lg-5">
                <h4><i class="fa-solid fa-key"></i> @lang('baseTexts.key') K1 & K3</h4>
                <p>{{ $result->getKey() }}</p>
            </div>
            @if(strlen($data["key"]) !== strlen($result->getKey()))
                <div class="col-lg-5">
                    <h4><i class="fa-solid fa-key"></i> @lang('baseTexts.formattedKey') </h4>
                    <p>{{$result->getKey()}}</p>
                    <p class="text-black-50">@lang('baseTexts.keyFormatted')</p>
                </div>
            @endif
            <div class="col-lg-5">
                <h4><i class="fa-solid fa-key"></i> @lang('baseTexts.key') K2</h4>
                <p>{{ $result->getKey2() }}</p>
            </div>
            @if(strlen($data["key2"]) !== strlen($result->getKey2()))
                <div class="col-lg-5">
                    <h4><i class="fa-solid fa-key"></i> @lang('baseTexts.formattedKey') </h4>
                    <p>{{$result->getKey2()}}</p>
                    <p class="text-black-50">@lang('baseTexts.keyFormatted')</p>
                </div>
            @endif
            <div class="col-lg-5">
                <h4><i class="fa-solid fa-key"></i> @lang('baseTexts.key') K3</h4>
                <p>{{ $result->getKey3() }}</p>
            </div>
            @if(strlen($data["key3"]) !== strlen($result->getKey3()))
                <div class="col-lg-5">
                    <h4><i class="fa-solid fa-key"></i> @lang('baseTexts.formattedKey') </h4>
                    <p>{{$result->getKey3()}}</p>
                    <p class="text-black-50">@lang('baseTexts.keyFormatted')</p>
                </div>
            @endif
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
                                            <button class="accordion-button collapsed" type="button"
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
                                                                                <img
                                                                                    src="{{ $keyGenerationStep->getImageUrl() }}"
                                                                                    alt="" width="100%"/>
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
                                                                                <img src="{{ $step->getImageUrl() }}"
                                                                                     alt="" width="100%"/>
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
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

