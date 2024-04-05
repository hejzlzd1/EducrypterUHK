@php
    use App\Algorithms\CipherBase;
    /** @var App\Algorithms\Output\Steps\A5_1Step $step */
    /** @var App\Algorithms\Output\BasicOutput $result */
@endphp

<section id="renderedResult" class="m-5 shadow-lg border rounded-4 secondaryBox p-5">
    <div class="container text-break">
        <h1 class="">
            <i class="fa-solid fa-comment"></i> @lang('baseTexts.cipherResult')
        </h1>
        <hr/>
        <div class="row align-items-start">
            <div class="col-lg-5">
                <h4><i class="fa-solid fa-keyboard"></i> @lang('baseTexts.insertedText')</h4>
                <p>{{ $result->getInputValue() }}</p>
            </div>
            <div class="col-lg-5">
                <h4><i class="fa-solid fa-key"></i> @lang('baseTexts.key')</h4>
                <p>{{ $result->getKey() }}</p>
            </div>
            <div class="col-lg-5">
                <h4><i class="fa-solid fa-key"></i> @lang('a51PageTexts.dataFrame')</h4>
                <p>{{ $result->getAdditionalInformation()['dataFrame'] }}
                    => {{ $result->getAdditionalInformation()['dataFrameBinary'] }}</p>
            </div>
            <div class="col-lg-5">
                <h4>
                    <i class="fa-solid fa-key"></i>
                    @lang('a51PageTexts.keyStream')
                </h4>
                <p>{{ $result->getAdditionalInformation()['keyStream'] }}</p>
            </div>
        </div>
        <div class="row align-items-start">
            <div class="col">
                <h4>
                    <i class="fa-solid fa-circle-down"></i>
                    @lang('baseTexts.outputText')
                    <x-copyButton :textToCopy="$result->getOutputValue()"></x-copyButton>
                </h4>
                <p>{{ $result->getOutputValue() }}</p>
            </div>
        </div>
        <hr/>

        <div class="mt-4">
            <h1><i class="fa-solid fa-list-ol"></i> @lang('baseTexts.algorithmSteps')</h1>
            <div class="accordion" id="accordion">
                @foreach($result->getSteps() as $step)
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#step{{ $loop->index }}" aria-expanded="false"
                                    aria-controls="step{{ $loop->index }}">
                                @lang('baseTexts.stepNum') {{ $loop->index + 1 }}:
                                {{ substr($result->getOutputValue(), 0, $loop->index) }}
                                <b>{{ $result->getOutputValue()[$loop->index] }}</b>
                            </button>
                        </h2>
                        <div id="step{{ $loop->index }}"
                             class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <div class="majorityBit">
                                    <h5>
                                        <i class="fa-solid fa-gears"></i> @lang('a51PageTexts.majorityBit'):
                                    </h5>
                                    <p>{{ $step->getMajorityBit() }} => @lang('a51PageTexts.toBeClocked')
                                        [{{ $step->getToBeClocked() }}]</p>
                                </div>
                                <hr>
                                <div class="d-flex flex-wrap justify-content-lg-between registers">
                                    <div class="flex-column p-2 overflow-auto">
                                        <h4>
                                            <i class="fa-solid fa-layer-group"></i> @lang('a51PageTexts.registersBeforeClock')
                                        </h4>
                                        @foreach($step->getRegistersBeforeClock() as $key => $register)
                                            <div class="register-{{ $key }} m-1">
                                                <h5>
                                                    {{ $key }}
                                                </h5>
                                                <table class="table-sm overflow-scroll">
                                                    <tr>
                                                        @foreach(str_split($register) as $char)
                                                            <td class="register-{{ $key }}-{{ $loop->index }} border-1 border">
                                                                {{ $char }}
                                                            </td>
                                                        @endforeach
                                                    </tr>
                                                </table>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="flex-column p-2 overflow-auto">
                                        <h4>
                                            <i class="fa-solid fa-layer-group"></i> @lang('a51PageTexts.registersAfterClock')
                                        </h4>
                                        @foreach($step->getRegistersAfterClock() as $key => $register)
                                            <div class="register-{{ $key }}">
                                                <h5>
                                                    {{ $key }}
                                                </h5>
                                                <table class="table-sm">
                                                    <tr>
                                                        @foreach(str_split($register) as $char)
                                                            <td class="register-{{ $key }}-{{ $loop->index }} border-1 border">
                                                                {{ $char }}
                                                            </td>
                                                        @endforeach
                                                    </tr>
                                                </table>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h5>
                                            <i class="fa-solid fa-gears"></i> KB
                                            - @lang('a51PageTexts.keystreamBit') (R1[18] ⊕ R2[21] ⊕ R3[22])
                                        </h5>
                                        <p>{{ substr($result->getAdditionalInformation()['keyStream'], 0, $loop->index) }}
                                            <b>{{ $step->getKeystreamBit() }}</b></p>
                                    </div>
                                    <div class="col-lg-6">
                                        <h5>
                                            <i class="fa-solid fa-keyboard"></i> IB
                                            - @lang('a51PageTexts.inputBit')
                                        </h5>
                                        <p>
                                            {{ substr($result->getInputValue(), 0, $loop->index) }}
                                            <b>{{ $result->getInputValue()[$loop->index] }}</b>
                                        </p>
                                    </div>
                                    <div class="col-lg-6">
                                        <h5>
                                            <i class="fa-solid fa-circle-down"></i> @lang('a51PageTexts.outputBit')
                                            (KB ⊕ IB)
                                        </h5>
                                        <p>
                                            {{ substr($result->getAdditionalInformation()['keyStream'], 0, $loop->index) }}
                                            <b>{{ $step->getKeystreamBit() }}</b>
                                            ⊕ {{ substr($result->getOutputValue(), 0, $loop->index) }}
                                            <b>{{ $result->getInputValue()[$loop->index] }}</b>
                                            => {{ substr($result->getOutputValue(), 0, $loop->index) }}
                                            <b>{{ $result->getOutputValue()[$loop->index] }}</b>
                                        </p>
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
