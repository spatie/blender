{{ html()->formGroup()->email('email', 'E-mail') }}

<div class="grid__row">
    <div class="grid__col -width-1/3">
        {{ html()->formGroup()->text('first_name', 'Voornaam') }}
    </div>
    <div class="grid__col -width-2/3 -last">
        {{ html()->formGroup()->text('last_name', 'Familienaam') }}
    </div>
</div>

@if(! $user->id)
    <div class="alerts">
        {{ html()->info()
            ->text(__('Zodra je deze nieuwe administrator bewaart, zullen we hem/haar een e-mail '.
                      'sturen met een link om het wachtwoord in te stellen.'))
            ->class('-small') }}
    </div>
@endif
