@extends("components/pageTemplate")
@section("title",__('vigenerePageTexts.title'))
@section("comment",__('vigenerePageTexts.metaComment'))
@section("content")

    <div class="anchor" id="info"></div>

    <section class="m-5">
        <div class="p-5 shadow-lg border rounded-4">
            <div class="">
                <div class="container">
                    <div class="row align-items-start">
                        <h1><i class="fa-solid fa-circle-info"></i> @lang('menuTexts.vigenereCipher')</h1>
                        <hr/>
                        <div class="col-lg-8">
                            <p>@lang('vigenerePageTexts.annotation')</p>
                        </div>

                        <div class="col-lg-4 m-auto">
                            <a href="img/vigenerePage/vigenere.svg" target="_blank"> <img width="100%"
                                                                                          src="{{asset("img/vigenerePage/vigenere.svg")}}"
                                                                                          class="rounded-4"></a>
                            <figure class="text-center">@lang("vigenerePageTexts.table")</figure>
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
                                           id="text"
                                           name="text"
                                           placeholder="@lang('baseTexts.inputText')"
                                           @if(isset($data["text"]))value="{{$data["text"]}}"@endif>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="key">@lang('baseTexts.key')</label>
                                    <input class="form-control" maxlength="30"
                                           required type="text" id="key" name="key"
                                           placeholder="@lang('baseTexts.insertKey')" pattern="^[a-zA-Z]*$"
                                           title="@lang("baseTexts.textInputOnly")"
                                           @if(isset($data["key"]))value="{{$data["key"]}}" @else value="" @endif>
                                </div>
                            </fieldset>
                            <div class="p-2">
                                <fieldset>
                                    <label>@lang("baseTexts.action")</label>
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

    @if(isset($data))
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
                        @if(strlen($data["key"]) != strlen($result->getKey()))
                            <div class="col-lg-5">
                                <h4><i class="fa-solid fa-key"></i> @lang('baseTexts.formatedKey') </h4>
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
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{$i}}" aria-expanded="true"
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
    @endif
@endsection
