@php
    use App\Algorithms\Output\BasicOutput;
    use App\Algorithms\Output\Steps\Step;
@endphp
@php /* @var BasicOutput $result */ @endphp
<section class="m-5">
    <div class="shadow-lg border rounded-4 p-5">
        <div class="container text-break">
            <h1 class=""><i class="fa-solid fa-comment"></i> @lang('baseTexts.cipherResult')</h1>
            <hr/>
            <div class="row align-items-start">
                <div class="col-lg-5">
                    <h4><i class="fa-solid fa-keyboard"></i> @lang('baseTexts.insertedText')</h4>
                    <p>{{$data["text"]}}</p>
                </div>
                <div class="col-lg-5">
                    <h4><i class="fa-solid fa-key"></i> @lang('baseTexts.key')</h4>
                    <p>{{$data["key"]}}</p>
                </div>
            </div>
            <div class="row align-items-start">
                @if(strlen($data["key"]) !== strlen($result->getKey()))
                    <div class="col-lg-5">
                        <h4><i class="fa-solid fa-key"></i> @lang('baseTexts.formattedKey') </h4>
                        <p>{{$result->getKey()}}</p>
                        <p class="text-black-50">@lang('baseTexts.keyFormatted')</p>
                    </div>
                @endif
                <div class="col-lg-5">
                    <h4>
                        <i class="fa-solid fa-circle-down"></i>
                        @lang('baseTexts.outputText')
                        <x-copyButton :textToCopy="$result->getOutputValue()"></x-copyButton>
                    </h4>
                    <p>{{$result->getOutputValue()}}</p>
                </div>
            </div>
            <hr/>

            <h1><i class="fa-solid fa-list-ol"></i> @lang('baseTexts.algorithmSteps')</h1>
            <div class="accordion" id="accordion">
                @php /** @var Step $step */ @endphp
                @foreach($result->getSteps() as $step)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{$loop->index + 1}}">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse{{$loop->index}}" aria-expanded="false"
                                    aria-controls="collapse{{$loop->index}}">
                                @lang('baseTexts.stepNum') {{$loop->index + 1}}
                                => {{ substr($result->getOutputValue(), 0, $loop->index) }}
                                <b>{{ $step->getOutput() }}</b>
                            </button>
                        </h2>
                        <div id="collapse{{$loop->index}}" class="accordion-collapse collapse"
                             aria-labelledby="heading{{$loop->index}}"
                             data-bs-parent="#accordion{{$loop->index}}">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-md-5">
                                        <h3>@lang('baseTexts.input')</h3>
                                        <p>{{ $step->getInput() }}</p>
                                    </div>
                                    <div class="col-md-5">
                                        <h3>@lang('baseTexts.key')</h3>
                                        <p> {{ substr($result->getKey(), $loop->index-1, 1) }} </p>
                                    </div>
                                    <div class="col-md-5">
                                        <h3>@lang('baseTexts.output')</h3>
                                        <p> {{ $step->getOutput() }} </p>
                                    </div>
                                    <div class="col-md-5">
                                        <h3> P ⊕ K </h3>
                                        <p> {{ $step->getInput() }} ⊕ {{ substr($result->getKey(), $loop->index-1, 1) }}
                                            = {{ $step->getOutput() }} </p>
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
