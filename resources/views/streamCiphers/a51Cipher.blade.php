@extends("components/pageTemplate")
@section("title",__('a51PageTexts.title'))
@section("comment",__('a51PageTexts.metaComment'))
@section("content")


    <div class="anchor" id="info"></div>

    <section class="m-5">
        <div class="shadow-lg border rounded-4 p-5">
            <div>
                <div class="container ">
                    <div class="row align-items-start">
                        <h1><i class="fa-solid fa-circle-info"></i> A5/1</h1>
                        <hr/>
                        <div class="col-lg-8">
                            <p>@lang('a51PageTexts.annotation')</p>
                        </div>

                        <div class="col-lg-4 m-auto">
                            <a href="{{asset('img/a51Page/caesarCipher.png')}}" target="_blank"> <img width="100%"
                                                                                                      src="{{asset("img/a51Page/a51Cipher.png")}}"
                                                                                                      class="rounded-4"></a>
                            <figure class="text-center">@lang("a51PageTexts.imageDescription")</figure>
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
                                    <label class="form-label" for="text">@lang('baseTexts.binaryInput')</label>
                                    <input class="form-control binaryValidation" maxlength="114" minlength="1" required
                                           type="text"
                                           id="text" name="text"
                                           placeholder="@lang('baseTexts.binaryInputPrompt')"
                                           @if(isset($data['text']))value="{{$data['text']}}"@endif>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="key">@lang('baseTexts.key')</label>
                                    <input class="form-control binaryValidation" min="1" max="64" type="text" id="key"
                                           name="key" placeholder="@lang('baseTexts.insertKey')" required
                                           @if(isset($data['key']))value="{{$data['key']}}" @else value="" @endif>
                                </div>
                            </fieldset>
                            <fieldset class="row p-2">
                                <div class="col-lg-6">
                                    <label class="form-label" for="key">@lang('baseTexts.dataFrame')</label>
                                    <input class="form-control" type="number" max="4194304" min="0" id="dataFrame"
                                           name="dataFrame" placeholder="@lang('a51Texts.inputDataFrame')" required
                                           @if(isset($data['dataFrame']))value="{{$data['dataFrame']}}"
                                           @else value="" @endif>
                                </div>
                            </fieldset>
                            <div class="p-2">
                                <fieldset>
                                    <label>@lang('baseTexts.action')</label>
                                    <br/>
                                    <div class="form-check form-switch">
                                        <label class="form-check-label" for="encrypt">@lang('baseTexts.encrypt')</label>
                                        <input class="form-check-input" required type="radio"
                                               id="encrypt" name="action"
                                               value={{\App\Algorithms\CipherBase::ALGORITHM_ENCRYPT}}>
                                    </div>
                                    <div class="form-check form-switch">
                                        <label class="form-check-label" for="decrypt">@lang('baseTexts.decrypt')</label>
                                        <input class="form-check-input" required type="radio"
                                               id="decrypt" name="action"
                                               value={{\App\Algorithms\CipherBase::ALGORITHM_DECRYPT}}>
                                    </div>
                                </fieldset>
                            </div>
                            @include('components.submitButton')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if(isset($result))
        <section class="m-5 shadow-lg border rounded-4 p-5">
            <div class="container text-break">

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
                        <h4><i class="fa-solid fa-key"></i> @lang('baseTexts.key')</h4>
                        <p>{{$result->getKey()}}</p>
                    </div>
                    <div class="col-lg-5">
                        <h4><i class="fa-solid fa-key"></i> @lang('baseTexts.dataFrame')</h4>
                        <p>{{$result->getAdditionalInformation()['dataFrame']}}</p>
                    </div>
                    <div class="col-lg-5">
                        <h4><i class="fa-solid fa-0"></i><i
                                class="fa-solid fa-1"></i> @lang('baseTexts.dataFrameBinary')</h4>
                        <p>{{$result->getAdditionalInformation()['dataFrameBinary']}}</p>
                    </div>
                </div>
                <div class="row align-items-start">
                    <div class="col">
                        <h4>
                            <i class="fa-solid fa-key"></i>
                            @lang('A51PageTexts.keyStream')
                        </h4>
                        <p>{{$result->getAdditionalInformation()['keyStream']}}</p>
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
                    <h1><i class="fa-solid fa-list-ol"></i> @lang('baseTexts.algorithmSteps')</h1>
                    <div class="accordion" id="accordion">
                        @foreach($result->getSteps() as $step)
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#step{{$loop->index}}" aria-expanded="true"
                                            aria-controls="step{{$loop->index}}">
                                        @lang('baseTexts.step') #{{$loop->index}}
                                    </button>
                                </h2>
                                <div id="step{{$loop->index}}"
                                     class="accordion-collapse collapse @if($loop->first) show @endif">
                                    <div class="accordion-body">
                                        <div class="initialRegisters">
                                            <h4>
                                                @lang('A51PageTexts.registersBeforeClock')
                                            </h4>
                                            @foreach($result->getSteps()[$loop->index]->getRegistersBeforeClock() as $key => $register)
                                                <h5>
                                                    {{$key}}
                                                </h5>
                                                <table class="table-sm">
                                                    <tr>
                                                        @foreach(str_split($register) as $char)
                                                            <td class="register-{{$key}}-{{$loop->index}}">
                                                                {{$char}}
                                                            </td>
                                                        @endforeach
                                                    </tr>
                                                </table>
                                            @endforeach
                                            <hr>

                                            <h4>
                                                @lang('A51PageTexts.registersAfterClock')
                                            </h4>
                                            @foreach($result->getSteps()[$loop->index]->getRegistersAfterClock() as $key => $register)
                                                <h5>
                                                    {{$key}}
                                                </h5>
                                                <table class="table-sm">
                                                    <tr>
                                                        @foreach(str_split($register) as $char)
                                                            <td class="register-{{$key}}-{{$loop->index}}">
                                                                {{$char}}
                                                            </td>
                                                        @endforeach
                                                    </tr>
                                                </table>
                                            @endforeach
                                            <hr>

                                            TODO add all remaining variables with labels
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    @include("components/footer")
@endsection
