@php use App\Algorithms\Output\BasicOutput; @endphp
@php /** @var BasicOutput $result */ @endphp
<section id="renderedResult" class="m-5">
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
                @if(strlen($data["key"]) != strlen($result->getKey()))
                    <div class="col-lg-5">
                        <h4>
                            <i class="fa-solid fa-key"></i> @lang('baseTexts.formattedKey')
                        </h4>
                        <p>{{$result->getKey()}}</p>
                        <p class="text-black-50">@lang("baseTexts.keyFormatted")</p>
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
                @for($i = 0 ; $i < strlen($result->getInputValue()); $i++)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{$i+1}}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse{{$i}}" aria-expanded="false"
                                    aria-controls="collapse{{$i}}">
                                @lang('baseTexts.stepNum') {{$i+1}}
                            </button>
                        </h2>
                        <div id="collapse{{$i}}" class="accordion-collapse collapse"
                             aria-labelledby="heading{{$i}}" data-bs-parent="#accordion{{$i}}">
                            <div class="accordion-body">
                                <h5 class="text-black-50">
                                    {{ucfirst(trans('baseTexts.column'))}}
                                    <b>{{$result->getInputValue()[$i]}}</b>, @lang("baseTexts.row")
                                    <b>{{$result->getKey()[$i]}}</b> => <b>{{$result->getOutputValue()[$i]}}</b>
                                </h5>
                                <div>@lang('baseTexts.actualResult') {{substr($result->getOutputValue(),0,$i)}}
                                    <b>{{$result->getOutputValue()[$i]}}</b></div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>
</section>

