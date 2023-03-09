@extends("components/pageTemplate")
@section("title",__('aesPageTexts.title'))
@section("comment",__('aesPageTexts.metaComment'))
@section("content")


    <div class="anchor" id="info"></div>

    <section class="m-5">
        <div class="shadow-lg border rounded-4 p-5">
        <div>
            <div class="container ">
                <div class="row align-items-start">
                    <h1>AES (Advanced Encryption Standard)</h1>
                    <hr/>
                    <div class="col-lg-8">
                        <p>@lang('aesPageTexts.annotation')</p>
                    </div>

                    <div class="col-lg-4 m-auto">
                        <a href="img/blowfishPage/blowfish.png" target="_blank"> <img width="100%"
                                                                                        src="{{asset("img/aesPage/aesSchema.png")}}"
                                                                                        class="rounded-4"></a>
                        <figure class="text-center">@lang("aesPageTexts.blockSchema")</figure>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="container">
                <div class="row align-items-start">
                    <h1 class="">@lang('baseTexts.cipherForm')</h1>
                    <p class="text-black-50">@lang('baseTexts.formInfoDescription')</p>
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
                                       placeholder="@lang('baseTexts.insertKey')" pattern="^[a-zA-Z ]*$"
                                       title="@lang("baseTexts.textInputOnly")"
                                       @if(isset($data["key"]))value="{{$data["key"]}}" @else value="" @endif>
                            </div>
                        </fieldset>
                        <div class="d-flex">
                            <fieldset class="col-lg-6">
                                <legend>@lang("baseTexts.keyBits")</legend>
                                <br/>
                                <div class="form-check form-switch">
                                    <label class="form-check-label" for="128bit">128bit</label>
                                    <input class="form-check-input" required type="radio"
                                           id="128bit" name="bits"
                                           value="128">
                                </div>
                                <div class="form-check form-switch">
                                    <label class="form-check-label" for="192bit">192bit</label>
                                    <input class="form-check-input" required type="radio"
                                           id="192bit" name="bits"
                                           value="192">
                                </div>
                                <div class="form-check form-switch">
                                    <label class="form-check-label" for="256bit">256bit</label>
                                    <input class="form-check-input" required type="radio"
                                           id="256bit" name="bits"
                                           value="256">
                                </div>
                            </fieldset>
                            <fieldset class="col-lg-6 px-2">
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
        </div>
    </section>

    @if(isset($data))
        <section class="m-5 shadow-lg border rounded-4 p-5">
            <div class="container text-break">

                <h1 class="text-center">@lang('baseTexts.cipherResult')</h1>
                <hr/>
                <div class="row align-items-start">
                    <div class="col-lg-5">
                        <h4>@lang('baseTexts.insertedText')</h4>
                        <p>{{$data["text"]}}</p>
                    </div>
                    <div class="col-lg-5">
                        <h4>@lang('baseTexts.key')</h4>
                        <p>{{$data["key"]}} ({{$data["bits"]}}bit)</p>
                    </div>
                </div>
                <div class="row align-items-start">
                    <div class="col-lg-5">
                        <h4 title="@lang("baseTexts.initVectorDescription")">@lang('baseTexts.initVector')</h4>
                        <p>{{$data["iv"]}}</p>
                    </div>
                    <div class="col-lg-5">
                        <h4>@lang('baseTexts.outputText')</h4>
                        <p>{{$data["finalText"]}}</p>
                    </div>
                </div>

                <hr/>

                <div class="mt-4">
                    <h1>@lang('baseTexts.algorithmSteps')</h1>

                </div>
            </div>
        </section>
    @endif

    @include("components/footer")
@endsection
