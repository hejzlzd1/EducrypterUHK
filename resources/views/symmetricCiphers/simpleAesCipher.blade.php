@php
    use App\Algorithms\CipherBase;
@endphp
@extends("components/pageTemplate")
@section("title",__('simpleAesPageTexts.title'))
@section("comment",__('simpleAesPageTexts.metaComment'))
@section("content")

    <div class="anchor" id="info"></div>

    <section class="m-5">
        <div class="shadow-lg border rounded-4 p-5">
            <div>
                <div class="container">
                    <div class="row align-items-start">
                        <h1><i class="fa-solid fa-circle-info"></i> Simple AES</h1>
                        <hr/>
                        <div class="col-lg-8">
                            <p>@lang('simpleAesPageTexts.annotation')</p>

                            <h4>@lang('simpleAesPageTexts.additionalSchemas')</h4>
                            <div id="carouselControls" class="carousel col-lg-8 mb-5" data-bs-ride="carousel" data-bs-interval="10000">
                                <div class="carousel-inner custom-carousel">
                                    <div class="carousel-item active">
                                        <a href="{{ asset('img/simpleAesPage/simpleAesGaloisMultiplication.png' )}}" target="_blank">
                                            <img alt="" src="{{ asset('img/simpleAesPage/simpleAesGaloisMultiplication.png') }}"
                                                 class="d-block w-100" title="@lang('baseTexts.clickToSeeInFullSize')">
                                        </a>
                                        <div class="label">
                                            @lang('simpleAesPageTexts.encryptMixNibbles')
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <a href="{{ asset('img/simpleAesPage/simpleAesGaloisMultiplicationInverse.png') }}" target="_blank">
                                            <img alt="" src="{{ asset('img/simpleAesPage/simpleAesGaloisMultiplicationInverse.png') }}"
                                                 class="d-block w-100" title="@lang('baseTexts.clickToSeeInFullSize')">
                                        </a>
                                        <div class="label">
                                            @lang('simpleAesPageTexts.decryptMixNibbles')
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <a href="{{ asset('img/simpleAesPage/simpleAesRowShift.png') }}" target="_blank">
                                            <img alt="" src="{{ asset('img/simpleAesPage/simpleAesRowShift.png') }}"
                                                 class="d-block w-100" title="@lang('baseTexts.clickToSeeInFullSize')">
                                        </a>
                                        <div class="label">
                                            @lang('simpleAesPageTexts.shiftRow')
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <a href="{{ asset('img/simpleAesPage/simpleAesRowShiftInverse.png') }}" target="_blank">
                                            <img alt="" src="{{ asset('img/simpleAesPage/simpleAesRowShiftInverse.png') }}"
                                                 class="d-block w-100" title="@lang('baseTexts.clickToSeeInFullSize')">
                                        </a>
                                        <div class="label">
                                            @lang('simpleAesPageTexts.shiftRow')
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <a href="{{ asset('img/simpleAesPage/simpleAesSbox.png') }}" target="_blank">
                                            <img alt="" src="{{ asset('img/simpleAesPage/simpleAesSbox.png') }}"
                                                 class="d-block w-100" title="@lang('baseTexts.clickToSeeInFullSize')">
                                        </a>
                                        <div class="label">
                                            @lang('simpleAesPageTexts.sbox')
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <a href="{{ asset('img/simpleAesPage/simpleAesSboxInverse.png') }}" target="_blank">
                                            <img alt="" src="{{ asset('img/simpleAesPage/simpleAesSboxInverse.png') }}"
                                                 class="d-block w-100" title="@lang('baseTexts.clickToSeeInFullSize')">
                                        </a>
                                        <div class="label">
                                            @lang('simpleAesPageTexts.sboxInverse')
                                        </div>
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselControls"
                                        data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselControls"
                                        data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-4 m-auto">
                            <a href="{{asset('img/simpleAesPage/simpleAes_' . App::getLocale() . '.png')}}"
                               target="_blank">
                                <img
                                    alt=""
                                    width="100%"
                                    title="@lang('baseTexts.clickToSeeInFullSize')"
                                    src="{{asset('img/simpleAesPage/simpleAes_' . App::getLocale() . '.png')}}"
                                />
                            </a>
                            <figure class="text-center">
                                @lang('simpleAesPageTexts.blockSchema')
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-3">
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
                                        @lang('simpleAesPageTexts.binaryInput')
                                        <x-tooltipButton
                                            :tooltip="trans('baseTexts.binaryInputPrompt')"></x-tooltipButton>
                                    </label>
                                    <input class="form-control binaryValidation" minlength="1" maxlength="16" required
                                           type="text"
                                           id="text"
                                           name="text"
                                           placeholder="@lang('baseTexts.binaryInputPrompt')"
                                           @if(isset($data['text']))value="{{$data['text']}}"@endif>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label" for="key">
                                        @lang('simpleAesPageTexts.binaryKey')
                                        <x-tooltipButton
                                            :tooltip="trans('baseTexts.binaryInputPrompt')"></x-tooltipButton>
                                    </label>
                                    <input class="form-control binaryValidation" minlength="1" maxlength="16"
                                           type="text" id="key"
                                           name="key"
                                           placeholder="@lang('baseTexts.binaryInputPrompt')"
                                           @if(isset($data['key'])) value="{{$data['key']}}" @else value="" @endif>
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
        @include('symmetricCiphers/results/simpleAesCipherResult')
    @endif

@endsection
