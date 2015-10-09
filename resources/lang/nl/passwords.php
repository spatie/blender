<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Password Reminder Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are the default lines which match reasons
    | that are given by the password broker for a password update attempt
    | has failed, such as for an invalid token or invalid new password.
    |
    */

    'password'=> 'Wachtwoorden moeten minstens 8 karakters lang zijn.',
    'user'=> 'Er is geen gebruiker met dat e-mailadres.',
    'token'=> 'Deze link is niet geldig.',
    'sent'=> 'We hebben je een mail verstuurd met daarin een link waarmee je je wachtwoord kan wijzigen.',
    'reset'=> 'Your password has been reset!',
    'subjectEmail'=> 'Uw wachtwoord op ' . config('app.url'),
    'subjectEmailNewUser'=> 'Toegang tot ' . config('app.url'),
    'throttle'=> 'Teveel login pogingen. Je kan opnieuw proberen binnen :seconds seconden.',
];
