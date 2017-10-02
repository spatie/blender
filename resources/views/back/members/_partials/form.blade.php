{{ html()->formGroup()->email('email', 'E-mail') }}

<div class="grid__row">
    <div class="grid__col -width-1/3">
        {{ html()->formGroup()->text('first_name', 'First name') }}
    </div>
    <div class="grid__col -width-2/3 -last">
        {{ html()->formGroup()->text('last_name', 'Last name') }}
    </div>
</div>

@if(! $user->id)
    <div class="alerts">
        <div class="alert--info -small">
            After saving this member, we'll send them an e-mail with instructions to set their password.
        </div>
    </div>
@endif
