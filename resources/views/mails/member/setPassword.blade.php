@component('mail::message')
# {{ __('auth.setPassword') }}

{{ __('mail.salutation') }} {{ $user->first_name }},

{{ __('auth.access')}} [{{ Request::getHost() }}]({{ action('Front\Auth\ResetPasswordController@showResetForm', [$token]) }}).

@component('mail::button', ['url' => action('Front\Auth\ResetPasswordController@showResetForm', [$token]).'?email='.urlencode($user->email)])
{{ __('auth.setPassword') }}
@endcomponent

@slot('subcopy')
{{ __('auth.changePasswordBefore')}} {{ Carbon\Carbon::now()->addDays(3)->format('d/m/Y') }}.
@endslot
@endcomponent
