{{ html()->formGroup()->email('email', 'E-mail') }}

<div class="grid__row">
    <div class="grid__col -width-1/3">
        {{ html()->formGroup()->text('first_name', 'First name') }}
    </div>
    <div class="grid__col -width-2/3 -last">
        {{ html()->formGroup()->text('last_name', 'Last name') }}
    </div>
</div>

@if($user->isCurrentUser())
    <div class="alert--info h-margin-top h-margin-bottom">
        <span class="fa fa-info-circle"></span>
        Only fill the below fields if you wish to change the password.
    </div>
    <fieldset class="-info">
        <div class="grid__col -width-1/2">
            {{ html()->formGroup()->password('password', 'Password') }}
        </div>
        <div class="grid__col -width-1/2 -last">
            {{ html()->formGroup()->password('password_confirmation', 'Password (repeat)') }}
        </div>
    </fieldset>
@endif

@if(! $user->id)
    <div class="alerts">
        <div class="alert--info -small">
            After saving this administrator, we'll send them an e-mail with instructing them to set their password.
        </div>
    </div>
@endif
