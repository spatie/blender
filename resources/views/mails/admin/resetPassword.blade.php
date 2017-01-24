@component('mail::message')
# {{ trans('auth.passwordMail.'.($user->hasNeverLoggedIn() ? 'newUser' : 'oldUser').'.resetButton', [], null, $user->locale) }}

{{ trans('auth.passwordMail.compellation', [], null, $user->locale) }} {{ $user->first_name }},

{{ trans('auth.passwordMail.'.($user->hasNeverLoggedIn() ? 'newUser' : 'oldUser').'.intro', [], null, $user->locale) }} [{{ config('app.url') }}]({{ url('blender') }}).

@component('mail::button', ['url' => action('Back\Auth\ResetPasswordController@showResetForm', [$token])])
{{ trans('auth.passwordMail.'.($user->hasNeverLoggedIn() ? 'newUser' : 'oldUser').'.resetButton', [], null, $user->locale) }}
@endcomponent

*{{ trans('auth.passwordMail.linkValidUntil', [], null, $user->locale) }} {{ Carbon\Carbon::now()->addDays(3)->format('d/m/Y') }}.*

@unless($user->hasNeverLoggedIn())
    {{ trans('auth.passwordMail.oldUser.outro', [], null, $user->locale) }}
@endunless

@endcomponent
