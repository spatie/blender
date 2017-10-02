{{ html()->formGroup()->required()->select('type', 'Type', $types) }}

{{ html()->translations(function () {
    return [
        html()->formGroup()->required()->text('name', 'Name'),
    ];
}) }}
