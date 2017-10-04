@component('mail::message')
# {{ __('auth.welcome') }}

{{ __('mail.salutation') }} {{ $user->first_name }},

{{ __('auth.access') }} [{{ Request::getHost() }}]({{ action('Front\Auth\LoginController@login') }}).

@component('mail::button', ['url' => action('Front\Auth\LoginController@login')])
{{ __('auth.login') }}
@endcomponent
@endcomponent
