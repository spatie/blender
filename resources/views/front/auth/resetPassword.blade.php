@component('front._layouts.main', [
'title' => fragment('auth.titleChangePassword')
])

    @slot('mainTitle')
        <h1 class="v-auth__title -small">
            {!! Html::avatar($user, '-large v-auth__gravatar') !!}<br>
            {{ fragment('auth.titleChangePassword') }}
        </h1>
    @endslot

    {!! Form::open(['action' => 'Front\Auth\ResetPasswordController@reset']) !!}
    {!! Form::hidden('token', $token) !!}
    {!! Form::hidden('email', $user->email) !!}
    <p class="alert">
        {{ fragment('auth.resetInstructions') }}
    </p>
    <p>
        {!! Form::label('password', fragment('auth.password') ) !!}
        {!! Form::password('password', null, ['autofocus' ]) !!}
    </p>
    <p>
        {!! Form::label('password_confirmation', fragment('auth.passwordConfirm')) !!}
        {!! Form::password('password_confirmation', [null]) !!}
        {!! Html::error($errors->first('password')) !!}
    </p>
    <p>
        {!! Form::button(trans('auth.passwordMail.' . ($user->hasNeverLoggedIn() ? 'newUser' : 'oldUser') . '.resetButton'), ['type'=>'submit', 'class'=>'button--primary']) !!}
    </p>

    {!! Form::close() !!}

@endcomponent
