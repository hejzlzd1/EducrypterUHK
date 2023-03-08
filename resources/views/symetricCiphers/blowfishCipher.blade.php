@extends("components/pageTemplate")
@section("title",__('blowfishPageTexts.title'))
@section("comment",__('blowfishPageTexts.metaComment'))
@section("content")


    <div class="anchor" id="info"></div>

    <section class="m-5">
        <div class="shadow-lg border rounded-4 p-5">
            <div>
                <div class="container">
                    <div class="row align-items-start">
                        <h1><i class="fa-solid fa-circle-info"></i> Blowfish</h1>
                        <hr/>
                        <div class="col-lg-8">
                            <p>@lang('blowfishPageTexts.annotation')</p>
                        </div>

                        <div class="col-lg-4 m-auto">
                            <a href="{{asset("img/blowfishPage/blowfish_".App::getLocale().".png")}}" target="_blank">
                                <img width="100%"
                                     src="{{asset("img/blowfishPage/blowfish_".App::getLocale().".png")}}"
                                     class="rounded-4"></a>
                            <figure class="text-center">@lang("blowfishPageTexts.blockSchema")</figure>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="container">
                    <div class="row align-items-start">
                        <h1 class=""><i class="fa-regular fa-file-lines"></i> @lang('baseTexts.cipherForm') (CBC)</h1>
                        <p class="text-black-50">@lang('baseTexts.formInfoDescription')</p>
                        <hr/>
                        <form action="" method="post">
                            @csrf
                            <fieldset class="row p-2">
                                <div class="col-lg-6">
                                    <label class="form-label" for="text">@lang('baseTexts.text')</label>
                                    <input class="form-control" minlength="1" maxlength="400" required type="text"
                                           id="text"
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
                    <div class="col-lg-5">
                        <h4>@lang('baseTexts.key')</h4>
                        <p>{{$data["key"]}}</p>
                    </div>
                </div>
                <div class="row align-items-start">
                    <div class="col-lg-5">
                        <h4>@lang('baseTexts.initVector')</h4>
                        <p>{{$data["initVector"]}}</p>
                    </div>
                    <div class="col-lg-5">
                        <h4>@lang('baseTexts.outputText')</h4>
                        <p>{{$data["finalText"]}}</p>
                    </div>
                </div>

                <hr/>
                <h1><i class="fa-solid fa-key"></i> @lang('baseTexts.subkeys'):</h1>
                <div class="d-flex flex-wrap">
                @foreach($data["subkeys"] as $subkey)
                    <div class="card col-md-2 m-2 p-1">
                        <div class="card-body">
                            <h4>{{$loop->index+1}}. </h4>
                            {{base64_encode($subkey)}}
                        </div>
                    </div>
                @endforeach
                </div>
                <hr />

                <div class="mt-4">
                    <h1><i class="fa-solid fa-list-ol"></i> @lang('baseTexts.algorithmSteps')</h1>
                    <p>@lang('baseTexts.inputSize') - {{$data["inputSize"]}}bit</p>
                    <div class="accordion" id="blockAccordion">
                        @foreach($data["steps"] as $block)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="blockHeading{{$loop->index}}">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#block{{$loop->index}}" aria-expanded="true"
                                            aria-controls="block{{$loop->index}}">
                                        @lang('baseTexts.block') {{$loop->index+1}} - @lang('baseTexts.output'): "{{$block["blockFinalString"]}}"
                                    </button>
                                </h2>
                                <div id="block{{$loop->index}}" class="accordion-collapse collapse"
                                     aria-labelledby="blockHeading{{$loop->index}}" data-bs-parent="#blockAccordion">
                                    <div class="accordion-body">
                                        <!-- nested accordion -->
                                        <div class="accordion" id="stepAccordion{{$loop->index}}">
                                        @foreach($block["blockSteps"] as $step)

                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="stepHeading{{$loop->index}}{{$loop->parent->index}}">
                                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#stepCollapse{{$loop->index}}{{$loop->parent->index}}" aria-expanded="true"
                                                                aria-controls="stepCollapse{{$loop->index}}{{$loop->parent->index}}">
                                                            @if(!$loop->last) @lang('baseTexts.round') {{$loop->index+1}} @else @lang('baseTexts.finalOperation') @endif
                                                        </button>
                                                    </h2>

                                                    <div id="stepCollapse{{$loop->index}}{{$loop->parent->index}}" class="accordion-collapse collapse"
                                                         aria-labelledby="stepHeading{{$loop->index}}{{$loop->parent->index}}" data-bs-parent="#stepAccordion{{$loop->parent->index}}">
                                                        <div class="accordion-body">
                                                            <div class="d-flex flex-wrap">
                                                            <div class="col-md-5">
                                                                <h3>@lang('baseTexts.blockOutput'):</h3>
                                                                <p>{{$step["stringBlock"]}}</p>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <h3>@lang('baseTexts.subkey'):</h3>
                                                                <p>{{$step["subkey"]}}</p>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                        @endforeach
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
