{!! Form::open() !!}

<div class="form-line">
    {!! Form::label('name', fragment('form.name'), ['class'=>'required']) !!}
    <div class="form-element">
        {!! Form::text('name') !!}
        {!! HTML::error($errors->first('name')) !!}
    </div>
</div>

<div class="form-line">
    {!! Form::label('telephone', fragment('form.telephone'), ['class'=>'required']) !!}
    <div class="form-element">
        {!! Form::text('telephone') !!}
        {!! HTML::error($errors->first('telephone')) !!}
    </div>
</div>

<div class="form-line">
    {!! Form::label('email', fragment('form.email'), ['class'=>'required']) !!}
    <div class="form-element">
        {!! Form::text('email') !!}
        {!! HTML::error($errors->first('email')) !!}
    </div>
</div>

<div class="form-line">
    {!! Form::label('address', fragment('form.address')) !!}
    <div class="form-element">
        {!! Form::text('address') !!}
        {!! HTML::error($errors->first('address')) !!}
    </div>
</div>

<div class="form-line">
    {!! Form::label('postal', fragment('form.postal').' + '.fragment('form.city')) !!}
    <div class="form-element form-element-postal">
        {!! Form::text('postal') !!}
        {!! HTML::error($errors->first('postal')) !!}
    </div>
    <div class="form-element form-element-city">
        {!! Form::text('city') !!}
        {!! HTML::error($errors->first('city')) !!}
    </div>
</div>

<div class="form-line">
    {!! Form::label('remarks', fragment('contact.remarks')) !!}
    <div class="form-element">
        {!! Form::textarea('remarks') !!}
        {!! HTML::error($errors->first('remarks')) !!}
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
