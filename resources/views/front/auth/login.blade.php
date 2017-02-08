@component('front._layouts.main', [
    'title' => fragment('auth.titleLogin')
])

    {{ html()->form()->open() }}

    <p>
        {{ html()->label('email', fragment('auth.email')) }}
        {{ html()->email('email')->attribute('autofocus') }}
        {{ html()->error($errors->first('email')) }}
    </p>
    <p>
        {{ html()->label('password', fragment('auth.password')) }}
        {{ html()->password('password') }}
        {{ html()->error($errors->first('password')) }}
    </p>
    <p>
        {{ html()
            ->button(fragment('auth.login'))
            ->type('submit')
            ->class('button--primary')
        }}
    </p>

    {{ html()->form()->close() }}

    <p>
        <a href="{{ action('Front\Auth\ForgotPasswordController@showLinkRequestForm') }}">{{ fragment('auth.forgotPassword') }}</a>
        |
        <a href="{{ register_url() }}">{{ fragment('auth.noAccount') }}</a>
    </p>

@endcomponent
