@php
    /** @var BasicOutput $result */
    use App\Algorithms\CipherBase;
    use App\Algorithms\Output\BasicOutput;
    use App\Algorithms\Output\BlowfishRound;
    use App\Algorithms\Output\Steps\BlowfishBlockStep;
@endphp
<section id="renderedResult" class="m-5 shadow-lg border rounded-4 p-5">
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
                <p>{{$data['text']}} ({{strlen($data['text'])*8}}bit)</p>
            </div>
            <div class="col-lg-5">
                <h4><i class="fa-solid fa-key"></i> @lang('baseTexts.key')</h4>
                <p>{{$data['key']}} ({{strlen($data['key'])*8}}bit)</p>
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
        <h1><i class="fa-solid fa-key"></i> @lang('baseTexts.subkeys'):</h1>
        <div class="d-flex flex-wrap">
            @foreach($result->getAdditionalInformation()["subkeys"] as $subkey)
                <div class="card col-md-2 m-2 p-1">
                    <div class="card-body">
                        <h4>@lang('baseTexts.key') #{{$loop->index+1}}</h4>
                        {{base64_encode($subkey)}}
                    </div>
                </div>
            @endforeach
        </div>
        <hr/>

        <div class="mt-4">
            <h1><i class="fa-solid fa-list-ol"></i> @lang('baseTexts.algorithmSteps')</h1>
            <p>
                @lang('baseTexts.inputSize') - {{$result->getAdditionalInformation()["inputSize"]}}bit
                ({{ceil($result->getAdditionalInformation()["inputSize"]/64)}} x
                64bit {{strtolower(trans("baseTexts.block"))}})
            </p>
            <div class="accordion" id="blockAccordion">
                <!-- blocks cycle -->
                @php /** @var BlowfishBlockStep $block */ @endphp
                @foreach($result->getSteps() as $block)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="blockHeading{{$loop->index}}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#block{{$loop->index}}" aria-expanded="true"
                                    aria-controls="block{{$loop->index}}">
                                @lang('baseTexts.block') {{$loop->index+1}} - @lang('baseTexts.output'):
                                "{{$block->getOutputValue()}}"
                            </button>
                        </h2>
                        <div id="block{{$loop->index}}" class="accordion-collapse collapse"
                             aria-labelledby="blockHeading{{$loop->index}}" data-bs-parent="#blockAccordion">
                            <div class="accordion-body">
                                <!-- nested accordion round steps cycle-->
                                <div class="accordion" id="stepAccordion{{$loop->index}}">
                                    @php /** @var BlowfishRound $step */ @endphp
                                    @foreach($block->getRounds() as $step)

                                        <div class="accordion-item">
                                            <h2 class="accordion-header"
                                                id="stepHeading{{$loop->index}}{{$loop->parent->index}}">
                                                <button class="accordion-button" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#stepCollapse{{$loop->index}}{{$loop->parent->index}}"
                                                        aria-expanded="true"
                                                        aria-controls="stepCollapse{{$loop->index}}{{$loop->parent->index}}">
                                                    @if(!$loop->last)
                                                        @lang('baseTexts.round') {{$loop->index+1}}
                                                    @else
                                                        @lang('baseTexts.finalOperation')
                                                    @endif
                                                </button>
                                            </h2>

                                            <div id="stepCollapse{{$loop->index}}{{$loop->parent->index}}"
                                                 class="accordion-collapse collapse"
                                                 aria-labelledby="stepHeading{{$loop->index}}{{$loop->parent->index}}"
                                                 data-bs-parent="#stepCollapse{{$loop->parent->index}}">
                                                <div class="accordion-body">
                                                    <div class="d-flex flex-wrap">
                                                        <div class="col-md-5">
                                                            <h3>
                                                                <i class="fa-solid fa-file-lines"></i>
                                                                @lang('blowfishPageTexts.leftInput')
                                                                (@lang('baseTexts.shortLeftSymbol'){{$loop->index + 1}}
                                                                )
                                                            </h3>
                                                            <p>{{$step->getInputLeft()}}</p>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <h3>
                                                                <i class="fa-solid fa-file-lines"></i>
                                                                @lang('blowfishPageTexts.rightInput')
                                                                (@lang('baseTexts.shortRightSymbol'){{$loop->index + 1}}
                                                                )
                                                            </h3>
                                                            <p>{{$step->getInputRight()}}</p>
                                                        </div>
                                                    </div>

                                                    <hr/>

                                                    @if(!$loop->last)
                                                        <div class="d-flex flex-wrap">
                                                            <div class="col-md">
                                                                <h3>
                                                                    <i class="fa-solid fa-key"></i>
                                                                    @lang('baseTexts.subkey')
                                                                    #{{$loop->index+1}} (K{{$loop->index+1}})
                                                                </h3>
                                                                <p>{{$step->getSubkey()}}</p>
                                                            </div>
                                                        </div>

                                                        <hr/>
                                                        <div
                                                            class="d-flex flex-wrap justify-content-start gap-5">
                                                            <div class="flex-item">
                                                                <h4>
                                                                    <i class="fa-solid fa-calculator"></i>
                                                                    @lang('baseTexts.shortLeftSymbol'){{$loop->index + 1}}
                                                                    ⊕ @lang('baseTexts.shortRightSymbol'){{$loop->index + 1}}
                                                                </h4>
                                                                <p>{{$step->getLeftBlockAfterXor()}}</p>
                                                            </div>
                                                            <div>
                                                                <h4><i class="fa-solid fa-right-long"></i></h4>
                                                            </div>
                                                            <div class="flex-item">
                                                                <h4>
                                                                    <i class="fa-solid fa-calculator"></i>
                                                                    @lang('blowfishPageTexts.rightBlockFeistelOutput')
                                                                    F(@lang('baseTexts.shortLeftSymbol'){{$loop->index + 1}}
                                                                    ⊕ K{{$loop->index + 1}})
                                                                </h4>
                                                                <p>{{$step->getRightBlockAfterFeistel()}}</p>
                                                            </div>
                                                            <div>
                                                                <h4><i class="fa-solid fa-right-long"></i></h4>
                                                            </div>
                                                            <div class="flex-item">
                                                                <h4>
                                                                    <i class="fa-solid fa-calculator"></i>
                                                                    F(@lang('baseTexts.shortLeftSymbol'){{$loop->index + 1}}
                                                                    ⊕ K{{$loop->index + 1}})
                                                                    ⊕ @lang('baseTexts.shortRightSymbol'){{$loop->index + 1}}
                                                                </h4>
                                                                <p>{{$step->getRightBlockAfterXor()}}</p>
                                                            </div>
                                                        </div>

                                                    @else

                                                        <div class="d-flex flex-wrap">
                                                            <div class="col-md-5">
                                                                <h3>
                                                                    <i class="fa-solid fa-key"></i> @lang('baseTexts.subkey')
                                                                    #17 (K17)</h3>
                                                                <p>{{$result->getAdditionalInformation()["subkey17"]}}</p>
                                                            </div>

                                                            <div class="col-md-5">
                                                                <h3>
                                                                    <i class="fa-solid fa-key"></i> @lang('baseTexts.subkey')
                                                                    #18 (K18)</h3>
                                                                <p>{{$result->getAdditionalInformation()["subkey18"]}}</p>
                                                            </div>
                                                        </div>

                                                        <hr/>
                                                        <div class="d-flex flex-wrap">
                                                            <div class="col-md-5">
                                                                <h4>
                                                                    <i class="fa-solid fa-calculator"></i>
                                                                    @lang('baseTexts.shortLeftSymbol')16 ⊕ K18
                                                                </h4>
                                                                <p>{{$step->getLeftBlockAfterXor()}}</p>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <h4>
                                                                    <i class="fa-solid fa-calculator"></i>
                                                                    @lang('baseTexts.shortRightSymbol')16 ⊕ K17
                                                                </h4>
                                                                <p>{{$step->getRightBlockAfterXor()}}</p>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
