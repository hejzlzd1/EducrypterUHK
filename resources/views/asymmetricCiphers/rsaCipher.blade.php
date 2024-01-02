@php
    use App\Algorithms\CipherBase;
    use App\Algorithms\Output\Steps\RSAStep;
    use App\Algorithms\Output\RsaOutput;
@endphp
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
                        <h1><i class="fa-solid fa-circle-info"></i> RSA</h1>
                        <hr/>
                        <div class="col-lg-8">
                            <p>@lang('rsaPageTexts.annotation')</p>
                        </div>

                        <div class="col-lg-4 m-auto">
                            <a href="{{ asset('img/rsaPage/rsa_' . App::getLocale() . '.png') }}" target="_blank">
                                <img alt="" width="100%" title="@lang('baseTexts.clickToSeeInFullSize')"
                                     src="{{ asset('img/rsaPage/rsa_' . App::getLocale() . '.png') }}"
                                />
                            </a>
                            <figure class="text-center">@lang("rsaPageTexts.schema")</figure>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pt-2">
                <div class="container">
                    <div class="row align-items-start">
                        <h1 class="">
                            <i class="fa-regular fa-file-lines"></i> @lang('baseTexts.cipherForm')
                        </h1>
                        <p class="text-black-50">
                            @lang('baseTexts.formInfoDescription')
                        </p>
                        <hr/>
                        <form action="" method="post">
                            @csrf
                            <fieldset class="row p-2">
                                <div class="col-lg-6">
                                    <label class="form-label" for="text">
                                        @lang('baseTexts.text')
                                        <x-tooltipButton :tooltip="trans('baseTexts.inputText')"></x-tooltipButton>
                                    </label>
                                    <input class="form-control" maxlength="40" minlength="1" required type="text"
                                           id="text" name="text"
                                           placeholder="@lang('baseTexts.inputText')"
                                           @if(isset($data['text'])) value="{{ $data['text'] }}" @endif
                                    />
                                </div>
                            </fieldset>

                            <fieldset class="row p-2 disableOnEncrypt">
                                <div class="col-lg-6">
                                    <label class="form-label" for="publicKey">
                                        @lang('baseTexts.publicKey') N
                                        <x-tooltipButton
                                            :tooltip="trans('rsaPageTexts.inputPrivateKey')"></x-tooltipButton>
                                    </label>
                                    <input class="form-control disableOnEncrypt" min=1 required type="number"
                                           id="publicKey" name="publicKey"
                                           placeholder="@lang('rsaPageTexts.inputPublicKey')"
                                           @if(isset($data['publicKey'])) value="{{ $data['publicKey'] }}" @endif
                                    />
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="privateKey">
                                        @lang('baseTexts.privateKey') D
                                        <x-tooltipButton
                                            :tooltip="trans('rsaPageTexts.inputPrivateKey')"></x-tooltipButton>
                                    </label>
                                    <input class="form-control disableOnEncrypt" min=1 required type="number"
                                           id="privateKey" name="privateKey"
                                           placeholder="@lang('rsaPageTexts.inputPrivateKey')"
                                           @if(isset($data['privateKey'])) value="{{ $data['privateKey'] }}" @endif />
                                </div>
                            </fieldset>

                            <fieldset class="row p-2 disableOnDecrypt">
                                <div class="col-lg-6">
                                    <label class="form-label" for="primeNumber1">
                                        1. @lang('rsaPageTexts.primeNumber')
                                        <x-tooltipButton
                                            :tooltip="trans('rsaPageTexts.insertPrimeNumberTooltip')"></x-tooltipButton>
                                    </label>
                                    <input class="form-control primeNumber disableOnDecrypt"
                                           placeholder="@lang('rsaPageTexts.insertPrimeNumber')" min="1" type="number"
                                           id="primeNumber1" name="primeNumber1"
                                           @if(isset($data['primeNumber1'])) value="{{ $data['primeNumber1'] }}"
                                           @endif required/>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="primeNumber2">
                                        2. @lang('rsaPageTexts.primeNumber')
                                        <x-tooltipButton
                                            :tooltip="trans('rsaPageTexts.insertPrimeNumberTooltip')"></x-tooltipButton>
                                    </label>
                                    <input class="form-control primeNumber disableOnDecrypt"
                                           placeholder="@lang('rsaPageTexts.insertPrimeNumber')" min="1" type="number"
                                           id="primeNumber2" name="primeNumber2"
                                           @if(isset($data['primeNumber2'])) value="{{ $data['primeNumber2'] }}"
                                           @endif required/>
                                </div>
                                <div id="error-dialog" style="display: none;"
                                     class="text-danger">@lang('rsaPageTexts.noPrimeNumbers')
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
                                               value={{ CipherBase::ALGORITHM_ENCRYPT }}>
                                    </div>
                                    <div class="form-check form-switch">
                                        <label class="form-check-label" for="decrypt">@lang('baseTexts.decrypt')</label>
                                        <input class="form-check-input" required type="radio"
                                               id="decrypt" name="action"
                                               value={{ CipherBase::ALGORITHM_DECRYPT }}>
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
        @php
            /** @var RsaOutput $result */
            /** @var RSAStep $step */
        @endphp
        <section class="m-5 shadow-lg border rounded-4 p-5">
            <div class="container text-break">

                <h1 class="">
                    <i class="fa-solid fa-comment"></i> @lang('baseTexts.cipherResult')
                </h1>
                <hr/>
                <div class="row align-items-start">
                    <div class="col-lg-5">
                        <h4>
                            <i class="fa-solid fa-keyboard"></i>
                            @lang('baseTexts.insertedText')
                        </h4>
                        <p>{{ $data['text'] }}</p>
                    </div>

                    @if($result->getOperation() === CipherBase::ALGORITHM_ENCRYPT)
                        <div class="col-lg-5">
                            <h4>
                                <i class="fa-solid fa-keyboard"></i>
                                @lang('rsaPageTexts.asciiText')
                            </h4>
                            <p>{{ $result->getInputValue() }}</p>
                        </div>
                    @endif
                </div>

                @if($result->getOperation() === CipherBase::ALGORITHM_ENCRYPT)
                    <div class="row align-items-start">
                        <div class="col-lg-5">
                            <h4>1. @lang('rsaPageTexts.primeNumber')</h4>
                            <p>{{ $data['primeNumber1'] }}</p>
                        </div>
                        <div class="col-lg-5">
                            <h4>2. @lang('rsaPageTexts.primeNumber')</h4>
                            <p>{{ $data['primeNumber2'] }}</p>
                        </div>
                    </div>
                @endif

                <div class="row align-items-start">
                    <div class="col">
                        @if($result->getOutputValue())
                            <h4>
                                <i class="fa-solid fa-circle-down"></i>
                                @lang('baseTexts.outputText')
                                <x-copyButton :textToCopy="$result->getOutputValue()"></x-copyButton>
                            </h4>
                            <p>{{ $result->getOutputValue() }}</p>
                        @endif
                    </div>
                </div>

                @if($result->getOperation() === CipherBase::ALGORITHM_ENCRYPT)
                    <div class="mt-3">
                        <h2>
                            <i class="fa fa-calculator"></i>
                            @lang('rsaPageTexts.calculatedVariables')
                        </h2>
                        <div class="mt-2 row align-items-start">
                            <div class="col-lg-5">
                                <h4>
                                    <x-tooltipButton :tooltip="trans('baseTexts.publicKey')"></x-tooltipButton>
                                    n = p×q
                                    <x-copyButton :textToCopy="$result->getN()"></x-copyButton>
                                </h4>
                                <p><b>{{ $result->getN() }}</b></p>
                            </div>
                            <div class="col-lg-5">
                                <h4>ϕ(n) = (p−1) × (q−1)</h4>
                                <p>{{ $result->getPhi() }}</p>
                            </div>
                            <div class="col-lg-5">
                                <h4>e = gcd(e,ϕ(n))=1)</h4>
                                <p>{{ $result->getE() }}</p>
                            </div>
                        </div>
                        <div class="mt-2 row align-items-start">
                            <div class="col-lg-5">
                                <h4>
                                    <x-tooltipButton :tooltip="trans('baseTexts.privateKey')"></x-tooltipButton>
                                    e · d ≡ 1 mod φ(n)
                                    <x-copyButton :textToCopy="$result->getD()"></x-copyButton>
                                </h4>
                                <p><b>{{ $result->getD() }}</b></p>
                            </div>
                        </div>
                    </div>
                @endif


                <hr/>

                <div class="mt-4">
                    <h1><i class="fa-solid fa-list-ol"></i> @lang('baseTexts.algorithmSteps')</h1>
                    <div class="accordion" id="rsaSteps">
                        @foreach($result->getSteps() as $step)
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#step{{ $loop->index }}" aria-expanded="true"
                                            aria-controls="step{{ $loop->index }}">
                                        {{ $step->getInputChar() }} => {{ $step->getOutputChar() }}
                                    </button>
                                </h2>
                                <div id="step{{ $loop->index }}" class="accordion-collapse collapse"
                                     data-bs-parent="#rsaSteps">
                                    <div class="accordion-body">
                                        <div class="row align-items-start">
                                            <div class="col-lg-5">
                                                <h4><i class="fa-solid fa-keyboard"></i> @lang('rsaPageTexts.inputChar')
                                                </h4>
                                                <p>{{ $step->getInputChar() }}</p>
                                            </div>
                                            <div class="col-lg-5">
                                                <h4>
                                                    <i class="fa-solid fa-calculator"></i> @lang('rsaPageTexts.beforeModulo')
                                                </h4>
                                                <p>{{ $step->getBeforeModulo() }}</p>
                                            </div>
                                            <div class="col-lg-5">
                                                <h4>
                                                    <i class="fa-solid fa-circle-down"></i> @lang('rsaPageTexts.outputChar')
                                                </h4>
                                                <p>{{ $step->getOutputChar() }}</p>
                                            </div>
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
