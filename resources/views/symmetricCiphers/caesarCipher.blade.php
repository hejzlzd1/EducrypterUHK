@php
    use App\Algorithms\CipherBase;
    use App\Algorithms\Output\BasicOutput;
    use App\View\Components\GenerateInputButton;
@endphp
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
                        <h1><i class="fa-solid fa-circle-info"></i> @lang('menuTexts.caesarCipher')</h1>
                        <hr/>
                        <div class="col-lg-8">
                            <p>@lang('caesarPageTexts.annotation')</p>
                        </div>

                        <div class="col-lg-4 m-auto">
                            <a href="{{asset('img/caesarPage/caesarCipher.png')}}" target="_blank">
                                <img
                                    title="@lang('baseTexts.clickToSeeInFullSize')"
                                    width="100%"
                                    src="{{asset("img/caesarPage/caesarCipher.png")}}"
                                    alt=""
                                />
                            </a>
                            <figure class="text-center schemaTitle">@lang("caesarPageTexts.alphabetShift")</figure>
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
                                    <label class="form-label" for="text">
                                        @lang('baseTexts.text')
                                    </label>
                                    <div class="input-group">
                                        <input class="form-control" maxlength="40" minlength="1" required type="text"
                                               id="text" name="text"
                                               placeholder="@lang('baseTexts.inputText')"
                                               @if(isset($data["text"]))value="{{$data["text"]}}"@endif>
                                        <x-generateInputButton
                                            type="{{ GenerateInputButton::TYPE_TEXT }}"
                                            size="40"
                                            target="#text">
                                        </x-generateInputButton>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="shift">
                                        @lang('baseTexts.shift') - max 26
                                    </label>
                                    <div class="input-group">
                                        <input class="form-control" min="0" max="26" type="number" id="shift"
                                               name="shift"
                                               @if(isset($data["shift"]))value="{{$data["shift"]}}"
                                               @else value="0" @endif>
                                        <x-generateInputButton
                                            type="{{ GenerateInputButton::TYPE_NUMBER }}"
                                            size="26"
                                            target="#shift">
                                        </x-generateInputButton>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="p-2">
                                <fieldset>
                                    <label>@lang("baseTexts.action")</label>
                                    <br/>
                                    <div class="form-check form-switch">
                                        <label class="form-check-label" for="encrypt">@lang('baseTexts.encrypt')</label>
                                        <input class="form-check-input" onclick="flipShiftInput()" required type="radio"
                                               id="encrypt" name="action"
                                               value={{CipherBase::ALGORITHM_ENCRYPT}}>
                                    </div>
                                    <div class="form-check form-switch">
                                        <label class="form-check-label" for="decrypt">@lang('baseTexts.decrypt')</label>
                                        <input class="form-check-input" onclick="flipShiftInput()" required type="radio"
                                               id="decrypt" name="action"
                                               value={{CipherBase::ALGORITHM_DECRYPT}}>
                                    </div>
                                    <div class="form-check form-switch">
                                        <label class="form-check-label"
                                               for="bruteforce">@lang('baseTexts.bruteforce')</label>
                                        <input class="form-check-input" onclick="flipShiftInput()" required type="radio"
                                               id="bruteforce" name="action"
                                               value={{CipherBase::ALGORITHM_DECRYPT_BRUTEFORCE}}>
                                    </div>
                                    <script>
                                        function flipShiftInput() {
                                            if (document.getElementById("bruteforce").checked === true) {
                                                document.getElementById("shift").disabled = true;
                                                document.getElementById("shift").value = 0;
                                            } else {
                                                document.getElementById("shift").disabled = false;
                                            }
                                        }
                                    </script>
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
        @include('symmetricCiphers/results/caesarCipherResult')
    @endif
@endsection
