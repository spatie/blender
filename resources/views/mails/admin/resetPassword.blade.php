@component('mail::message')
# Wijzig je wachtwoord

Beste {{ $user->first_name }},

Je vroeg om je paswoord te wijzigen op [{{ Request::getHost() }}]({{ action('Back\Auth\ResetPasswordController@showResetForm', [$token]) }}?email={{ $user->email }}).

@component('mail::button', ['url' => action('Back\Auth\ResetPasswordController@showResetForm', [$token]) . '?email=' . $user->email])
Wijzig je wachtwoord
@endcomponent

@component('mail::panel')
Was het een foutieve aanvraag? Negeer dan deze e-mail, je oude wachtwoord blijft gewoon werken.
@endcomponent

@slot('subcopy')
Wijzig je paswoord vòòr {{ Carbon\Carbon::now()->addDays(3)->format('d/m/Y') }}.
@endslot
@endcomponent
