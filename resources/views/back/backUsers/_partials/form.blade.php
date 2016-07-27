<div class="form_group">
    {!! Form::label('email', 'E-mail') !!}
    {!! Form::text('email', Input::old('email'), [ ]) !!}
    {!! Html::error($errors->first('email')) !!}
</div>

<div class="grid_row">
    <div class="grid_col -width-1/3">
        <div class="form_group">
            {!! Form::label('first_name', fragment('back.backUsers.first_name')) !!}
            {!! Form::text('first_name', Input::old('first_name'), [ ]) !!}
            {!! Html::error($errors->first('first_name')) !!}
        </div>
    </div>
    <div class="grid_col -width-2/3 -last">
        <div class="form_group">
            {!! Form::label('last_name', fragment('back.backUsers.last_name')) !!}
            {!! Form::text('last_name', Input::old('last_name'), [ ]) !!}
            {!! Html::error($errors->first('lastName')) !!}
        </div>
    </div>
</div>

@if($user->isCurrentUser())
    <fieldset class="-info">
        <div class="alert -info">
            <span class="fa fa-info-circle"></span> {{ fragment('back.backUsers.passwordChangeInfo') }}
        </div>
        <div class="grid_col -width-1/2">
            <div class="form_group">
                {!! Form::label('password', fragment('back.backUsers.password')) !!}
                {!! Form::password('password', [ ]) !!}
                {!! Html::error($errors->first('password')) !!}
            </div>
        </div>
        <div class="grid_col -width-1/2 -last">
            <div class="form_group">
                {!! Form::label('password_confirmation', fragment('back.backUsers.passwordConfirmation')) !!}
                {!! Form::password('password_confirmation', [ ]) !!}
                {!! Html::error($errors->first('password_confirmation')) !!}
            </div>
        </div>
    </fieldset>
@endif

<div class="form_group -buttons">
    {!! Form::submit(fragment('back.backUsers.save'), ['class' => 'button -default']) !!}
</div>
