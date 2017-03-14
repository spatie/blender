@if($flashMessage = html()->flashMessage())

    <div class="{{ $extraClass or 'alerts' }}">
        {{ $flashMessage }}
    </div>

@endunless
