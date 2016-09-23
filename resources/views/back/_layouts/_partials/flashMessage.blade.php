@unless (Html::flashMessage() == '')

    <div class="{{ $extraClass or 'alerts' }}">
        {!! Html::flashMessage() !!}
    </div>

@endunless
