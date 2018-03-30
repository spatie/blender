{{ html()->formGroup()->required()->text('name', 'Name') }}
{{ html()->formGroup()->required()->select('form', 'Form&shy;', $formTypes) }}
{{ html()->formGroup()->required()->email('email', 'Email') }}
