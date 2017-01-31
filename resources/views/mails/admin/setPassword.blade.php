@component('mail::message')
    # Stel je wachtwoord in

    Beste {{ $user->first_name }},

    Je hebt toegang gekregen tot [{{ config('app.url') }}]({{ url('blender') }}).

    @component('mail::button', ['url' => action('Back\Auth\ResetPasswordController@showResetForm', [$token])])
        Stel je wachtwoord in
    @endcomponent

    @component('mail::panel')
        Je wachtwoord is ingesteld? Je kan vanaf nu inloggen op {{ url('blender') }}.
    @endcomponent

    @slot('subcopy')
        Stel je paswoord in vòòr {{ Carbon\Carbon::now()->addDays(3)->format('d/m/Y') }}.
    @endslot
@endcomponent
