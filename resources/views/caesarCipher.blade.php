@extends("components/pageTemplate")
@section("title",__('caesarPageTexts.title'))
@section("comment",__('caesarPageTexts.metaComment'))
@section("content")
    @include("components/menu")

    <div class="anchor" id="info"></div>

    <section class="m-5">
        <div>
            <div class="container shadow-lg border rounded-4 p-5">
                <div class="row align-items-start">
                    <h1>@lang('menuTexts.caesarCipher')</h1>
                    <hr/>
                    <div class="col-lg-8">
                        <p>@lang('caesarPageTexts.annotation')</p>
                    </div>

                    <div class="col-lg-4 m-auto">
                        <a href="img/caesarPage/caesarCipher.png" target="_blank"> <img width="100%"
                                                                                        src="{{asset("img/caesarPage/caesarCipher.png")}}"
                                                                                        class="rounded-4"></a>
                        <figure class="text-center">@lang("caesarPageTexts.alphabetShift")</figure>
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
                                <input class="form-control" type="text" id="text" name="text"
                                       placeholder="@lang('baseTexts.inputText')">
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label" for="shift">@lang('baseTexts.shift')</label>
                                <input class="form-control" type="number" id="shift" name="shift" value=0>
                            </div>
                        </fieldset>
                        <div>
                            <fieldset>
                                <legend>@lang("baseTexts.action")</legend>
                                <br/>
                                <div class="form-check form-switch">
                                    <label class="form-check-label" for="encrypt">@lang('baseTexts.encrypt')</label>
                                    <input class="form-check-input" type="radio" id="encrypt" name="action"
                                           value="encrypt">
                                </div>
                                <div class="form-check form-switch">
                                    <label class="form-check-label" for="decrypt">@lang('baseTexts.decrypt')</label>
                                    <input class="form-check-input" type="radio" id="decrypt" name="action"
                                           value="decrypt">
                                </div>
                                <div class="form-check form-switch">
                                    <label class="form-check-label"
                                           for="bruteforce">@lang('baseTexts.bruteforce')</label>
                                    <input class="form-check-input" type="radio" id="bruteforce" name="action"
                                           value="bruteforce">
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
            <div class="container shadow-lg border rounded-4 p-5">
                <h1 class="text-center">@lang('baseTexts.cipherResult')</h1>
                <hr/>
                <div class="row">
                    <div class="col-lg-6">
                        <h4>@lang('baseTexts.insertedText')</h4>
                        <p>{{$data["text"]}}</p>
                    </div>
                    <div class="col-lg-6">
                        <h4>@lang('baseTexts.shift')</h4>
                        <p>{{$data["shift"]}}</p>
                    </div>
                </div>

                @if(isset($data["finalText"]))
                    <h4>@lang('baseTexts.outputText')</h4>
                    <p>{{$data["finalText"]}}</p>
                @endif

                //steps
                <div>
                    <h1>Tabulka abecedy</h1>
                    <table class="table">
                        <tr>
                            Původní
                            @foreach(range('A','Z') as $char)
                                <td class="">{{$char}}</td>
                            @endforeach
                            @for($i = 0; $i <=26; $i++)

                            @endfor
                        </tr>
                    </table>
                </div>
            </div>
        </section>
    @endif

    @include("components/footer")
@endsection
