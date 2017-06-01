@component('mail::message')
# Wijzig je wachtwoord

Beste {{ $user->first_name }},

Je vroeg om je paswoord te wijzigen op [{{ Request::getHost() }}]({{ action('Front\Auth\ResetPasswordController@showResetForm', [$token]) }}?email={{ urlencode($user->email) }}).

@component('mail::button', ['url' => action('Front\Auth\ResetPasswordController@showResetForm', [$token]). '?email=' . urlencode($user->email)])
Wijzig je wachtwoord
@endcomponent

@component('mail::panel')
Was het een foutieve aanvraag? Negeer dan deze e-mail, je oude wachtwoord blijft gewoon werken.
@endcomponent

@slot('subcopy')
Wijzig je paswoord vòòr {{ Carbon\Carbon::now()->addDays(3)->format('d/m/Y') }}.
@endslot
@endcomponent
