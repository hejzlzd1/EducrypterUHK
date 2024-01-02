@php use App\Algorithms\CipherBase; @endphp
@extends("components/pageTemplate")
@section("title",__('a51PageTexts.title'))
@section("comment",__('a51PageTexts.metaComment'))
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
                            <a href="{{ asset('img/a51Page/a51_' . App::getLocale() . '.png')}}" target="_blank">
                                <img alt="" title="@lang('baseTexts.clickToSeeInFullSize')" width="100%"
                                     src="{{ asset('img/a51Page/a51_' . App::getLocale() . '.png') }}">
                            </a>
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
                                    <label class="form-label" for="text">
                                        @lang('baseTexts.binaryInput')
                                        <x-tooltipButton
                                            :tooltip="trans('baseTexts.binaryInputPrompt')"></x-tooltipButton>
                                    </label>
                                    <input class="form-control binaryValidation" maxlength="114" minlength="1" required
                                           type="text"
                                           id="text" name="text"
                                           placeholder="@lang('baseTexts.binaryInputPrompt')"
                                           @if(isset($data['text'])) value="{{ $data['text'] }}" @endif />
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="key">
                                        @lang('baseTexts.key')
                                        <x-tooltipButton
                                            :tooltip="trans('baseTexts.binaryInputPrompt')"></x-tooltipButton>
                                    </label>
                                    <input class="form-control binaryValidation" min="1" max="64" type="text" id="key"
                                           name="key" placeholder="@lang('baseTexts.insertKey')" required
                                           @if(isset($data['key'])) value="{{ $data['key'] }}" @else value="" @endif />
                                </div>
                            </fieldset>
                            <fieldset class="row p-2">
                                <div class="col-lg-6">
                                    <label class="form-label" for="dataFrame">
                                        @lang('a51PageTexts.dataFrame')
                                        <x-tooltipButton
                                            :tooltip="trans('a51PageTexts.dataFrameNumberExplanation')"></x-tooltipButton>
                                    </label>
                                    <input class="form-control" type="number" max="4194304" min="0" id="dataFrame"
                                           name="dataFrame" placeholder="@lang('a51PageTexts.inputDataFrame')" required
                                           @if(isset($data['dataFrame'])) value="{{ $data['dataFrame'] }}"
                                           @else value="" @endif />
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
                                               value={{CipherBase::ALGORITHM_ENCRYPT}}>
                                    </div>
                                    <div class="form-check form-switch">
                                        <label class="form-check-label" for="decrypt">@lang('baseTexts.decrypt')</label>
                                        <input class="form-check-input" required type="radio"
                                               id="decrypt" name="action"
                                               value={{CipherBase::ALGORITHM_DECRYPT}}>
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
            /** @var App\Algorithms\Output\Steps\A5_1Step $step */
            /** @var App\Algorithms\Output\BasicOutput $result */
        @endphp
        <section class="m-5 shadow-lg border rounded-4 p-5">
            <div class="container text-break">
                <h1 class="">
                    <i class="fa-solid fa-comment"></i> @lang('baseTexts.cipherResult')
                </h1>
                <hr/>
                <div class="row align-items-start">
                    <div class="col-lg-5">
                        <h4><i class="fa-solid fa-keyboard"></i> @lang('baseTexts.insertedText')</h4>
                        <p>{{ $result->getInputValue() }}</p>
                    </div>
                    <div class="col-lg-5">
                        <h4><i class="fa-solid fa-key"></i> @lang('baseTexts.key')</h4>
                        <p>{{ $result->getKey() }}</p>
                    </div>
                    <div class="col-lg-5">
                        <h4><i class="fa-solid fa-key"></i> @lang('a51PageTexts.dataFrame')</h4>
                        <p>{{ $result->getAdditionalInformation()['dataFrame'] }}
                            => {{ $result->getAdditionalInformation()['dataFrameBinary'] }}</p>
                    </div>
                    <div class="col-lg-5">
                        <h4>
                            <i class="fa-solid fa-key"></i>
                            @lang('a51PageTexts.keyStream')
                        </h4>
                        <p>{{ $result->getAdditionalInformation()['keyStream'] }}</p>
                    </div>
                </div>
                <div class="row align-items-start">
                    <div class="col">
                        <h4>
                            <i class="fa-solid fa-circle-down"></i>
                            @lang('baseTexts.outputText')
                            <x-copyButton :textToCopy="$result->getOutputValue()"></x-copyButton>
                        </h4>
                        <p>{{ $result->getOutputValue() }}</p>
                    </div>
                </div>
                <hr/>

                <div class="mt-4">
                    <h1><i class="fa-solid fa-list-ol"></i> @lang('baseTexts.algorithmSteps')</h1>
                    <div class="accordion" id="accordion">
                        @foreach($result->getSteps() as $step)
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#step{{ $loop->index }}" aria-expanded="true"
                                            aria-controls="step{{ $loop->index }}">
                                        @lang('baseTexts.stepNum') {{ $loop->index + 1 }}:
                                        {{ substr($result->getOutputValue(), 0, $loop->index) }}
                                        <b>{{ $result->getOutputValue()[$loop->index] }}</b>
                                    </button>
                                </h2>
                                <div id="step{{ $loop->index }}"
                                     class="accordion-collapse collapse @if($loop->first) show @endif">
                                    <div class="accordion-body">
                                        <div class="majorityBit">
                                            <h5>
                                                <i class="fa-solid fa-gears"></i> @lang('a51PageTexts.majorityBit'):
                                            </h5>
                                            <p>{{ $step->getMajorityBit() }} => @lang('a51PageTexts.toBeClocked')
                                                [{{ $step->getToBeClocked() }}]</p>
                                        </div>
                                        <hr>
                                        <div class="d-flex flex-wrap justify-content-lg-between registers">
                                            <div class="flex-column p-2 overflow-auto">
                                                <h4>
                                                    <i class="fa-solid fa-layer-group"></i> @lang('a51PageTexts.registersBeforeClock')
                                                </h4>
                                                @foreach($step->getRegistersBeforeClock() as $key => $register)
                                                    <div class="register-{{ $key }} m-1">
                                                        <h5>
                                                            {{ $key }}
                                                        </h5>
                                                        <table class="table-sm overflow-scroll">
                                                            <tr>
                                                                @foreach(str_split($register) as $char)
                                                                    <td class="register-{{ $key }}-{{ $loop->index }} border-1 border">
                                                                        {{ $char }}
                                                                    </td>
                                                                @endforeach
                                                            </tr>
                                                        </table>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="flex-column p-2 overflow-auto">
                                                <h4>
                                                    <i class="fa-solid fa-layer-group"></i> @lang('a51PageTexts.registersAfterClock')
                                                </h4>
                                                @foreach($step->getRegistersAfterClock() as $key => $register)
                                                    <div class="register-{{ $key }}">
                                                        <h5>
                                                            {{ $key }}
                                                        </h5>
                                                        <table class="table-sm">
                                                            <tr>
                                                                @foreach(str_split($register) as $char)
                                                                    <td class="register-{{ $key }}-{{ $loop->index }} border-1 border">
                                                                        {{ $char }}
                                                                    </td>
                                                                @endforeach
                                                            </tr>
                                                        </table>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <hr>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <h5>
                                                    <i class="fa-solid fa-gears"></i> KB
                                                    - @lang('a51PageTexts.keystreamBit') (R1[18] ⊕ R2[21] ⊕ R3[22])
                                                </h5>
                                                <p>{{ substr($result->getAdditionalInformation()['keyStream'], 0, $loop->index) }}
                                                    <b>{{ $step->getKeystreamBit() }}</b></p>
                                            </div>
                                            <div class="col-lg-6">
                                                <h5>
                                                    <i class="fa-solid fa-keyboard"></i> IB
                                                    - @lang('a51PageTexts.inputBit')
                                                </h5>
                                                <p>
                                                    {{ substr($result->getInputValue(), 0, $loop->index) }}
                                                    <b>{{ $result->getInputValue()[$loop->index] }}</b>
                                                </p>
                                            </div>
                                            <div class="col-lg-6">
                                                <h5>
                                                    <i class="fa-solid fa-circle-down"></i> @lang('a51PageTexts.outputBit')
                                                    (KB ⊕ IB)
                                                </h5>
                                                <p>
                                                    {{ substr($result->getAdditionalInformation()['keyStream'], 0, $loop->index) }}
                                                    <b>{{ $step->getKeystreamBit() }}</b>
                                                    ⊕ {{ substr($result->getOutputValue(), 0, $loop->index) }}
                                                    <b>{{ $result->getInputValue()[$loop->index] }}</b>
                                                    => {{ substr($result->getOutputValue(), 0, $loop->index) }}
                                                    <b>{{ $result->getOutputValue()[$loop->index] }}</b>
                                                </p>
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
