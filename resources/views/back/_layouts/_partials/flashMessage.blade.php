@unless (HTML::flashMessage() == '')

    <div class="alerts {{ $extraClass or '' }}">
        {!! HTML::flashMessage() !!}
    </div>

@endunless
