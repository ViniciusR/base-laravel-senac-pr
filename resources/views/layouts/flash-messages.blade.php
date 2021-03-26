<div id="flash-messages-container" style="display: none;" v-if="!handled_flash_messages">

    @foreach (['success', 'error', 'warning', 'info'] as $flashType)
        @if(session()->has($flashType))
            @if (is_array(session($flashType)))
                @foreach(session($flashType) as $message)
                    <span class="{{ $flashType }}">{{ $message }}</span>
                @endforeach
            @else
                <span class="{{ $flashType }}">{{ session($flashType) }}</span>
            @endif
        @endif
    @endforeach
</div>
