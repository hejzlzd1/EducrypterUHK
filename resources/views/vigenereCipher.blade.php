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
                                <input class="form-control" maxlength="40" minlength="1" required type="text" id="text" name="text"
                                       placeholder="@lang('baseTexts.inputText')" @if(isset($data["text"]))value="{{$data["text"]}}"@endif>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label" for="key">@lang('baseTexts.key')</label>
                                <input class="form-control" maxlength="30" type="text" id="key" name="key" placeholder="@lang('baseTexts.insertKey')" @if(isset($data["key"]))value="{{$data["key"]}}"@else value="" @endif>
                            </div>
                        </fieldset>
                        <div>
                            <fieldset>
                                <legend>@lang("baseTexts.action")</legend>
                                <br/>
                                <div class="form-check form-switch">
                                    <label class="form-check-label" for="encrypt">@lang('baseTexts.encrypt')</label>
                                    <input class="form-check-input" onclick="flipShiftInput()" required type="radio" id="encrypt" name="action"
                                           value="encrypt">
                                </div>
                                <div class="form-check form-switch">
                                    <label class="form-check-label" for="decrypt">@lang('baseTexts.decrypt')</label>
                                    <input class="form-check-input" onclick="flipShiftInput()" required type="radio" id="decrypt" name="action"
                                           value="decrypt">
                                </div>
                                <div class="form-check form-switch">
                                   <!--
                                   <label class="form-check-label"
                                           for="bruteforce">@lang('baseTexts.bruteforce')</label>
                                    <input class="form-check-input" onclick="flipShiftInput()" required type="radio" id="bruteforce" name="action"
                                           value="bruteforce">
                                    -->
                                </div>
                                <script>
                                    function flipShiftInput(){
                                        if(document.getElementById("bruteforce").checked === true){
                                            document.getElementById("key").disabled = true;
                                            document.getElementById("key").value = "";
                                        }else{
                                            document.getElementById("key").disabled = false;
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
    </section>

    @if(isset($data))
        <section class="m-5">
            <div class="container text-break shadow-lg border rounded-4 p-5">
                @if($data["action"] != "bruteforce")
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
                        <div class="col">
                            @if(isset($data["finalText"]))
                                <h4>@lang('baseTexts.outputText')</h4>
                                <p>{{$data["finalText"]}}</p>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </section>
    @endif
@endsection
