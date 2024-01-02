@extends("components/pageTemplate")
@section("title",__("baseTexts.404"))
@section("comment",__('baseTexts.notFound'))
@section("content")

    <section class="m-5">
        <div class="container shadow-lg text-center border rounded-4 p-5">
            <h3>@lang('baseTexts.404')</h3>
            <p>@lang('baseTexts.notFound')</p>
            <div>
                <img alt="" class="shadow-lg m-2 rounded-4" src="{{ asset('img/404.png') }}">
            </div>
        </div>
    </section>

    @include("components/footer")
@endsection
