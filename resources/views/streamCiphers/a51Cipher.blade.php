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
                        <h1><i class="fa-solid fa-circle-info"></i> A5/1</h1>
                        <hr/>
                        <div class="col-lg-8">
                            <p>@lang('a51PageTexts.annotation')</p>
                        </div>

                        <div class="col-lg-4 m-auto">
                            <a href="{{asset('img/caesarPage/caesarCipher.png')}}" target="_blank"> <img width="100%"
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
                                    <label class="form-label" for="text">@lang('baseTexts.text')</label>
                                    <input class="form-control" maxlength="40" minlength="1" required type="text"
                                           id="text" name="text"
                                           placeholder="@lang('baseTexts.inputText')"
                                           @if(isset($data['text']))value="{{$data['text']}}"@endif>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="key">@lang('baseTexts.key')</label>
                                    <input class="form-control" type="text" id="key" name="key" placeholder="@lang('baseTexts.insertKey')"
                                           @if(isset($data['key']))value="{{$data['key']}}" @else value="" @endif>
                                </div>
                            </fieldset>
                            <fieldset class="row p-2">
                                <div class="col-lg-6">
                                    <label class="form-label" for="key">@lang('baseTexts.iv')</label>
                                    <input class="form-control" type="text" id="iv" name="iv" placeholder="@lang('baseTexts.inputIV')" required
                                           @if(isset($data['iv']))value="{{$data['iv']}}" @else value="" @endif>
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
                            <h4><i class="fa-solid fa-key"></i> @lang('baseTexts.iv')</h4>
                            <p>{{$result->getAdditionalInformation()['iv']}}</p>
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

                        </div>
                    </div>
            </div>
        </section>
    @endif

    @include("components/footer")
@endsection
