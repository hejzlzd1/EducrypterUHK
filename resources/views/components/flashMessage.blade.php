<div class="flash-message" id="flash-messages">
    @foreach (['error', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
            <div class="Message js-timer Message--{{ $msg }}">
                <div class="Message-icon">
                    @switch($msg)
                        @case ("error")
                            <i class="fa fa-times"></i>
                            @break
                        @case ("info")
                            <i class="fa fa-bell"></i>
                            @break
                        @case ("warning")
                            <i class="fa fa-exclamation"></i>
                            @break
                        @case ("success")
                            <i class="fa fa-check"></i>
                            @break
                    @endswitch
                </div>
                <div class="Message-body shadow-lg">
                    <p>{{ Session::get('alert-'.$msg) }}</p>
                </div>
                <button class="Message-close js-messageClose"><i class="fa fa-times"></i></button>
            </div>
        @endif
    @endforeach
</div>
