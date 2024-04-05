@php
    use App\Algorithms\CipherBase;
    use App\Algorithms\Output\DiffieHellmanOutput;
    use App\Algorithms\Output\Steps\NamedStep;
    /** @var DiffieHellmanOutput $result */
    /** @var NamedStep $step */
@endphp
<section id="renderedResult" class="m-5 shadow-lg border rounded-4 secondaryBox p-5">
    <div class="container text-break">

        <h1 class="">
            <i class="fa-solid fa-comment"></i> @lang('diffieHellmanPageTexts.keyExchange')
        </h1>
        <hr/>
        <div class="row align-items-start">
            <div class="col-lg-5">
                <h4>
                    <i class="fa-solid fa-key"></i>
                    @lang('diffieHellmanPageTexts.keyA')
                </h4>
                <p>{{ $data['keyA'] }}</p>
            </div>
            <div class="col-lg-5">
                <h4>
                    <i class="fa-solid fa-key"></i>
                    @lang('diffieHellmanPageTexts.keyB')
                </h4>
                <p>{{ $data['keyB'] }}</p>
            </div>
            <div class="col-lg-5">
                <h4>
                    <i class="fa-solid fa-eye"></i>
                    @lang('diffieHellmanPageTexts.base')
                </h4>
                <p>{{ $result->getBase() }}</p>
            </div>
            <div class="col-lg-5">
                <h4>
                    <i class="fa-solid fa-eye"></i>
                    @lang('diffieHellmanPageTexts.modulus')
                </h4>
                <p>{{ $result->getModulus() }}</p>
            </div>
        </div>

        <div class="mt-3">
            <h2>
                <i class="fa fa-calculator"></i>
                @lang('rsaPageTexts.calculatedVariables')
            </h2>
            <div class="mt-2 row align-items-start">
                <div class="col-lg-5">
                    <h4>
                        <i class="fa-solid fa-eye"></i>
                        @lang('diffieHellmanPageTexts.publicA')
                        <x-copyButton :textToCopy="$result->getA()"></x-copyButton>
                    </h4>
                    <p><b>{{ $result->getPublicA() }}</b></p>
                </div>
                <div class="col-lg-5">
                    <h4>
                        <i class="fa-solid fa-eye"></i>
                        @lang('diffieHellmanPageTexts.publicB')
                        <x-copyButton :textToCopy="$result->getPublicB()"></x-copyButton>
                    </h4>
                    <p><b>{{ $result->getPublicB() }}</b></p>
                </div>

                <div class="col-lg-5">
                    <h4>
                        <i class="fa-solid fa-lock"></i>
                        @lang('diffieHellmanPageTexts.sharedKey')
                        <x-copyButton :textToCopy="$result->getOutputValue()"></x-copyButton>
                    </h4>
                    <p>{{ $result->getOutputValue() }}</p>
                </div>
            </div>
        </div>


        <hr/>

        <div class="mt-4">
            <h1><i class="fa-solid fa-list-ol"></i> @lang('baseTexts.algorithmSteps')</h1>
            <div class="accordion" id="diffieHellmanSteps">
                @foreach($result->getSteps() as $step)
                    @php $disableAccordion = $step->getInput() === '-' && $step->getOutput() === '-'; @endphp
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed {{$disableAccordion ? 'no-bg-image' : ''}}" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#step{{ $loop->index }}" aria-expanded="false" {{ $disableAccordion ? 'disabled' : ''}}
                                    aria-controls="step{{ $loop->index }}">
                                {!! $step->getTranslatedActionName() !!}
                            </button>
                        </h2>
                        <div id="step{{ $loop->index }}" class="accordion-collapse collapse"
                             data-bs-parent="#diffieHellmanSteps">
                            <div class="accordion-body">
                                <div class="row align-items-start">
                                    <div class="col-lg-5">
                                        <h4>
                                            <i class="fa-solid fa-calculator"></i> @lang('diffieHellmanPageTexts.function')
                                        </h4>
                                        <p> {!! $step->getInput() !!} </p>
                                    </div>
                                    <div class="col-lg-5">
                                        <h4>
                                            <i class="fa-solid fa-circle-down"></i> @lang('diffieHellmanPageTexts.functionOutput')
                                        </h4>
                                        <p> {{ $step->getOutput() }} </p>
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
