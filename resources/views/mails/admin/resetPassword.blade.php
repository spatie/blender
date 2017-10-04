@component('mail::message')
# Change Password

Hello {{ $user->first_name }},

You requested a password change on [{{ Request::getHost() }}]({{ action('Back\Auth\ResetPasswordController@showResetForm', [$token]) }}?email={{ urlencode($user->email) }}).

@component('mail::button', ['url' => action('Back\Auth\ResetPasswordController@showResetForm', [$token]).'?email='.urlencode($user->email)])
Change password
@endcomponent

@component('mail::panel')
Didn't mean to reset your password? Simply ignore this message, your old one still works!
@endcomponent

@slot('subcopy')
Change your password before {{ Carbon\Carbon::now()->addDays(3)->format('d/m/Y') }}.
@endslot
@endcomponent
