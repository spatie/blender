@component('mail::message')
    # Welkom

    Beste {{ $user->first_name }},

    Je hebt nu toegang tot [{{ Request::getHost() }}]({{ url('/') }}).

    @component('mail::button', ['url' => action('Front\Auth\LoginController@login')])
        Log in
    @endcomponent

@endcomponent
