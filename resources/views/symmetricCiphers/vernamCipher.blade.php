@php
    use App\Algorithms\Output\BasicOutput;
    use App\Algorithms\Output\Steps\Step;
@endphp
@extends("components/pageTemplate")
@section("title",__('vernamPageTexts.title'))
@section("comment",__('vernamPageTexts.metaComment'))
@section("content")

    <div class="anchor" id="info"></div>

    <section class="m-5">
        <div class="p-5 shadow-lg border rounded-4">
            <div class="">
                <div class="container">
                    <div class="row align-items-start">
                        <h1><i class="fa-solid fa-circle-info"></i> @lang('menuTexts.vernamCipher')</h1>
                        <hr/>
                        <div class="col-lg-8">
                            <p>@lang('vernamPageTexts.annotation')</p>
                        </div>

                        <div class="col-lg-4 m-auto">
                            <a href="{{asset('img/vernamPage/vernam_' . App::getLocale() . '.png')}}" target="_blank">
                                <img
                                    alt=""
                                    title="@lang('baseTexts.clickToSeeInFullSize')"
                                    width="100%"
                                    src="{{asset('img/vernamPage/vernam_' . App::getLocale() . '.png')}}"
                                />
                            </a>
                            <figure class="text-center">@lang("vernamPageTexts.schema")</figure>
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
                                        <x-tooltipButton :tooltip="trans('baseTexts.binaryInput')"></x-tooltipButton>
                                    </label>
                                    <input class="form-control binaryValidation" maxlength="30" minlength="1" required
                                           type="text"
                                           id="text"
                                           name="text"
                                           placeholder="@lang('baseTexts.binaryInputPrompt')"
                                           @if(isset($data["text"]))value="{{$data["text"]}}"@endif>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="key">@lang('baseTexts.key')
                                        <x-tooltipButton :tooltip="trans('baseTexts.binaryInput')"></x-tooltipButton>
                                    </label>
                                    <input class="form-control binaryValidation" minlength="1" maxlength="30"
                                           required type="text" id="key" name="key"
                                           placeholder="@lang('baseTexts.binaryInputPrompt')"
                                           @if(isset($data["key"]))value="{{$data["key"]}}" @else value="" @endif>
                                </div>
                            </fieldset>
                            <div class="p-2">
                                <fieldset>
                                    <label>
                                        @lang("baseTexts.action")
                                        <x-tooltipButton
                                            :tooltip="trans('vernamPageTexts.keyMustBeSameLengthAsInput')"></x-tooltipButton>
                                    </label>
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
        @php /* @var BasicOutput $result */ @endphp
        <section class="m-5">
            <div class="shadow-lg border rounded-4 p-5">
                <div class="container text-break">
                    <h1 class=""><i class="fa-solid fa-comment"></i> @lang('baseTexts.cipherResult')</h1>
                    <hr/>
                    <div class="row align-items-start">
                        <div class="col-lg-5">
                            <h4><i class="fa-solid fa-keyboard"></i> @lang('baseTexts.insertedText')</h4>
                            <p>{{$data["text"]}}</p>
                        </div>
                        <div class="col-lg-5">
                            <h4><i class="fa-solid fa-key"></i> @lang('baseTexts.key')</h4>
                            <p>{{$data["key"]}}</p>
                        </div>
                    </div>
                    <div class="row align-items-start">
                        @if(strlen($data["key"]) !== strlen($result->getKey()))
                            <div class="col-lg-5">
                                <h4><i class="fa-solid fa-key"></i> @lang('baseTexts.formattedKey') </h4>
                                <p>{{$result->getKey()}}</p>
                                <p class="text-black-50">@lang('baseTexts.keyFormatted')</p>
                            </div>
                        @endif
                        <div class="col-lg-5">
                            <h4>
                                <i class="fa-solid fa-circle-down"></i>
                                @lang('baseTexts.outputText')
                                <x-copyButton :textToCopy="$result->getOutputValue()"></x-copyButton>
                            </h4>
                            <p>{{$result->getOutputValue()}}</p>
                        </div>
                    </div>
                    <hr/>

                    <h1><i class="fa-solid fa-list-ol"></i> @lang('baseTexts.algorithmSteps')</h1>
                    <div class="accordion" id="accordion">
                        @php /** @var Step $step */ @endphp
                        @foreach($result->getSteps() as $step)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{$loop->index + 1}}">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{$loop->index}}" aria-expanded="true"
                                            aria-controls="collapse{{$loop->index}}">
                                        @lang('baseTexts.stepNum') {{$loop->index + 1}}
                                        => {{ substr($result->getOutputValue(), 0, $loop->index) }}
                                        <b>{{ $step->getOutput() }}</b>
                                    </button>
                                </h2>
                                <div id="collapse{{$loop->index}}" class="accordion-collapse collapse"
                                     aria-labelledby="heading{{$loop->index}}"
                                     data-bs-parent="#accordion{{$loop->index}}">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <h3>@lang('baseTexts.input')</h3>
                                                <p>{{ $step->getInput() }}</p>
                                            </div>
                                            <div class="col-md-5">
                                                <h3>@lang('baseTexts.key')</h3>
                                                <p> {{ substr($result->getKey(), $loop->index-1, 1) }} </p>
                                            </div>
                                            <div class="col-md-5">
                                                <h3>@lang('baseTexts.output')</h3>
                                                <p> {{ $step->getOutput() }} </p>
                                            </div>
                                            <div class="col-md-5">
                                                <h3> P ⊕ K </h3>
                                                <p> {{ $step->getInput() }} ⊕ {{ substr($result->getKey(), $loop->index-1, 1) }} = {{ $step->getOutput() }} </p>
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
@endsection
