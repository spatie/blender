{!! Form::open(['data-validate']) !!}

<div class="form-line">
    {!! Form::label('name', fragment('form.name'), ['class'=>'required']) !!}
    <div class="form-element">
        {!! Form::text('name', null, ['required', 'min' => 5, 'max' => '10', 'autocomplete' => 'off']) !!}
        {!! Html::error($errors->first('name'), 'name') !!}
    </div>
</div>

<div class="form-line">
    {!! Form::label('telephone', fragment('form.telephone'), ['class'=>'required']) !!}
    <div class="form-element">
        {!! Form::text('telephone') !!}
        {!! Html::error($errors->first('telephone'), 'telephone') !!}
    </div>
</div>

<div class="form-line">
    {!! Form::label('email', fragment('form.email'), ['class'=>'required']) !!}
    <div class="form-element">
        {!! Form::email('email') !!}
        {!! Html::error($errors->first('email'), 'email') !!}
    </div>
</div>

<div class="form-line">
    {!! Form::label('address', fragment('form.address')) !!}
    <div class="form-element">
        {!! Form::text('address') !!}
        {!! Html::error($errors->first('address'), 'address') !!}
    </div>
</div>

<div class="form-line">
    {!! Form::label('postal', fragment('form.postal').' + '.fragment('form.city')) !!}
    <div class="form-element form-element-postal">
        {!! Form::text('postal') !!}
        {!! Html::error($errors->first('postal'), 'postal') !!}
    </div>
    <div class="form-element form-element-city">
        {!! Form::text('city') !!}
        {!! Html::error($errors->first('city')) !!}
    </div>
</div>

<div class="form-line">
    {!! Form::label('remarks', fragment('contact.remarks')) !!}
    <div class="form-element">
        {!! Form::textarea('remarks') !!}
        {!! Html::error($errors->first('remarks'), 'remarks') !!}
    </div>
</div>

<div class="form-line-submit">
    <div class="form-element">
        {!! Form::button(fragment('contact.button'), ['type'=>'submit']) !!}
    </div>
</div>

{!! Form::close() !!}

<p class="required-help">
    {!! fragment('form.fieldsAreRequired') !!}
</p>
