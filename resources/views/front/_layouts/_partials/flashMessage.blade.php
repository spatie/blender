@unless (Html::flashMessage() == '')

    <div class="container message">
        {!! Html::flashMessage() !!}
    </div>

@endunless
