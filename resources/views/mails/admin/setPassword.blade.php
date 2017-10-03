@component('mail::message')
# Set Password

Hello {{ $user->first_name }},

You've been granted administrator access to [{{ Request::getHost() }}]({{ action('Back\Auth\ResetPasswordController@showResetForm', [$token]) }}?email={{ urlencode($user->email) }}).

@component('mail::button', ['url' => action('Back\Auth\ResetPasswordController@showResetForm', [$token]).'?email='.urlencode($user->email)])
Set password
@endcomponent

@slot('subcopy')
Set your password before {{ Carbon\Carbon::now()->addDays(3)->format('d/m/Y') }}.
@endslot
@endcomponent
