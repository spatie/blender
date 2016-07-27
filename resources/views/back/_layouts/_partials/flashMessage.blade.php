@unless (Html::flashMessage() == '')

    <div class="alerts {{ $extraClass or '' }}">
        {!! Html::flashMessage() !!}
    </div>

@endunless
