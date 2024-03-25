@php
    use App\Algorithms\CipherBase;
    use App\Algorithms\Output\Steps\RSAStep;
    use App\Algorithms\Output\RsaOutput;
            /** @var RsaOutput $result */
            /** @var RSAStep $step */
@endphp
<section id="renderedResult" class="m-5 shadow-lg border rounded-4 p-5">
    <div class="container text-break">

        <h1 class="">
            <i class="fa-solid fa-comment"></i> @lang('baseTexts.cipherResult')
        </h1>
        <hr/>
        <div class="row align-items-start">
            <div class="col-lg-5">
                <h4>
                    <i class="fa-solid fa-keyboard"></i>
                    @lang('baseTexts.insertedText')
                </h4>
                <p>{{ $data['text'] }}</p>
            </div>

            @if($result->getOperation() === CipherBase::ALGORITHM_ENCRYPT)
                <div class="col-lg-5">
                    <h4>
                        <i class="fa-solid fa-keyboard"></i>
                        @lang('rsaPageTexts.asciiText')
                    </h4>
                    <p>{{ $result->getInputValue() }}</p>
                </div>
            @endif
        </div>

        @if($result->getOperation() === CipherBase::ALGORITHM_ENCRYPT)
            <div class="row align-items-start">
                <div class="col-lg-5">
                    <h4>1. @lang('rsaPageTexts.primeNumber')</h4>
                    <p>{{ $data['primeNumber1'] }}</p>
                </div>
                <div class="col-lg-5">
                    <h4>2. @lang('rsaPageTexts.primeNumber')</h4>
                    <p>{{ $data['primeNumber2'] }}</p>
                </div>
            </div>
        @endif

        <div class="row align-items-start">
            <div class="col">
                @if($result->getOutputValue())
                    <h4>
                        <i class="fa-solid fa-circle-down"></i>
                        @lang('baseTexts.outputText')
                        <x-copyButton :textToCopy="$result->getOutputValue()"></x-copyButton>
                    </h4>
                    <p>{{ $result->getOutputValue() }}</p>
                @endif
            </div>
        </div>

        @if($result->getOperation() === CipherBase::ALGORITHM_ENCRYPT)
            <div class="mt-3">
                <h2>
                    <i class="fa fa-calculator"></i>
                    @lang('rsaPageTexts.calculatedVariables')
                </h2>
                <div class="mt-2 row align-items-start">
                    <div class="col-lg-5">
                        <h4>
                            <x-tooltipButton :tooltip="trans('baseTexts.publicKey')"></x-tooltipButton>
                            n = p×q
                            <x-copyButton :textToCopy="$result->getN()"></x-copyButton>
                        </h4>
                        <p><b>{{ $result->getN() }}</b></p>
                    </div>
                    <div class="col-lg-5">
                        <h4>ϕ(n) = (p−1) × (q−1)</h4>
                        <p>{{ $result->getPhi() }}</p>
                    </div>
                    <div class="col-lg-5">
                        <h4>e = gcd(e,ϕ(n))=1)</h4>
                        <p>{{ $result->getE() }}</p>
                    </div>
                </div>
                <div class="mt-2 row align-items-start">
                    <div class="col-lg-5">
                        <h4>
                            <x-tooltipButton :tooltip="trans('baseTexts.privateKey')"></x-tooltipButton>
                            e · d ≡ 1 mod φ(n)
                            <x-copyButton :textToCopy="$result->getD()"></x-copyButton>
                        </h4>
                        <p><b>{{ $result->getD() }}</b></p>
                    </div>
                </div>
            </div>
        @endif


        <hr/>

        <div class="mt-4">
            <h1><i class="fa-solid fa-list-ol"></i> @lang('baseTexts.algorithmSteps')</h1>
            <div class="accordion" id="rsaSteps">
                @foreach($result->getSteps() as $step)
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#step{{ $loop->index }}" aria-expanded="false"
                                    aria-controls="step{{ $loop->index }}">
                                {{ $step->getInputChar() }} => {{ $step->getOutputChar() }}
                            </button>
                        </h2>
                        <div id="step{{ $loop->index }}" class="accordion-collapse collapse"
                             data-bs-parent="#rsaSteps">
                            <div class="accordion-body">
                                <div class="row align-items-start">
                                    <div class="col-lg-5">
                                        <h4><i class="fa-solid fa-keyboard"></i> @lang('rsaPageTexts.inputChar')
                                        </h4>
                                        <p>{{ $step->getInputChar() }}</p>
                                    </div>
                                    <div class="col-lg-5">
                                        <h4>
                                            <i class="fa-solid fa-circle-down"></i> @lang('rsaPageTexts.outputChar')
                                        </h4>
                                        <p>{{ $step->getOutputChar() }}</p>
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
