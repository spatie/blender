@component('mail::message')
Welkom, {{ $user->first_name }}

U kunt [hier]({{ action('Front\Auth\LoginController@login') }}) inloggen.
@endcomponent
