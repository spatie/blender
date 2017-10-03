@component('mail::message')
# {{ __('auth.resetPassword') }}

{{ __('mail.salutation') }} {{ $user->first_name }},

{{ __('auth.resetPasswordRequested') }} [{{ Request::getHost() }}]({{ action('Front\Auth\ResetPasswordController@showResetForm', [$token]) }}?email={{ $user->email }}).

@component('mail::button', ['url' => action('Front\Auth\ResetPasswordController@showResetForm', [$token]).'?email='.urlencode($user->email)])
{{ __('auth.resetPassword') }}
@endcomponent

@component('mail::panel')
{{ __('auth.resetPasswordAccidental')}}
@endcomponent

@slot('subcopy')
{{ __('auth.changePasswordBefore')}} {{ Carbon\Carbon::now()->addDays(3)->format('d/m/Y') }}.
@endslot
@endcomponent
