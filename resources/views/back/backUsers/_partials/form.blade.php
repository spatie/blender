<div class="form_group">
    {!! Form::label('email', 'E-mail') !!}
    {!! Form::text('email', Input::old('email'), [ ]) !!}
    {!! HTML::error($errors->first('email')) !!}
</div>

<div class="grid_row">
    <div class="grid_col -width-1/3">
        <div class="form_group">
            {!! Form::label('first_name', trans('back-backUsers.first_name')) !!}
            {!! Form::text('first_name', Input::old('first_name'), [ ]) !!}
            {!! HTML::error($errors->first('first_name')) !!}
        </div>
    </div>
    <div class="grid_col -width-2/3 -last">
        <div class="form_group">
            {!! Form::label('last_name', trans('back-backUsers.last_name')) !!}
            {!! Form::text('last_name', Input::old('last_name'), [ ]) !!}
            {!! HTML::error($errors->first('lastName')) !!}
        </div>
    </div>
</div>

@if($user->isCurrentUser())
    <fieldset class="-info">
        <div class="alert -info">
            <span class="fa fa-info-circle"></span> {{ trans('back-backUsers.passwordChangeInfo') }}
        </div>
        <div class="grid_col -width-1/2">
            <div class="form_group">
                {!! Form::label('password', trans('back-backUsers.password')) !!}
                {!! Form::password('password', [ ]) !!}
                {!! HTML::error($errors->first('password')) !!}
            </div>
        </div>
        <div class="grid_col -width-1/2 -last">
            <div class="form_group">
                {!! Form::label('password_confirmation', trans('back-backUsers.passwordConfirmation')) !!}
                {!! Form::password('password_confirmation', [ ]) !!}
                {!! HTML::error($errors->first('password_confirmation')) !!}
            </div>
        </div>
    </fieldset>
@endif

<div class="form_group -buttons">
    {!! Form::submit(trans('back-backUsers.save'), ['class' => 'button -default']) !!}
</div>
