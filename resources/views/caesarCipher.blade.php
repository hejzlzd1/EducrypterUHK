@extends("components/pageTemplate")
@section("title",__('caesarPageTexts.title'))
@section("comment",__('caesarPageTexts.metaComment'))
@section("content")


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
                                <input class="form-control" maxlength="40" minlength="1" required type="text" id="text" name="text"
                                       placeholder="@lang('baseTexts.inputText')" @if(isset($data["text"]))value="{{$data["text"]}}"@endif>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label" for="shift">@lang('baseTexts.shift')</label>
                                <input class="form-control" min="0" max="26" type="number" id="shift" name="shift" @if(isset($data["shift"]))value="{{$data["shift"]}}"@else value="0" @endif>
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
                                    <label class="form-check-label"
                                           for="bruteforce">@lang('baseTexts.bruteforce')</label>
                                    <input class="form-check-input" onclick="flipShiftInput()" required type="radio" id="bruteforce" name="action"
                                           value="bruteforce">
                                </div>
                                <script>
                                    function flipShiftInput(){
                                        if(document.getElementById("bruteforce").checked === true){
                                            document.getElementById("shift").disabled = true;
                                            document.getElementById("shift").value = 0;
                                        }else{
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
                        <h4>@lang('baseTexts.shift')</h4>
                        <p>{{$data["shift"]}}</p>
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

                    <hr />

                <div class="mt-4">
                    <h1>@lang('caesarPageTexts.alphabetTable')</h1>
                    <div class="table-responsive-lg">
                    <table class="table table-bordered">
                        <tr>
                            @if($data["action"] == "encrypt")
                            @foreach(range('A','Z') as $char)
                                <td class="">{{$char}}</td>
                            @endforeach
                            @else
                                @foreach($data["shiftedAlphabet"] as $char)
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
                            @if($data["action"] == "encrypt")
                                @foreach($data["shiftedAlphabet"] as $char)
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

                <hr />

                <div class="mt-4">
                    <h1>@lang('baseTexts.algorithmSteps')</h1>
                    <div id="carouselCaesarSteps" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @for($i = 0 ; $i < strlen($data["text"]); $i++)
                                <div class="carousel-item @if($i == 0) active @endif">
                                    <div>
                                        <h4 class="text-decoration-underline">@lang('baseTexts.stepNum') {{$i+1}}</h4>
                                        <h5 class="text-black-50 ">{{$data["text"][$i]}} => {{$data["finalText"][$i]}} <br/></h5>
                                        <div>@lang('baseTexts.actualResult') {{substr($data["finalText"],0,$i)}}<b>{{$data["finalText"][$i]}}</b></div>
                                    </div>
                                </div>
                            @endfor

                        </div>
                        <div class="carousel-indicators mt-3 row">
                            <button type="button" data-bs-target="#carouselCaesarSteps" data-bs-slide-to="0"
                                    class="active bg-black" aria-current="true"></button>
                            @for($i = 1 ; $i < strlen($data["text"]); $i++)
                                <button type="button" class="bg-black" data-bs-target="#carouselCaesarSteps"
                                        data-bs-slide-to="{{$i}}"></button>
                            @endfor
                        </div>
                        <div class="row justify-content-center">
                        <button class="carousel-control-prev" style="position: relative" type="button" data-bs-target="#carouselCaesarSteps" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" style="position: relative" type="button" data-bs-target="#carouselCaesarSteps" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                        </div>
                    </div>
                </div>
                    @else
                    <h1 class="text-center">@lang('baseTexts.bruteForceResult')</h1>
                        <div class="d-flex p-4 flex-wrap gap-4 border border-2">
                        @foreach($data["bruteForceResult"] as $result)
                                <div><b>{{$loop->index+1}}.</b> {{$result}}</div>
                        @endforeach
                        </div>
                @endif
            </div>
        </section>
    @endif

    @include("components/footer")
@endsection
