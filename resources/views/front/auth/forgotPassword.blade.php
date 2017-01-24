@component('front._layouts.main', [
'title' => fragment('auth.titleResetPassword')
])

    {!! Form::open(['action' => 'Front\Auth\ForgotPasswordController@sendResetLinkEmail']) !!}

    @if(session('status'))
    <p class="alert -info">
        {{ session('status') }}
    </p>
    @else
    <p class="alert -info">
        {{ fragment('auth.resetPassword.intro') }}
    </p>
    @endif
    <p>
        {!! Form::label('email', fragment('auth.email')) !!}
        {!! Form::email('email', null, ['autofocus' => true]) !!}
        {!! Html::error($errors->first('email')) !!}
    </p>
    <p>
        {!! Form::button( fragment('auth.resetPassword.button')) !!}
    </p>
    <p>
        <a href="{{ login_url() }}">{{ fragment('auth.toLogin') }}</a>
    </p>

    {!! Form::close() !!}

@endcomponent