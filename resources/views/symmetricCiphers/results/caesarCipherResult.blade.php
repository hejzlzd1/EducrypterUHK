@php
    use App\Algorithms\CipherBase;
    use App\Algorithms\Output\BasicOutput;
@endphp
@php /** @var BasicOutput $result */ @endphp
<section class="m-5 shadow-lg border rounded-4 p-5">
    <div class="container text-break">
        @if((int)$data['action'] !== CipherBase::ALGORITHM_DECRYPT_BRUTEFORCE)
            <h1 class="">
                <i class="fa-solid fa-comment"></i> @lang('baseTexts.cipherResult')
            </h1>
            <hr/>
            <div class="row align-items-start">
                <div class="col-lg-5">
                    <h4><i class="fa-solid fa-keyboard"></i> @lang('baseTexts.insertedText')</h4>
                    <p>{{$result->getInputValue()}}</p>
                </div>
                <div class="col-lg-5">
                    <h4><i class="fa-solid fa-rotate"></i> @lang('baseTexts.shift')</h4>
                    <p>{{$result->getKey()}}</p>
                </div>
            </div>
            <div class="row align-items-start">
                <div class="col">
                    <h4>
                        <i class="fa-solid fa-circle-down"></i>
                        @lang('baseTexts.outputText')
                        <x-copyButton :textToCopy="$result->getOutputValue()"></x-copyButton>
                    </h4>
                    <p>{{$result->getOutputValue()}}</p>
                </div>
            </div>

            <hr/>

            <div class="mt-4">
                <h1>@lang('caesarPageTexts.alphabetTable')</h1>
                <div class="table-responsive-lg">
                    <table class="table table-bordered">
                        <tr>
                            @if($result->getOperation() === CipherBase::ALGORITHM_ENCRYPT)
                                @foreach(range('A','Z') as $char)
                                    <td class="">{{$char}}</td>
                                @endforeach
                            @else
                                @foreach($result->getAdditionalInformation()['shiftedAlphabet'] as $char)
                                    <td class=""><b>{{$char}}</b></td>
                                @endforeach
                            @endif
                        </tr>
                        <tr>
                            @foreach(range('A','Z') as $char)
                                <td class=""><i class="fa-solid fa-arrow-down-long"></i></td>
                            @endforeach
                        </tr>
                        <tr>
                            @if($result->getOperation() === CipherBase::ALGORITHM_ENCRYPT)
                                @foreach($result->getAdditionalInformation()['shiftedAlphabet'] as $char)
                                    <td class=""><b>{{$char}}</b></td>
                                @endforeach
                            @else
                                @foreach(range('A','Z') as $char)
                                    <td class="">{{$char}}</td>
                                @endforeach
                            @endif
                        </tr>
                    </table>
                </div>
            </div>

            <hr/>

            <div class="mt-4">
                <h1><i class="fa-solid fa-list-ol"></i> @lang('baseTexts.algorithmSteps')</h1>
                <div class="accordion" id="accordion">
                    @for($i = 0 ; $i < strlen($result->getInputValue()); $i++)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{$i+1}}">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse{{$i}}" aria-expanded="true"
                                        aria-controls="collapse{{$i}}">
                                    @lang('baseTexts.stepNum') {{$i+1}}
                                </button>
                            </h2>
                            <div id="collapse{{$i}}" class="accordion-collapse collapse"
                                 aria-labelledby="heading{{$i}}" data-bs-parent="#accordion{{$i}}">
                                <div class="accordion-body">
                                    <h5 class="text-black-50 ">@lang('baseTexts.substitution') {{$result->getInputValue()[$i]}}
                                        => {{$result->getOutputValue()[$i]}} <br/></h5>
                                    <div>
                                        @lang('baseTexts.actualResult')
                                        {{substr($result->getOutputValue(),0,$i)}}
                                        <b>{{$result->getOutputValue()[$i]}}</b>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
                @else
                    <h1 class="text-center"><i
                            class="fa-solid fa-comment"></i> @lang('baseTexts.bruteForceResult')</h1>
                    <div class="d-flex p-4 flex-wrap gap-4 border border-2">
                        @foreach($result as $data)
                            <div><b>{{$loop->index}}.</b> {{$data->getOutputValue()}}</div>
                        @endforeach
                    </div>
                @endif
            </div>
    </div>
</section>
