@extends("components/pageTemplate")
@section("title",__('caesarPageTexts.title'))
@section("comment",__('caesarPageTexts.metaComment'))
@section("content")


    <div class="anchor" id="info"></div>

    <section class="m-5">
        <div class="shadow-lg border rounded-4 p-5">
            <div>
                <div class="container ">
                    <div class="row align-items-start">
                        <h1><i class="fa-solid fa-circle-info"></i> @lang('menuTexts.caesarCipher')</h1>
                        <hr/>
                        <div class="col-lg-8">
                            <p>@lang('caesarPageTexts.annotation')</p>
                        </div>

                        <div class="col-lg-4 m-auto">
                            <a href="{{asset('img/caesarPage/caesarCipher.png')}}" target="_blank"> <img width="100%"
                                                                                                         src="{{asset("img/caesarPage/caesarCipher.png")}}"
                                                                                                         class="rounded-4"></a>
                            <figure class="text-center">@lang("caesarPageTexts.alphabetShift")</figure>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pt-2">
                <div class="container">
                    <div class="row align-items-start">
                        <h1 class=""><i class="fa-regular fa-file-lines"></i> @lang('baseTexts.cipherForm')</h1>
                        <p class="text-black-50">@lang('baseTexts.formInfoDescription')</p>
                        <hr/>
                        <form action="" method="post">
                            @csrf
                            <fieldset class="row p-2">
                                <div class="col-lg-6">
                                    <label class="form-label" for="text">@lang('baseTexts.text')</label>
                                    <input class="form-control" maxlength="40" minlength="1" required type="text"
                                           id="text" name="text"
                                           placeholder="@lang('baseTexts.inputText')"
                                           @if(isset($data["text"]))value="{{$data["text"]}}"@endif>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="shift">@lang('baseTexts.shift') - max 26</label>
                                    <input class="form-control" min="0" max="26" type="number" id="shift" name="shift"
                                           @if(isset($data["shift"]))value="{{$data["shift"]}}" @else value="0" @endif>
                                </div>
                            </fieldset>
                            <div class="p-2">
                                <fieldset>
                                    <label>@lang("baseTexts.action")</label>
                                    <br/>
                                    <div class="form-check form-switch">
                                        <label class="form-check-label" for="encrypt">@lang('baseTexts.encrypt')</label>
                                        <input class="form-check-input" onclick="flipShiftInput()" required type="radio"
                                               id="encrypt" name="action"
                                               value={{\App\Algorithms\CipherBase::ALGORITHM_ENCRYPT}}>
                                    </div>
                                    <div class="form-check form-switch">
                                        <label class="form-check-label" for="decrypt">@lang('baseTexts.decrypt')</label>
                                        <input class="form-check-input" onclick="flipShiftInput()" required type="radio"
                                               id="decrypt" name="action"
                                               value={{\App\Algorithms\CipherBase::ALGORITHM_DECRYPT}}>
                                    </div>
                                    <div class="form-check form-switch">
                                        <label class="form-check-label"
                                               for="bruteforce">@lang('baseTexts.bruteforce')</label>
                                        <input class="form-check-input" onclick="flipShiftInput()" required type="radio"
                                               id="bruteforce" name="action"
                                               value={{\App\Algorithms\CipherBase::ALGORITHM_DECRYPT_BRUTEFORCE}}>
                                    </div>
                                    <script>
                                        function flipShiftInput() {
                                            if (document.getElementById("bruteforce").checked === true) {
                                                document.getElementById("shift").disabled = true;
                                                document.getElementById("shift").value = 0;
                                            } else {
                                                document.getElementById("shift").disabled = false;
                                            }
                                        }
                                    </script>
                                </fieldset>
                            </div>
                            <div class="m-auto text-center">
                                <input type="submit" class="btn btn-primary form-control w-auto"
                                       value="@lang('baseTexts.submit')">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if(isset($result))
        <section class="m-5 shadow-lg border rounded-4 p-5">
            <div class="container text-break">
                @if((int)$data['action'] !== \App\Algorithms\CipherBase::ALGORITHM_DECRYPT_BRUTEFORCE)
                    <h1 class=""><i class="fa-solid fa-comment"></i> @lang('baseTexts.cipherResult')</h1>
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
                            <h4><i class="fa-solid fa-circle-down"></i> @lang('baseTexts.outputText')</h4>
                            <p>{{$result->getOutputValue()}}</p>
                        </div>
                    </div>

                    <hr/>

                    <div class="mt-4">
                        <h1>@lang('caesarPageTexts.alphabetTable')</h1>
                        <div class="table-responsive-lg">
                            <table class="table table-bordered">
                                <tr>
                                    @if($result->getOperation() === \App\Algorithms\CipherBase::ALGORITHM_ENCRYPT)
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
                                    @if($result->getOperation() === \App\Algorithms\CipherBase::ALGORITHM_ENCRYPT)
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
    @endif

    @include("components/footer")
@endsection
