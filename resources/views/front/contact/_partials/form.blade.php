{!! Form::open(['data-validate']) !!}

<p>
    {!! Form::label('name', fragment('form.name'), ['class'=>'label--required']) !!}
    {!! Form::text('name', null, ['required', 'min' => 5, 'max' => '10', 'autocomplete' => 'off']) !!}
    {!! Html::error($errors->first('name'), 'name') !!}
</p>
<p>
    {!! Form::label('telephone', fragment('form.telephone'), ['class'=>'label--required']) !!}
    {!! Form::text('telephone') !!}
    {!! Html::error($errors->first('telephone'), 'telephone') !!}
</p>
<p>
    {!! Form::label('email', fragment('form.email'), ['class'=>'label--required']) !!}
    {!! Form::email('email') !!}
    {!! Html::error($errors->first('email'), 'email') !!}
</p>
<p>
    {!! Form::label('address', fragment('form.address')) !!}
    {!! Form::text('address') !!}
    {!! Html::error($errors->first('address'), 'address') !!}
</p>
<p>
    <div class="grid">
        <div class="grid__cell -width-1/4">
            {!! Form::label('postal', fragment('form.postal')) !!}
            {!! Form::text('postal') !!}
        </div>
        <div class="grid__cell  -width-3/4">
            {!! Form::label('city', fragment('form.city')) !!}
            {!! Form::text('city') !!}
        </div>
    </div>
    {!! Html::error($errors->first('postal'), 'postal') !!}
    {!! Html::error($errors->first('city')) !!}
</p>
<p>
    {!! Form::label('remarks', fragment('contact.remarks')) !!}
    {!! Form::textarea('remarks') !!}
    {!! Html::error($errors->first('remarks'), 'remarks') !!}
</p>
<p>
{!! Recaptcha::render(['lang' => locale()]) !!}
{!! HTML::error($errors->first('g-recaptcha-response')) !!}
</p>
<p>
    {!! Form::button(fragment('contact.button'), ['type'=>'submit', 'class'=>'button--primary']) !!}
</p>

{!! Form::close() !!}

<p class="alert--info">
    {!! fragment('form.fieldsAreRequired') !!}
</p>
