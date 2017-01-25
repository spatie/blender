@php
    $transKey = 'auth.passwordMail.'.($user->hasNeverLoggedIn() ? 'newUser' : 'oldUser');
@endphp

@component('mail::message')

# {{ trans($transKey.'.resetButton', [], null, $user->locale) }}</h1>

{{ trans('auth.passwordMail.compellation', [], null, $user->locale) }} {{ $user->first_name }},

{{ trans($transKey.'.intro', [], null, $user->locale) }} [{{ Request::getHost() }}]({{ url('/') }}).

@component('mail::button', ['url' => action('Front\Auth\ResetPasswordController@showResetForm', [$token])])
{{ trans($transKey.'.resetButton', [], null, $user->locale) }}
@endcomponent

@component('mail::panel')
{{ trans('auth.passwordMail.linkValidUntil', [], null, $user->locale) }} {{ Carbon\Carbon::now()->addDays(3)->format('d/m/Y') }}.
@endcomponent

@unless($user->hasNeverLoggedIn())
@component('mail::subcopy')
{{ trans('auth.passwordMail.oldUser.outro', [], null, $user->locale) }}
@endcomponent
@endunless

@endcomponent
