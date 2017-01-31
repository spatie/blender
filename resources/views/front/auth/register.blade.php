@component('front._layouts.main', [
'title' => fragment('auth.titleRegister')
])

    {!! Form::open() !!}

    <p>
        {!! Form::label('first_name', fragment('auth.firstName'), ['class'=>'label--required']) !!}
        {!! Form::text('first_name') !!}
        {!! Html::error($errors->first('first_name')) !!}
    </p>
    <p>
        {!! Form::label('last_name', fragment('auth.lastName'), ['class'=>'label--required']) !!}
        {!! Form::text('last_name') !!}
        {!! Html::error($errors->first('last_name')) !!}
    </p>
    <p>
        {!! Form::label('address', fragment('auth.address'), ['class'=>'label--required']) !!}
        {!! Form::text('address') !!}
        {!! Html::error($errors->first('address')) !!}
    </p>
    <p>
    <div class="grid">
        <div class="grid__cell -width-1/4">
            {!! Form::label('postal', fragment('form.postal'), ['class'=>'label--required']) !!}
            {!! Form::text('postal') !!}
        </div>
        <div class="grid__cell  -width-3/4">
            {!! Form::label('city', fragment('form.city'), ['class'=>'label--required']) !!}
            {!! Form::text('city') !!}
        </div>
    </div>
    {!! Html::error($errors->first('postal'), 'postal') !!}
    {!! Html::error($errors->first('city')) !!}
    </p>
    <p>
        {!! Form::label('country', fragment('auth.country'), ['class'=>'label--required']) !!}
        {!! Form::text('country') !!}
        {!! Html::error($errors->first('country')) !!}
    </p>
    <p>
        {!! Form::label('telephone', fragment('auth.telephone'), ['class'=>'label--required']) !!}
        {!! Form::text('telephone') !!}
        {!! Html::error($errors->first('telephone')) !!}
    </p>
    <p>
        {!! Form::label('email', fragment('auth.email'), ['class'=>'label--required']) !!}
        {!! Form::email('email') !!}
        {!! Html::error($errors->first('email')) !!}
    </p>
    <p>
        {!! Form::label('password', fragment('auth.password')) !!}
        {!! Form::password('password', [ ]) !!}
        {!! Html::error($errors->first('password')) !!}
    </p>
    <p>
        {!! Form::label('password_confirmation', fragment('auth.passwordConfirm')) !!}
        {!! Form::password('password_confirmation', [ ]) !!}
        {!! Html::error($errors->first('password_confirmation')) !!}
    </p>
    <p>
        {!! Form::button(fragment('auth.register'), ['type'=>'submit', 'class'=>'button--primary']) !!}
    </p>
    <p>
        <a href="{{ login_url() }}">{{ fragment('auth.toLogin') }}</a>
    </p>

    {!! Form::close() !!}

@endcomponent
