@foreach(config('app.locales') as $locale)
    <div class="form_group">
        {!! Form::getLabelForTranslatedField('text', trans('back-fragments.text'), $locale) !!}

        @if($fragment->contains_html)
        {!! Form::redactor($fragment, 'text', $locale) !!}
        @else
        {!! Form::textarea(Form::getTranslatedFieldName('text', $locale), Form::useInitialValue($fragment, 'text', $locale), [
            'data-autosize',
            'rows' => '2',
        ]) !!}
        @endif

        {!! HTML::error($errors->first(Form::getTranslatedFieldName('text', $locale))) !!}
    </div>
@endforeach

<div class="form_group -buttons">
    {!!  Form::button(trans('back-fragments.save'), ['type' => 'submit' , 'class' => 'button -default']) !!}
</div>
