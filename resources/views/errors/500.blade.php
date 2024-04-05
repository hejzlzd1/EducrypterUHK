@extends("components/pageTemplate")
@section("title",__("baseTexts.500"))
@section("comment",__('baseTexts.internalError'))
@section("content")

    <section class="mainContent">
        <div class="container shadow-lg text-center border rounded-4 p-5">
            <h3>@lang('baseTexts.500')</h3>
            <p>@lang('baseTexts.internalError')</p>
            <a href="mailto: hejzlzd1@uhk.cz">@lang('baseTexts.reportException')</a>
            <div>
                <img alt="" class="shadow-lg m-2 rounded-4" src="{{ asset('img/500.png') }}">
            </div>
        </div>
    </section>

@endsection
