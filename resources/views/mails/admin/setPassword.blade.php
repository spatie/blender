@component('mail::message')
# Stel je wachtwoord in

Beste {{ $user->first_name }},

Je bent nu administrator op [{{ Request::getHost() }}]({{ action('Back\Auth\ResetPasswordController@showResetForm', [$token]) }}).

@component('mail::button', ['url' => action('Back\Auth\ResetPasswordController@showResetForm', [$token])])
Stel je wachtwoord in
@endcomponent

@slot('subcopy')
Stel je paswoord in vòòr {{ Carbon\Carbon::now()->addDays(3)->format('d/m/Y') }}.
@endslot
@endcomponent
