@foreach(locales() as $locale)
    @php(html()->locale($locale))

    <div class="form__group">
        @if ($fragment->contains_image)
            {{ html()->media('images', 'image') }}
        @elseif($fragment->contains_html)
            {{ html()->formGroup()->redactor('text', html()->span($locale)->class('label--lang')) }}
            {!! Form::redactor($fragment, 'text', $locale) !!}
        @else
            {{ html()->formGroup()->text('text', html()->span($locale)->class('label--lang')) }}
        @endif
        {{ html()->error($errors->first(translate_field_name('text', $locale))) }}
    </div>

    @php(html()->endLocale())
@endforeach
