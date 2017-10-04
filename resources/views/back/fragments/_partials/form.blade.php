@foreach(locales() as $locale)
    @php(html()->locale($locale))

    <div class="form__group">
        @if ($fragment->image)
            {{ html()->formGroup()->media('images', 'image', 'Image') }}
        @else
            {{ html()->label(html()->span($locale)->class('label--lang'), 'text') }}
            {{ html()
                ->{$fragment->html ? 'redactor' : 'text'}('text')
                ->value(old(translate_field_name('text'), $fragment->getTranslation($locale)))
            }}
            {{ html()->errorFor('text') }}
        @endif
        {{ html()->error($errors->first(translate_field_name('text', $locale))) }}
    </div>

    @php(html()->endLocale())
@endforeach
