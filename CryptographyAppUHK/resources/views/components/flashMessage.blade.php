<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
            <div class="alert alert-{{$msg}}" role="alert" id="alert-message">
                <p>{{Session::get('alert-'.$msg)}}</p>
                <a class="close">&times;</a>
            </div>
        @endif
    @endforeach
</div>
