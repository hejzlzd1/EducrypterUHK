@extends("components/pageTemplate")
@section("title",__('vigenerePageTexts.title'))
@section("comment",__('vigenerePageTexts.metaComment'))
@section("content")

    <div class="anchor" id="info"></div>

    <section class="m-5">
        <div>
            <div class="container shadow-lg border rounded-4 p-5">
                <div class="row align-items-start">
                    <h1>@lang('menuTexts.vigenereCipher')</h1>
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
    </section>


    <section class="m-5">
        <div>
            <div class="container shadow-lg border rounded-4 p-5">
                <div class="row align-items-start">
                    <h1 class="text-center">@lang('baseTexts.cipherForm')</h1>
                    <hr/>
                    <form action="" method="post">
                        @csrf
                        <fieldset class="row">
                            <div class="col-lg-6">
                                <label class="form-label" for="text">@lang('baseTexts.text')</label>
                                <input class="form-control" maxlength="40" minlength="1" required type="text" id="text"
                                       name="text"
                                       placeholder="@lang('baseTexts.inputText')"
                                       @if(isset($data["text"]))value="{{$data["text"]}}"@endif>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label" for="key">@lang('baseTexts.key')</label>
                                <input class="form-control" maxlength="30" type="text" id="key" name="key"
                                       placeholder="@lang('baseTexts.insertKey')" pattern="^[a-zA-Z ]*$" title="@lang("baseTexts.textInputOnly")"
                                       @if(isset($data["key"]))value="{{$data["key"]}}" @else value="" @endif>
                            </div>
                        </fieldset>
                        <div>
                            <fieldset>
                                <legend>@lang("baseTexts.action")</legend>
                                <br/>
                                <div class="form-check form-switch">
                                    <label class="form-check-label" for="encrypt">@lang('baseTexts.encrypt')</label>
                                    <input class="form-check-input" required type="radio"
                                           id="encrypt" name="action"
                                           value="encrypt">
                                </div>
                                <div class="form-check form-switch">
                                    <label class="form-check-label" for="decrypt">@lang('baseTexts.decrypt')</label>
                                    <input class="form-check-input" required type="radio"
                                           id="decrypt" name="action"
                                           value="decrypt">
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
    </section>

    @if(isset($data))
        <section class="m-5">
            <div class="container text-break shadow-lg border rounded-4 p-5">
                <h1 class="text-center">@lang('baseTexts.cipherResult')</h1>
                <hr/>
                <div class="row align-items-start">
                    <div class="col-lg-5">
                        <h4>@lang('baseTexts.insertedText')</h4>
                        <p>{{$data["text"]}}</p>
                    </div>
                    <div class="col-lg-5">
                        <h4>@lang('baseTexts.key')</h4>
                        <p>{{$data["key"]}}</p>
                    </div>
                </div>
                <div class="row align-items-start">
                    <div class="col-lg-5">
                        <h4>@lang('baseTexts.formatedKey')</h4>
                        <p>{{$data["formatedKey"]}}</p>
                    </div>
                    <div class="col-lg-5">
                        <h4>@lang('baseTexts.outputText')</h4>
                        <p>{{$data["finalText"]}}</p>
                    </div>
                </div>
                <hr/>
                <div class="row align-items-start">
                    <div class="col">
                        <h4>@lang("vigenerePageTexts.table")</h4>
                        <a href="img/vigenerePage/vigenere.svg" target="_blank"> <img width="40%"
                                                                                      src="{{asset("img/vigenerePage/vigenere.svg")}}"
                                                                                      class="rounded-4"></a>
                    </div>
                </div>
                <hr/>
                <div class="mt-4">
                    <h1>@lang('baseTexts.algorithmSteps')</h1>
                    <div id="carouselVigenereSteps" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @for($i = 0 ; $i < strlen($data["text"]); $i++)
                                <div class="carousel-item @if($i == 0) active @endif">
                                    <div>
                                        <h4 class="text-decoration-underline">@lang('baseTexts.stepNum') {{$i+1}}</h4>
                                        <h5 class="text-black-50">
                                            {{ucfirst(trans('baseTexts.column'))}}
                                            <b>{{$data["text"][$i]}}</b>, @lang("baseTexts.row")
                                            <b>{{$data["formatedKey"][$i]}}</b> => <b>{{$data["finalText"][$i]}}</b>
                                        </h5>
                                        <div>@lang('baseTexts.actualResult') {{substr($data["finalText"],0,$i)}}<b>{{$data["finalText"][$i]}}</b></div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                        <div class="carousel-indicators mt-3 row">
                            <button type="button" data-bs-target="#carouselVigenereSteps" data-bs-slide-to="0"
                                    class="active bg-black" aria-current="true"></button>
                            @for($i = 1 ; $i < strlen($data["text"]); $i++)
                                <button type="button" class="bg-black" data-bs-target="#carouselVigenereSteps"
                                        data-bs-slide-to="{{$i}}"></button>
                            @endfor
                        </div>
                        <div class="row justify-content-center">
                            <button class="carousel-control-prev" style="position: relative" type="button"
                                    data-bs-target="#carouselVigenereSteps" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" style="position: relative" type="button"
                                    data-bs-target="#carouselVigenereSteps" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
