{{ html()->formGroup()->email('email', 'E-mail') }}

<div class="grid__row">
    <div class="grid__col -width-1/3">
        {{ html()->formGroup()->text('first_name', 'Voornaam') }}
    </div>
    <div class="grid__col -width-2/3 -last">
        {{ html()->formGroup()->text('last_name', 'Familienaam') }}
    </div>
</div>

@if($user->isCurrentUser())
    <div class="alert--info h-margin-top h-margin-bottom">
        <span class="fa fa-info-circle"></span>
        @lang('Vul onderstaande velden enkel in als je het wachtwoord wil wijzigen.')
    </div>
    <fieldset class="-info">
        <div class="grid__col -width-1/2">
            {{ html()->formGroup()->password('password', 'Wachtwoord') }}
        </div>
        <div class="grid__col -width-1/2 -last">
            {{ html()->formGroup()->password('password_confirmation', 'Wachtwoord (nogmaals)') }}
        </div>
    </fieldset>
@endif
