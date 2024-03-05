@php
/** @var String $textToCopy */
@endphp
<button type="button" onclick="clickToCopyText('{{ $textToCopy }}', this)" title="@lang('baseTexts.copy')"
        class="btn border shadow-sm btn-sm">
    <i class="fa-solid fa-copy small"></i>
    <span class="copyDone" style="display: none">
        @lang('baseTexts.copyDone')
    </span>
</button>
