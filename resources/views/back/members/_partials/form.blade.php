<div class="form__group">
    {!! Form::label('email', 'E-mail') !!}
    {!! Form::text('email', Input::old('email'), [ ]) !!}
    {!! Html::error($errors->first('email')) !!}
</div>

<div class="grid__row">
    <div class="grid__col -width-1/3">
        <div class="form__group">
            {!! Form::label('first_name', fragment('back.members.first_name')) !!}
            {!! Form::text('first_name', Input::old('first_name'), [ ]) !!}
            {!! Html::error($errors->first('first_name')) !!}
        </div>
    </div>
    <div class="grid__col -width-2/3 -last">
        <div class="form__group">
            {!! Form::label('last_name', fragment('back.members.last_name')) !!}
            {!! Form::text('last_name', Input::old('last_name'), [ ]) !!}
            {!! Html::error($errors->first('lastName')) !!}
        </div>
    </div>
</div>

@unless($user->id)
    <div class="alerts">
        {!! Html::info(fragment('back.members.automaticCredentialsMailInfo'), '-small') !!}
    </div>
@endunless

<div class="form__group -buttons">
    {!! Form::submit(fragment('back.members.save'), ['class' => 'button -default']) !!}
</div>
