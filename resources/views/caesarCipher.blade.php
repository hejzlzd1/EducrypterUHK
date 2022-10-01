@extends("components/pageTemplate")
@section("title",__('caesarPageTexts.title'))
@section("comment",__('caesarPageTexts.metaComment'))
@section("content")
@include("components/menu")

<div class="anchor" id="info"></div>

<section class="m-5">
    <div>
        <div class="container shadow-lg border rounded-4 p-5">
            <div class="row align-items-start">
                <h1>@lang('menuTexts.caesarCipher')</h1>
                <hr />
                <div class="col-8">
                    <p>@lang('caesarPageTexts.annotation')</p>
                </div>

                <div class="col-4 m-auto">
                    <img width="100%" src="{{asset("img/caesarPage/caesarCipher.png")}}" class="rounded-4">
                    <figure class="text-center">@lang("caesarPageTexts.alphabetShift")</figure>
                </div>
            </div>
        </div>
    </div>
</section>

@include("components/footer")
@endsection
