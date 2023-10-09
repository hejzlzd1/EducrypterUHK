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
                                    <input class="form-control" min="1" type="number" id="primeNumber1" name="primeNumber1" onchange="checkIsPrime('primeNumber1', 'primeNumber2')"
                                           @if(isset($data["primeNumber1"]))value="{{$data["primeNumber1"]}}"@endif required>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="primeNumber2">2. @lang('baseTexts.primeNumber')</label>
                                    <input class="form-control" min="1" type="number" id="primeNumber2" name="primeNumber2" onchange="checkIsPrime('primeNumber2', 'primeNumber1')"
                                           @if(isset($data["primeNumber2"]))value="{{$data["primeNumber2"]}}" @endif required>
                                </div>
                                <div id="error-dialog" style="display: none;" class="text-danger">Error: Some input values are not prime numbers</div>

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

                            @include('components.submitButton')
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
                            <p>{{$data["primeNumber1"]}}</p>
                        </div>
                        <div class="col-lg-5">
                            <h4>2. @lang('baseTexts.primeNumber')</h4>
                            <p>{{$data["primeNumber2"]}}</p>
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
    <script>
        function checkIsPrime(inputId, otherInputId) {
            const input = document.getElementById(inputId);
            const otherInput = document.getElementById(otherInputId);
            const number = input.value;
            const otherNumber = otherInput.value;

            let firstResult = isPrime(number);
            let secondResult = isPrime(otherNumber);

            if (number <= 1 || !firstResult || !secondResult && (number !== "" && otherNumber !== "")) {
                showErrorDialog();
                !firstResult ? input.style.color = "red" : input.style.color = "black";
                !secondResult ? otherInput.style.color = "red" : otherInput.style.color = "black";
                if(number <= 1){
                    input.style.color = "red";
                    otherInput.style.color = "red";
                }
                document.getElementById("submit").disabled = true;
            } else {
                hideErrorDialog();
                input.style.color = 'black'
                otherInput.style.color = 'black'
                document.getElementById("submit").disabled = false;
            }
        }

        function isPrime(number) {
            if (number <= 1) {
                return false;
            }

            const sqrt = Math.floor(Math.sqrt(number));
            for (let i = 2; i <= sqrt; i++) {
                if (number % i === 0) {
                    return false;
                }
            }
            return true;
        }

        function showErrorDialog() {
            const errorDialog = document.getElementById('error-dialog');
            errorDialog.style.display = 'block';
        }

        function hideErrorDialog() {
            const errorDialog = document.getElementById('error-dialog');
            errorDialog.style.display = 'none';
        }
    </script>
    @include("components/footer")
@endsection
