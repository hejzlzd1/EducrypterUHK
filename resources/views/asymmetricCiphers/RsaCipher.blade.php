@extends("components/pageTemplate")
@section("title",__('rsaPageTexts.title'))
@section("comment",__('rsaPageTexts.metaComment'))
@section("content")


    <div class="anchor" id="info"></div>

    <section class="m-5">
        <div class="shadow-lg border rounded-4 p-5">
            <div>
                <div class="container ">
                    <div class="row align-items-start">
                        <h1><i class="fa-solid fa-circle-info"></i> @lang('menuTexts.rsaCipher')</h1>
                        <hr/>
                        <div class="col-lg-8">
                            <p>@lang('rsaPageTexts.annotation')</p>
                        </div>

                        <div class="col-lg-4 m-auto">
                            <a href="img/rsaPage/rsaCipher.png" target="_blank"> <img width="100%"
                                                                                            src="{{asset("img/rsaPage/rsaPageCipher.png")}}"
                                                                                            class="rounded-4"></a>
                            <figure class="text-center">@lang("rsaPageTexts.schema")</figure>
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
                            </fieldset>
                            <fieldset class="row p-2">
                                <div class="col-lg-6">
                                    <label class="form-label" for="primeNumber1">1. @lang('baseTexts.primeNumber')</label>
                                    <input class="form-control" min="1" type="number" id="primeNumber1" name="primeNumber1"
                                           @if(isset($data["primeNumber1"]))value="{{$data["primeNumber1"]}}"@endif>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="primeNumber2">2. @lang('baseTexts.primeNumber')</label>
                                    <input class="form-control" min="1" type="number" id="primeNumber2" name="primeNumber2"
                                           @if(isset($data["primeNumber2"]))value="{{$data["primeNumber2"]}}" @endif>
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
        </div>
    </section>

    @if(isset($data))
        <section class="m-5 shadow-lg border rounded-4 p-5">
            <div class="container text-break">

                    <h1 class=""><i class="fa-solid fa-comment"></i> @lang('baseTexts.cipherResult')</h1>
                    <hr/>
                    <div class="row align-items-start">
                        <div class="col-lg-5">
                            <h4>@lang('baseTexts.insertedText')</h4>
                            <p>{{$data["text"]}}</p>
                        </div>
                    </div>
                    <div class="row align-items-start">
                        <div class="col-lg-5">
                            <h4>1. @lang('baseTexts.primeNumber')</h4>
                            <p></p>
                        </div>
                        <div class="col-lg-5">
                            <h4>2. @lang('baseTexts.primeNumber')</h4>
                            <p></p>
                        </div>
                    </div>
                    <div class="row align-items-start">
                        <div class="col">
                            @if(isset($data["finalText"]))
                                <h4>@lang('baseTexts.outputText')</h4>
                                <p>{{$data["finalText"]}}</p>
                            @endif
                        </div>
                    </div>

                    <hr/>

                    <div class="mt-4">
                        <h1><i class="fa-solid fa-list-ol"></i> @lang('baseTexts.algorithmSteps')</h1>

                    </div>
            </div>
        </section>
    @endif

    @include("components/footer")
@endsection
