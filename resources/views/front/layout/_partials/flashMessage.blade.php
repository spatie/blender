@unless (HTML::flashMessage() == '')

    <div class="container message">
        {!! HTML::flashMessage() !!}
    </div>

@endunless