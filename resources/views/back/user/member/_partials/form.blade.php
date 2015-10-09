<div class="form_group">
    {!! Form::label('email', 'E-mail') !!}
    {!! Form::email('email', Input::old('email'), [ ]) !!}
    {!! HTML::error($errors->first('email')) !!}
</div>

<div class="grid_row">
    <div class="grid_col -width-1/3">
        <div class="form_group">
            {!! Form::label('first_name', trans('back-users.first_name')) !!}
            {!! Form::text('first_name', Input::old('first_name'), [ ]) !!}
            {!! HTML::error($errors->first('first_name')) !!}
        </div>
    </div>
    <div class="grid_col -width-2/3 -last">
        <div class="form_group">
            {!! Form::label('last_name', trans('back-users.last_name')) !!}
            {!! Form::text('last_name', Input::old('last_name'), [ ]) !!}
            {!! HTML::error($errors->first('lastName')) !!}
        </div>
    </div>
</div>

<div class="form_group">
    {!! Form::label('address', 'Adres') !!}
    {!! Form::text('address', Input::old('address'), [ ]) !!}
    {!! HTML::error($errors->first('address')) !!}
</div>

<div class="form_group">
    {!! Form::label('postal', 'Postcode') !!}
    {!! Form::text('postal', Input::old('postal'), [ ]) !!}
    {!! HTML::error($errors->first('postal')) !!}
</div>

<div class="form_group">
    {!! Form::label('city', 'Plaatsnaam') !!}
    {!! Form::text('city', Input::old('city'), [ ]) !!}
    {!! HTML::error($errors->first('city')) !!}
</div>

<div class="form_group">
    {!! Form::label('country', 'Land') !!}
    {!! Form::text('country', Input::old('country'), [ ]) !!}
    {!! HTML::error($errors->first('country')) !!}
</div>

<div class="form_group">
    {!! Form::label('telephone', 'Telefoon') !!}
    {!! Form::text('telephone', Input::old('telephone'), [ ]) !!}
    {!! HTML::error($errors->first('telephone')) !!}
</div>

<div class="form_group -buttons">
    {!! Form::submit(trans('back-users.save'), ['class' => 'button -default']) !!}
</div>
